document.addEventListener('DOMContentLoaded', function () {
    import('./menu-toggle.js').then(module => module.initMenuToggle());
    import('./slider.js').then(module => module.initSlider());
    import('./category-slider.js').then(module => module.initCategorySlider());
    import('./nav-height-sync.js').then(module => module.initNavHeightSync());
    import('./quantity-buttons.js').then(module => module.initQuantityButtons());
    import('./installments.js').then(module => module.initInstallments());
    import('./product-variants.js').then(module => module.initProductVariants());
    import('./product-quantity.js').then(module => module.initProductQuantity());
    import('./label-width.js').then(module => module.initLabelWidth());
    import('./location.js').then(module => module.initLocation());
    import('./card-sticky.js').then(module => module.initCardSticky());
    import('./price-calculator.js').then(module => module.initPriceCalculator());
});