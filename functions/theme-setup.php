<?php
// Funções de configuração do tema
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
