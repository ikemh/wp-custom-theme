//Ajustar altura do menu lateral da galeria de imagens do produto
export function initNavHeightSync() {
    function syncNavHeight() {
        var mainImage = document.querySelector('.woocommerce-product-gallery__image.flex-active-slide');
        var nav = document.querySelector('.flex-control-nav');
        if (mainImage && nav) {
            nav.style.maxHeight = mainImage.clientHeight + 'px';
        }
    }

    syncNavHeight();
    window.addEventListener('resize', syncNavHeight);

    var observer = new MutationObserver(syncNavHeight);
    observer.observe(document.querySelector('.woocommerce-product-gallery__wrapper'), {
        attributes: true,
        childList: true,
        subtree: true
    });
}
