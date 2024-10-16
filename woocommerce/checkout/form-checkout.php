<?php
/**
 * Template Name: Custom Checkout
 */

defined('ABSPATH') || exit;

$checkout = WC()->checkout();

do_action('woocommerce_before_checkout_form', $checkout);

// If checkout registration is disabled and not logged in, the user cannot checkout.
if (! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in()) {
    echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
    return;
}

wp_head();
?>
<div id="custom-checkout">
    <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">
        <div id="checkout-steps">
            <!-- Step 1: Identificação -->
            <div id="step-1" class="checkout-step active">
                <h2><?php _e('Identifique-se', 'woocommerce'); ?></h2>
                <div class="checkout-content">
                    <?php
                    woocommerce_form_field('billing_email', array(
                        'type'     => 'email',
                        'class'    => array('form-row-wide'),
                        'label'    => __('Email', 'woocommerce'),
                        'required' => true,
                    ), $checkout->get_value('billing_email'));
                    ?>
                    <div id="additional-step-1-fields" style="display:none;">
                        <?php
                        woocommerce_form_field('billing_full_name', array(
                            'type'     => 'text',
                            'class'    => array('form-row-wide'),
                            'label'    => __('Nome Completo', 'woocommerce'),
                            'required' => true,
                        ), $checkout->get_value('billing_full_name'));

                        woocommerce_form_field('billing_cpf', array(
                            'type'     => 'text',
                            'class'    => array('form-row-wide'),
                            'label'    => __('CPF', 'woocommerce'),
                            'required' => true,
                        ), $checkout->get_value('billing_cpf'));

                        woocommerce_form_field('billing_phone', array(
                            'type'     => 'tel',
                            'class'    => array('form-row-wide'),
                            'label'    => __('Celular', 'woocommerce'),
                            'required' => true,
                        ), $checkout->get_value('billing_phone'));
                        ?>
                    </div>
                    <button type="button" id="next-step-1" class="button"><?php _e('Next', 'woocommerce'); ?></button>
                </div>
            </div>

            <!-- Step 2: Informações de Cobrança -->
            <div id="step-2" class="checkout-step">
                <h2><?php _e('Billing Information', 'woocommerce'); ?></h2>
                <div class="checkout-content">
                    <?php
                    woocommerce_form_field('billing_postcode', array(
                        'type'     => 'text',
                        'class'    => array('form-row-wide'),
                        'label'    => __('CEP', 'woocommerce'),
                        'required' => true,
                    ), $checkout->get_value('billing_postcode'));
                    ?>
                    <div id="additional-step-2-fields" style="display:none;">
                        <?php
                        woocommerce_form_field('billing_address_1', array(
                            'type'     => 'text',
                            'class'    => array('form-row-wide'),
                            'label'    => __('Endereço', 'woocommerce'),
                            'required' => true,
                        ), $checkout->get_value('billing_address_1'));

                        woocommerce_form_field('billing_number', array(
                            'type'     => 'text',
                            'class'    => array('form-row-wide'),
                            'label'    => __('Número', 'woocommerce'),
                            'required' => true,
                        ), $checkout->get_value('billing_number'));

                        woocommerce_form_field('billing_neighborhood', array(
                            'type'     => 'text',
                            'class'    => array('form-row-wide'),
                            'label'    => __('Bairro', 'woocommerce'),
                            'required' => true,
                        ), $checkout->get_value('billing_neighborhood'));

                        woocommerce_form_field('billing_address_2', array(
                            'type'     => 'text',
                            'class'    => array('form-row-wide'),
                            'label'    => __('Complemento', 'woocommerce'),
                            'required' => false,
                        ), $checkout->get_value('billing_address_2'));

                        woocommerce_form_field('billing_recipient', array(
                            'type'     => 'text',
                            'class'    => array('form-row-wide'),
                            'label'    => __('Destinatário', 'woocommerce'),
                            'required' => true,
                        ), $checkout->get_value('billing_recipient'));

                        // Hidden fields for City and State
                        woocommerce_form_field('billing_city', array(
                            'type'     => 'hidden',
                            'class'    => array('form-row-wide'),
                            'label'    => __('Cidade', 'woocommerce'),
                            'required' => true,
                        ), $checkout->get_value('billing_city'));

                        woocommerce_form_field('billing_state', array(
                            'type'     => 'hidden',
                            'class'    => array('form-row-wide'),
                            'label'    => __('Estado', 'woocommerce'),
                            'required' => true,
                        ), $checkout->get_value('billing_state'));
                        ?>
                    </div>
                    <button type="button" id="next-step-2" class="button"><?php _e('Next', 'woocommerce'); ?></button>
                </div>
            </div>

            <!-- Step 3: Informações de Pagamento -->
            <div id="step-3" class="checkout-step">
                <h2><?php _e('Payment Information', 'woocommerce'); ?></h2>
                <div class="checkout-content">
                    <?php
                    if (WC()->cart->needs_payment()) {
                        ?>
                        <div id="payment" class="woocommerce-checkout-payment">
                            <?php if (! empty($available_gateways)) : ?>
                                <ul class="wc_payment_methods payment_methods methods">
                                    <?php
                                    if (sizeof($available_gateways)) {
                                        current($available_gateways)->set_current();
                                    }
                                    foreach ($available_gateways as $gateway) {
                                        wc_get_template('checkout/payment-method.php', array('gateway' => $gateway));
                                    }
                                    ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                        <?php
                    }
                    ?>
                    <button type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order"><?php _e('Place Order', 'woocommerce'); ?></button>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="order-summary">
            <h2><?php _e('Resumo do pedido', 'woocommerce'); ?></h2>
            <div class="cart-items">
                <?php
                foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                    $product = $cart_item['data'];
                    $product_name = $product->get_title();
                    $product_price = $product->get_price();
                    $product_quantity = $cart_item['quantity'];
                    $product_total = $product_price * $product_quantity;
                    $product_image = $product->get_image(array(50, 50)); // Set thumbnail size to 50x50
                ?>
                <div class="cart-item">
                    <div class="item-image">
                        <div class="item-quantity">
                            <span aria-hidden="true"><?php echo esc_html($product_quantity); ?></span>
                        </div>
                        <?php echo $product_image; ?>
                    </div>
                    <div class="item-description">
                        <span class="product-name"><?php echo esc_html($product_name); ?></span>
                        
                        <p>
                            <?php
                                $regular_price = $product->get_regular_price();
                                $sale_price = $product->get_sale_price();
                                $price_html = '';

                                if ($product->is_on_sale()) {
                                    $price_html = '<del>' . wc_price($regular_price) . '</del> <ins>' . wc_price($sale_price) . '</ins>';
                                } else {
                                    $price_html = wc_price($regular_price);
                                }

                                echo apply_filters('woocommerce_cart_item_price', $price_html, $cart_item, $cart_item_key); // PHPCS: XSS ok.
                            ?> 
                        </p>

                        <?php
                        if (!empty($cart_item['variation'])) {
                            echo '<ul class="product-attributes">';
                            foreach ($cart_item['variation'] as $attribute_name => $attribute_value) {
                                $attribute_name = wc_attribute_label(str_replace('attribute_', '', $attribute_name), $product);
                                ?>
                                <li class="product-attribute">
                                    <span class="meta-label"><?php echo esc_html($attribute_name); ?>:</span>
                                    <span class="meta-value"><?php echo esc_html($attribute_value); ?></span>
                                </li>
                                <?php
                            }
                            echo '</ul>';
                        }
                        ?>

                        <p class="in_stock"><?php _e('Em estoque', 'woocommerce'); ?></p>
                        <p class="free_freight"><?php _e('Elegível para', 'woocommerce'); ?> <span class="freight-span"><?php _e('frete grátis', 'woocommerce'); ?> <i class="fa-solid fa-bolt"></i></span></p>
                        <div class="product-metadata">
                            <p><?php echo esc_html($product->get_short_description()); ?></p>
                        </div>
                    </div>
                    <div class="item-total-price">
                        <span class="price"><?php echo wc_price($product_total); ?></span>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="order-totals">
                <div class="subtotal">
                    <span class="label"><?php _e('Subtotal', 'woocommerce'); ?></span>
                    <span class="value"><?php echo wc_price(WC()->cart->get_cart_contents_total()); ?></span>
                </div>
                <div class="shipping">
                    <span class="label"><?php _e('Shipping', 'woocommerce'); ?></span>
                    <span class="value"><?php echo wc_price(WC()->cart->get_shipping_total()); ?></span>
                </div>
                <div class="total">
                    <span class="label"><?php _e('Total', 'woocommerce'); ?></span>
                    <span class="value"><?php echo wc_price(WC()->cart->total); ?></span>
                </div>
            </div>
        </div>
    </form>
</div>
<?php wp_footer(); ?>
