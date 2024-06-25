export function initCustonBtn() {

jQuery(document).ready(function($) {
    // Modificar botão "Adicionar ao Carrinho" na página do produto único
    $('.single_add_to_cart_button').each(function() {
        var button = $(this);
        button.html('<i class="fa-solid fa-bag-shopping"></i> ' + button.text());
    });

    // Modificar botão "Adicionar ao Carrinho" no loop de produtos
    $('.add_to_cart_button').each(function() {
        var button = $(this);
        button.html('<i class="fa-solid fa-bag-shopping"></i> ' + button.text());
    });
});
}