<?php
// Adiciona a página de opções do tema
function dom_ofertas_add_admin_page() {
    add_menu_page('Configurações do Tema', 'Configurações do Tema', 'manage_options', 'dom_ofertas', 'dom_ofertas_create_page', 'dashicons-admin-generic', 110);
    add_submenu_page('dom_ofertas', 'Configurações do Tema', 'Configurações Gerais', 'manage_options', 'dom_ofertas', 'dom_ofertas_create_page');
}
add_action('admin_menu', 'dom_ofertas_add_admin_page');

// Cria o conteúdo da página de opções
function dom_ofertas_create_page() {
    ?>
    <div class="wrap">
        <h1>Configurações do Tema</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('dom_ofertas_settings_group');
            do_settings_sections('dom_ofertas');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Registra as configurações do tema
function dom_ofertas_custom_settings() {
    register_setting('dom_ofertas_settings_group', 'store_name');
    register_setting('dom_ofertas_settings_group', 'store_cnpj');
    register_setting('dom_ofertas_settings_group', 'store_email');
    register_setting('dom_ofertas_settings_group', 'store_phone');

    add_settings_section('dom_ofertas_general_settings', 'Informações da Loja', 'dom_ofertas_general_settings_callback', 'dom_ofertas');

    add_settings_field('store_name', 'Nome da Loja', 'store_name_callback', 'dom_ofertas', 'dom_ofertas_general_settings');
    add_settings_field('store_cnpj', 'CNPJ da Loja', 'store_cnpj_callback', 'dom_ofertas', 'dom_ofertas_general_settings');
    add_settings_field('store_email', 'Email da Loja', 'store_email_callback', 'dom_ofertas', 'dom_ofertas_general_settings');
    add_settings_field('store_phone', 'Telefone da Loja', 'store_phone_callback', 'dom_ofertas', 'dom_ofertas_general_settings');
}
add_action('admin_init', 'dom_ofertas_custom_settings');

// Callbacks para os campos de entrada
function dom_ofertas_general_settings_callback() {
    echo 'Insira as informações da sua loja aqui.';
}

function store_name_callback() {
    $storeName = esc_attr(get_option('store_name'));
    echo '<input type="text" name="store_name" value="'.$storeName.'" placeholder="Nome da Loja" />';
}

function store_cnpj_callback() {
    $storeCnpj = esc_attr(get_option('store_cnpj'));
    echo '<input type="text" name="store_cnpj" value="'.$storeCnpj.'" placeholder="CNPJ da Loja" />';
}

function store_email_callback() {
    $storeEmail = esc_attr(get_option('store_email'));
    echo '<input type="text" name="store_email" value="'.$storeEmail.'" placeholder="Email da Loja" />';
}

function store_phone_callback() {
    $storePhone = esc_attr(get_option('store_phone'));
    echo '<input type="text" name="store_phone" value="'.$storePhone.'" placeholder="Telefone da Loja" />';
}
