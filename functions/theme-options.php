<?php
// Adiciona a página de opções do tema
function dom_ofertas_add_admin_page(***REMOVED*** {
    add_menu_page('Configurações do Tema', 'Configurações do Tema', 'manage_options', 'dom_ofertas', 'dom_ofertas_create_page', 'dashicons-admin-generic', 110***REMOVED***;
    add_submenu_page('dom_ofertas', 'Configurações do Tema', 'Configurações Gerais', 'manage_options', 'dom_ofertas', 'dom_ofertas_create_page'***REMOVED***;
}
add_action('admin_menu', 'dom_ofertas_add_admin_page'***REMOVED***;

// Cria o conteúdo da página de opções
function dom_ofertas_create_page(***REMOVED*** {
    ?>
    <div class="wrap">
        <h1>Configurações do Tema</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('dom_ofertas_settings_group'***REMOVED***;
            do_settings_sections('dom_ofertas'***REMOVED***;
            submit_button(***REMOVED***;
            ?>
        </form>
    </div>
    <?php
}

// Registra as configurações do tema
function dom_ofertas_custom_settings(***REMOVED*** {
    register_setting('dom_ofertas_settings_group', 'store_name'***REMOVED***;
    register_setting('dom_ofertas_settings_group', 'store_cnpj'***REMOVED***;
    register_setting('dom_ofertas_settings_group', 'store_email'***REMOVED***;
    register_setting('dom_ofertas_settings_group', 'store_phone'***REMOVED***;

    add_settings_section('dom_ofertas_general_settings', 'Informações da Loja', 'dom_ofertas_general_settings_callback', 'dom_ofertas'***REMOVED***;

    add_settings_field('store_name', 'Nome da Loja', 'store_name_callback', 'dom_ofertas', 'dom_ofertas_general_settings'***REMOVED***;
    add_settings_field('store_cnpj', 'CNPJ da Loja', 'store_cnpj_callback', 'dom_ofertas', 'dom_ofertas_general_settings'***REMOVED***;
    add_settings_field('store_email', 'Email da Loja', 'store_email_callback', 'dom_ofertas', 'dom_ofertas_general_settings'***REMOVED***;
    add_settings_field('store_phone', 'Telefone da Loja', 'store_phone_callback', 'dom_ofertas', 'dom_ofertas_general_settings'***REMOVED***;
}
add_action('admin_init', 'dom_ofertas_custom_settings'***REMOVED***;

// Callbacks para os campos de entrada
function dom_ofertas_general_settings_callback(***REMOVED*** {
    echo 'Insira as informações da sua loja aqui.';
}

function store_name_callback(***REMOVED*** {
    $storeName = esc_attr(get_option('store_name'***REMOVED******REMOVED***;
    echo '<input type="text" name="store_name" value="'.$storeName.'" placeholder="Nome da Loja" />';
}

function store_cnpj_callback(***REMOVED*** {
    $storeCnpj = esc_attr(get_option('store_cnpj'***REMOVED******REMOVED***;
    echo '<input type="text" name="store_cnpj" value="'.$storeCnpj.'" placeholder="CNPJ da Loja" />';
}

function store_email_callback(***REMOVED*** {
    $storeEmail = esc_attr(get_option('store_email'***REMOVED******REMOVED***;
    echo '<input type="text" name="store_email" value="'.$storeEmail.'" placeholder="Email da Loja" />';
}

function store_phone_callback(***REMOVED*** {
    $storePhone = esc_attr(get_option('store_phone'***REMOVED******REMOVED***;
    echo '<input type="text" name="store_phone" value="'.$storePhone.'" placeholder="Telefone da Loja" />';
}
