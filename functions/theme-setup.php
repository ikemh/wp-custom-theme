<?php
// Funções de configuração do tema
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
