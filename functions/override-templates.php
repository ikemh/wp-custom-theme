<?php
// Função para sobrescrever templates do WooCommerce
function override_woocommerce_templates($template) {
    /* Sobrescrever o template do checkout
    if (is_checkout()) {
        $checkout_template = get_stylesheet_directory() . '/woocommerce/checkout/form-checkout.php';
        if (file_exists($checkout_template)) {
            return $checkout_template;
        }
    } */

    // Sobrescrever o template do carrinho
    if (is_cart()) {
        $cart_template = get_stylesheet_directory() . '/woocommerce/cart/cart.php';
        if (file_exists($cart_template)) {
            return $cart_template;
        }
    }

    return $template;
}
add_filter('template_include', 'override_woocommerce_templates', 100);

