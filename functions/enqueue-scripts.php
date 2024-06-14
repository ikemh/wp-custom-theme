<?php
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
