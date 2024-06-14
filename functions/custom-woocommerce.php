<?php
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

// Custom WooCommerce template loader
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
