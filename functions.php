<?php
// Arquivos de configuração do tema
require get_template_directory() . '/functions/theme-setup.php';
require get_template_directory() . '/functions/enqueue-scripts.php';
require get_template_directory() . '/functions/custom-woocommerce.php';
require get_template_directory() . '/functions/theme-options.php'; // Arquivo para as opções do tema
require get_template_directory() . '/functions/globals.php'; // Arquivo de configurações globais
require get_template_directory() . '/functions/filtrinho.php';
require get_template_directory() . '/functions/js-modules.php';
require get_template_directory() . '/functions/override-templates.php';

add_action('wp_footer', function() {
    // Forçar um erro para testar o log
    trigger_error('Este é um erro de teste!', E_USER_NOTICE);
});
