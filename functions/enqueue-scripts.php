<?php
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
