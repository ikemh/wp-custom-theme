<?php
// Custom add to cart text
function custom_add_to_cart_text() {
    return __('COMPRAR AGORA', 'woocommerce');
}
add_filter('woocommerce_product_single_add_to_cart_text', 'custom_add_to_cart_text');
add_filter('woocommerce_product_add_to_cart_text', 'custom_add_to_cart_text');

// Redirecionar para o checkout após adicionar ao carrinho
function custom_add_to_cart_redirect() {
    return wc_get_checkout_url();
}
add_filter('woocommerce_add_to_cart_redirect', 'custom_add_to_cart_redirect');

// Add custom body classes for cart and checkout pages
function add_custom_body_classes($classes) {
    if (is_cart()) {
        $classes[] = 'no-animation-cart';
    }
    if (is_checkout()) {
        $classes[] = 'no-animation-checkout';
    }
    return $classes;
}
add_filter('body_class', 'add_custom_body_classes');

// Função para atualizar a quantidade do carrinho via AJAX
function ajax_update_cart_quantity() {
    // Verifique o nonce para segurança
    check_ajax_referer('update-cart-nonce', 'nonce');

    // Pegue os dados do item do carrinho e a quantidade
    $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
    $quantity = intval($_POST['quantity']);

    // Certifique-se de que o item do carrinho existe
    if (!WC()->cart->get_cart_item($cart_item_key)) {
        wp_send_json_error(array('message' => 'Item do carrinho não encontrado.'));
    }

    if ($quantity <= 0) {
        wc_add_notice(__('Quantidade inválida.', 'woocommerce'), 'error');
        wp_send_json_error(array('message' => 'Quantidade inválida.'));
    }

    // Atualize a quantidade do item no carrinho
    WC()->cart->set_quantity($cart_item_key, $quantity);

    // Calcule os totais do carrinho novamente
    WC()->cart->calculate_totals();

    // Obtenha o total do carrinho
    $cart_total = WC()->cart->get_total();

    // Obtenha o preço unitário do produto
    $cart_item = WC()->cart->get_cart_item($cart_item_key);
    $product = $cart_item['data'];
    $product_price = $product->get_price();

    // Retorne a resposta atualizada do carrinho com mais dados
    wp_send_json_success(array(
        'message' => 'Quantidade do carrinho atualizada.',
        'cart_count' => WC()->cart->get_cart_contents_count(),
        'cart_total' => $cart_total,
        'product_price' => wc_price($product_price)
    ));
}
add_action('wp_ajax_update_cart_quantity', 'ajax_update_cart_quantity');
add_action('wp_ajax_nopriv_update_cart_quantity', 'ajax_update_cart_quantity');

