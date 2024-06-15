export function initNavHeightSync() {
    function syncNavHeight() {
        var mainImage = document.querySelector('.woocommerce-product-gallery__image.flex-active-slide');
        var nav = document.querySelector('.flex-control-nav');
        if (mainImage && nav) {
            nav.style.maxHeight = mainImage.clientHeight + 'px';
        }
    }

    // Chamar a função ao carregar e ao redimensionar a janela
    syncNavHeight();
    window.addEventListener('resize', syncNavHeight);

    // Também chamar a função após a alteração das imagens (se houver zoom)
    var observer = new MutationObserver(syncNavHeight);
    observer.observe(document.querySelector('.woocommerce-product-gallery__wrapper'), {
        attributes: true,
        childList: true,
        subtree: true
    });
}
