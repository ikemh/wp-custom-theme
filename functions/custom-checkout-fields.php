<?php
// Adiciona campos personalizados de faturamento no checkout
add_filter('woocommerce_billing_fields', 'custom_checkout_billing_fields');
function custom_checkout_billing_fields($fields) {
    $custom_fields = array(
        'billing_cpf' => array(
            'type'        => 'text',
            'label'       => __('CPF', 'woocommerce'),
            'required'    => true,
            'class'       => array('form-row-wide'),
            'priority'    => 23,
        ),
        'billing_cnpj' => array(
            'type'        => 'text',
            'label'       => __('CNPJ', 'woocommerce'),
            'required'    => false,
            'class'       => array('form-row-wide'),
            'priority'    => 26,
        ),
        'billing_number' => array(
            'type'        => 'text',
            'label'       => __('Número', 'woocommerce'),
            'required'    => true,
            'class'       => array('form-row-wide'),
            'priority'    => 55,
        ),
        'billing_neighborhood' => array(
            'type'        => 'text',
            'label'       => __('Bairro', 'woocommerce'),
            'required'    => true,
            'class'       => array('form-row-wide'),
            'priority'    => 65,
        )
    );

    return array_merge($fields, $custom_fields);
}

// Adiciona campos personalizados de entrega no checkout
add_filter('woocommerce_shipping_fields', 'custom_checkout_shipping_fields');
function custom_checkout_shipping_fields($fields) {
    $custom_fields = array(
        'shipping_number' => array(
            'type'        => 'text',
            'label'       => __('Número', 'woocommerce'),
            'required'    => true,
            'class'       => array('form-row-wide'),
            'priority'    => 55,
        ),
        'shipping_neighborhood' => array(
            'type'        => 'text',
            'label'       => __('Bairro', 'woocommerce'),
            'required'    => true,
            'class'       => array('form-row-wide'),
            'priority'    => 65,
        )
    );

    return array_merge($fields, $custom_fields);
}

// Salva campos personalizados no meta dos pedidos
add_action('woocommerce_checkout_update_order_meta', 'save_custom_checkout_fields');
function save_custom_checkout_fields($order_id) {
    $custom_fields = array(
        'billing_cpf',
        'billing_cnpj',
        'billing_number',
        'billing_neighborhood',
        'shipping_number',
        'shipping_neighborhood'
    );

    foreach ($custom_fields as $field) {
        if (!empty($_POST[$field])) {
            update_post_meta($order_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }
}

// Remove a obrigatoriedade dos campos de nome e país no checkout
add_filter('woocommerce_checkout_fields', 'custom_override_checkout_fields');
function custom_override_checkout_fields($fields) {
    $fields['billing']['billing_first_name']['required'] = false;
    $fields['billing']['billing_last_name']['required'] = false;
    $fields['billing']['billing_country']['required'] = false;
    $fields['billing']['billing_country']['default'] = 'BR';

    return $fields;
}

// Salva o campo de nome completo e divide em primeiro e último nome
add_action('woocommerce_checkout_update_order_meta', 'save_full_name_field');
function save_full_name_field($order_id) {
    if (!empty($_POST['billing_full_name'])) {
        update_post_meta($order_id, '_billing_full_name', sanitize_text_field($_POST['billing_full_name']));
    }
}

add_action('woocommerce_checkout_create_order', 'split_full_name_to_first_last');
function split_full_name_to_first_last($order) {
    $full_name = isset($_POST['billing_full_name']) ? sanitize_text_field($_POST['billing_full_name']) : '';

    if ($full_name) {
        $name_parts = explode(' ', $full_name);
        $first_name = array_shift($name_parts);
        $last_name = implode(' ', $name_parts);

        $order->set_billing_first_name($first_name);
        $order->set_billing_last_name($last_name);
    }
}

// Salva os campos personalizados no admin
add_action('woocommerce_process_shop_order_meta', 'save_custom_admin_billing_fields', 10, 1);
function save_custom_admin_billing_fields($post_id) {
    $custom_fields = array(
        '_billing_cpf',
        '_billing_number',
        '_billing_neighborhood',
        '_billing_cellphone',
        '_shipping_number',
        '_shipping_neighborhood'
    );

    foreach ($custom_fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        }
    }
}

// Customiza os formatos de endereço
add_filter('woocommerce_localisation_address_formats', 'custom_localisation_address_formats');
function custom_localisation_address_formats($formats) {
    $formats['BR'] = "{name}\n{address_1}, {number}\n{address_2}\n{neighborhood}\n{city}\n{state}\n{postcode}\n{country}";

    return $formats;
}

add_filter('woocommerce_formatted_address_replacements', 'custom_formatted_address_replacements', 10, 2);
function custom_formatted_address_replacements($replacements, $args) {
    $args = wp_parse_args($args, array(
        'cpf'          => '',
        'number'       => '',
        'neighborhood' => '',
    ));

    $replacements['{cpf}']          = $args['cpf'];
    $replacements['{number}']       = $args['number'];
    $replacements['{neighborhood}'] = $args['neighborhood'];

    return $replacements;
}

// Formata o endereço de faturamento no admin
add_filter('woocommerce_order_formatted_billing_address', 'custom_order_formatted_billing_address', 10, 2);
function custom_order_formatted_billing_address($address, $order) {
    $address['cpf']          = $order->get_meta('_billing_cpf');
    $address['number']       = $order->get_meta('_billing_number');
    $address['neighborhood'] = $order->get_meta('_billing_neighborhood');

    return $address;
}

// Formata o endereço de entrega no admin
add_filter('woocommerce_order_formatted_shipping_address', 'custom_order_formatted_shipping_address', 10, 2);
function custom_order_formatted_shipping_address($address, $order) {
    $address['number']       = $order->get_meta('_shipping_number');
    $address['neighborhood'] = $order->get_meta('_shipping_neighborhood');

    return $address;
}

// Personaliza os campos de faturamento no admin
add_filter('woocommerce_admin_billing_fields', 'customize_admin_billing_fields');
function customize_admin_billing_fields($fields) {
    $new_fields = array();

    foreach ($fields as $key => $field) {
        $new_fields[$key] = $field;

        if ($key === 'address_1') {
            $new_fields['number'] = array(
                'label' => __('Número', 'woocommerce'),
                'show'  => false,
            );
        }
        if ($key === 'address_2') {
            $new_fields['neighborhood'] = array(
                'label' => __('Bairro', 'woocommerce'),
                'show'  => false,
            );
        }
        if ($key === 'phone') {
            $new_fields['cellphone'] = array(
                'label' => __('Celular', 'woocommerce'),
                'show'  => false,
            );
        }
        if ($key === 'last_name') {
            $new_fields['cpf'] = array(
                'label' => __('CPF', 'woocommerce'),
                'show'  => true,
            );
        }
    }

    return $new_fields;
}

// Personaliza os campos de entrega no admin
add_filter('woocommerce_admin_shipping_fields', 'customize_admin_shipping_fields');
function customize_admin_shipping_fields($fields) {
    $new_fields = array();

    foreach ($fields as $key => $field) {
        $new_fields[$key] = $field;

        if ($key === 'address_1') {
            $new_fields['number'] = array(
                'label' => __('Número', 'woocommerce'),
                'show'  => false,
            );
        }
        if ($key === 'address_2') {
            $new_fields['neighborhood'] = array(
                'label' => __('Bairro', 'woocommerce'),
                'show'  => false,
            );
        }
    }

    return $new_fields;
}
