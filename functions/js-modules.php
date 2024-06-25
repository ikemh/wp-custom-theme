<?php
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