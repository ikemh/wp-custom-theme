<?php
// Enqueue scripts and styles
function dom_ofertas_theme_scripts() {
    wp_enqueue_style('dom-ofertas-style', get_stylesheet_uri());
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css', array(), null);
    wp_enqueue_style('dom-ofertas-fonts', 'https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Ubuntu:wght@400;700&display=swap', array(), null);

    // Common CSS
    wp_enqueue_style('dom-ofertas-misc', get_template_directory_uri() . '/css/misc.css', array(), null);
    wp_enqueue_style('dom-ofertas-header', get_template_directory_uri() . '/css/header.css', array(), null);
    wp_enqueue_style('dom-ofertas-footer', get_template_directory_uri() . '/css/footer.css', array(), null);
    
    // Common JS
    wp_enqueue_script('common-script', get_template_directory_uri() . '/js/common.js', array('jquery'), null, true);

    // Conditional CSS and JS
    if (is_front_page()) {
        wp_enqueue_style('dom-ofertas-front-page', get_template_directory_uri() . '/css/front-page.css', array(), null);
        wp_enqueue_script('front-page-script', get_template_directory_uri() . '/js/front-page.js', array('jquery'), null, true);
    }

    if (is_single()) {
        wp_enqueue_style('dom-ofertas-single-page', get_template_directory_uri() . '/css/single-product.css', array(), null);
        wp_enqueue_script('single-product-script', get_template_directory_uri() . '/js/single-product.js', array('jquery'), null, true);
    }

    if (is_cart()) {
        wp_enqueue_style('dom-ofertas-cart', get_template_directory_uri() . '/css/cart.css', array(), null);
        wp_enqueue_script('cart-script', get_template_directory_uri() . '/js/cart.js', array('jquery'), null, true);

        // Gerar o nonce e passar para o script cart.js
        $nonce = wp_create_nonce('update-cart-nonce');
        wp_localize_script('cart-script', 'cart_quantity_params', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => $nonce,
        ));
    }

    // Adicione outras condições conforme necessário
}
add_action('wp_enqueue_scripts', 'dom_ofertas_theme_scripts');

// Add type="module" to scripts
function add_module_type_to_scripts($tag, $handle, $src) {
    // List of script handles to add type="module"
    $module_scripts = array('common-script', 'front-page-script', 'single-product-script', 'cart-script');

    if (in_array($handle, $module_scripts)) {
        $tag = '<script type="module" src="' . esc_url($src) . '"></script>';
    }

    return $tag;
}
add_filter('script_loader_tag', 'add_module_type_to_scripts', 10, 3);
