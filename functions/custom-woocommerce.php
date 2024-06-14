<?php
// Custom add to cart text
function custom_add_to_cart_text() {
    return __('COMPRAR', 'woocommerce'); // Substitua 'Adicionar ao Carrinho' pelo texto desejado
}
add_filter('woocommerce_product_single_add_to_cart_text', 'custom_add_to_cart_text'); // Altera o texto do botão na página do produto
add_filter('woocommerce_product_add_to_cart_text', 'custom_add_to_cart_text'); // Altera o texto do botão em outras páginas

// Redirecionar para o checkout após adicionar ao carrinho
function custom_add_to_cart_redirect() {
    return wc_get_checkout_url();
}
add_filter('woocommerce_add_to_cart_redirect', 'custom_add_to_cart_redirect');

// Add custom body classes for cart and checkout pages
function add_custom_body_classes($classes) {
    if (is_cart()) {
        $classes[] = 'no-animation-cart';
    }
    if (is_checkout()) {
        $classes[] = 'no-animation-checkout';
    }
    return $classes;
}
add_filter('body_class', 'add_custom_body_classes');

// Custom WooCommerce template loader
add_filter('template_include', 'override_cart_template', 100);

function override_cart_template($template) {
    if (is_cart()) {
        $custom_template = get_stylesheet_directory() . '/woocommerce/cart/cart.php';
        if (file_exists($custom_template)) {
            return $custom_template;
        }
    }
    return $template;
}
