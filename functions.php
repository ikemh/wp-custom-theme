<?php
function dom_ofertas_theme_setup() {
    // Adicionar suporte a título dinâmico
    add_theme_support('title-tag');
    // Adicionar suporte a imagens destacadas
    add_theme_support('post-thumbnails');
    // Registrar menu de navegação
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'dom-ofertas-theme'),
    ));
}
add_action('after_setup_theme', 'dom_ofertas_theme_setup');

// Enqueue scripts and styles
function dom_ofertas_theme_scripts() {
    wp_enqueue_style('dom-ofertas-style', get_stylesheet_uri());
    wp_enqueue_style('dom-ofertas-misc', get_template_directory_uri() . '/css/misc.css', array(), null);
    wp_enqueue_style('dom-ofertas-header', get_template_directory_uri() . '/css/header.css', array(), null);
    wp_enqueue_style('dom-ofertas-footer', get_template_directory_uri() . '/css/footer.css', array(), null);
    wp_enqueue_style('dom-ofertas-front-page', get_template_directory_uri() . '/css/front-page.css', array(), null);
    wp_enqueue_style('dom-ofertas-single-page', get_template_directory_uri() . '/css/single-product.css', array(), null);
    wp_enqueue_style('dom-ofertas-cart', get_template_directory_uri() . '/css/cart.css', array(), null);
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css', array(), null);
    wp_enqueue_style('dom-ofertas-fonts', 'https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Ubuntu:wght@400;700&display=swap', array(), null);
    wp_enqueue_script('jquery', false, array(), null, true);
    wp_enqueue_script('dom-ofertas-script', get_template_directory_uri() . '/js/main.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'dom_ofertas_theme_scripts');

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

// Custom WooCommerce template loader with logging
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

