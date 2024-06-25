<?php
// Remover campos do checkout
add_filter('woocommerce_checkout_fields', 'custom_override_checkout_fields');
function custom_override_checkout_fields($fields) {
    // Remove campos de billing
    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_phone']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_postcode']);

    // Remove campos de shipping
    unset($fields['shipping']['shipping_company']);
    unset($fields['shipping']['shipping_address_2']);
    unset($fields['shipping']['shipping_postcode']);
    return $fields;
}

// Adicionar novos campos ao checkout
add_filter('woocommerce_checkout_fields', 'custom_add_checkout_fields');
function custom_add_checkout_fields($fields) {
    $fields['billing']['billing_custom_field'] = array(
        'type'        => 'text',
        'label'       => __('Custom Field', 'woocommerce'),
        'placeholder' => __('Enter something', 'woocommerce'),
        'required'    => true,
        'class'       => array('form-row-wide'),
        'priority'    => 22,
    );
    return $fields;
}

// Tornar campos opcionais ou obrigatórios
add_filter('woocommerce_checkout_fields', 'customize_checkout_fields');
function customize_checkout_fields($fields) {
    // Tornar o campo billing_address_2 opcional
    $fields['billing']['billing_address_2']['required'] = false;

    // Tornar o campo billing_postcode obrigatório
    $fields['billing']['billing_postcode']['required'] = true;

    return $fields;
}

// Salvar dados dos campos personalizados
add_action('woocommerce_checkout_update_order_meta', 'custom_save_checkout_fields');
function custom_save_checkout_fields($order_id) {
    if (!empty($_POST['billing_custom_field'])) {
        update_post_meta($order_id, '_billing_custom_field', sanitize_text_field($_POST['billing_custom_field']));
    }
}

// Exibir dados personalizados no admin
add_action('woocommerce_admin_order_data_after_billing_address', 'custom_display_order_data_in_admin');
function custom_display_order_data_in_admin($order){
    echo '<p><strong>'.__('Custom Field').':</strong> ' . get_post_meta($order->get_id(), '_billing_custom_field', true) . '</p>';
}
?>