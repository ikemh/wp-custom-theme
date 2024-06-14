<?php
function dom_ofertas_theme_setup(***REMOVED*** {
    // Adicionar suporte a título dinâmico
    add_theme_support('title-tag'***REMOVED***;
    // Adicionar suporte a imagens destacadas
    add_theme_support('post-thumbnails'***REMOVED***;
    // Registrar menu de navegação
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'dom-ofertas-theme'***REMOVED***,
***REMOVED******REMOVED***;
}
add_action('after_setup_theme', 'dom_ofertas_theme_setup'***REMOVED***;

// Enqueue scripts and styles
function dom_ofertas_theme_scripts(***REMOVED*** {
    wp_enqueue_style('dom-ofertas-style', get_stylesheet_uri(***REMOVED******REMOVED***;
    wp_enqueue_style('dom-ofertas-misc', get_template_directory_uri(***REMOVED*** . '/css/misc.css', array(***REMOVED***, null***REMOVED***;
    wp_enqueue_style('dom-ofertas-header', get_template_directory_uri(***REMOVED*** . '/css/header.css', array(***REMOVED***, null***REMOVED***;
    wp_enqueue_style('dom-ofertas-footer', get_template_directory_uri(***REMOVED*** . '/css/footer.css', array(***REMOVED***, null***REMOVED***;
    wp_enqueue_style('dom-ofertas-front-page', get_template_directory_uri(***REMOVED*** . '/css/front-page.css', array(***REMOVED***, null***REMOVED***;
    wp_enqueue_style('dom-ofertas-single-page', get_template_directory_uri(***REMOVED*** . '/css/single-product.css', array(***REMOVED***, null***REMOVED***;
    wp_enqueue_style('dom-ofertas-cart', get_template_directory_uri(***REMOVED*** . '/css/cart.css', array(***REMOVED***, null***REMOVED***;
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css', array(***REMOVED***, null***REMOVED***;
    wp_enqueue_style('dom-ofertas-fonts', 'https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Ubuntu:wght@400;700&display=swap', array(***REMOVED***, null***REMOVED***;
    wp_enqueue_script('jquery', false, array(***REMOVED***, null, true***REMOVED***;
    wp_enqueue_script('dom-ofertas-script', get_template_directory_uri(***REMOVED*** . '/js/main.js', array('jquery'***REMOVED***, null, true***REMOVED***;
}
add_action('wp_enqueue_scripts', 'dom_ofertas_theme_scripts'***REMOVED***;

// Custom add to cart text
function custom_add_to_cart_text(***REMOVED*** {
    return __('COMPRAR', 'woocommerce'***REMOVED***; // Substitua 'Adicionar ao Carrinho' pelo texto desejado
}
add_filter('woocommerce_product_single_add_to_cart_text', 'custom_add_to_cart_text'***REMOVED***; // Altera o texto do botão na página do produto
add_filter('woocommerce_product_add_to_cart_text', 'custom_add_to_cart_text'***REMOVED***; // Altera o texto do botão em outras páginas

// Redirecionar para o checkout após adicionar ao carrinho
function custom_add_to_cart_redirect(***REMOVED*** {
    return wc_get_checkout_url(***REMOVED***;
}
add_filter('woocommerce_add_to_cart_redirect', 'custom_add_to_cart_redirect'***REMOVED***;

// Add custom body classes for cart and checkout pages
function add_custom_body_classes($classes***REMOVED*** {
    if (is_cart(***REMOVED******REMOVED*** {
        $classes[***REMOVED*** = 'no-animation-cart';
    }
    if (is_checkout(***REMOVED******REMOVED*** {
        $classes[***REMOVED*** = 'no-animation-checkout';
    }
    return $classes;
}
add_filter('body_class', 'add_custom_body_classes'***REMOVED***;

// Custom WooCommerce template loader with logging
add_filter('template_include', 'override_cart_template', 100***REMOVED***;

function override_cart_template($template***REMOVED*** {
    if (is_cart(***REMOVED******REMOVED*** {
        $custom_template = get_stylesheet_directory(***REMOVED*** . '/woocommerce/cart/cart.php';
        if (file_exists($custom_template***REMOVED******REMOVED*** {
            return $custom_template;
        }
    }
    return $template;
}

