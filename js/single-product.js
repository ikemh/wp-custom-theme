import { initNavHeightSync } from './modules/single-product/nav-height-sync.js';
import { initCardSticky } from './modules/single-product/card-sticky.js';
import { initPriceCalculator } from './modules/single-product/price-calculator.js';
import { initProductVariants } from './modules/single-product/product-variants.js';
import { initProductQuantity } from './modules/single-product/product-quantity.js';
import { initQuantityButtons } from './modules/single-product/quantity-buttons.js';
import { initInstallments } from './modules/single-product/installments.js';
import { initLabelWidth } from './modules/single-product/label-width.js';
import { initLocation } from './modules/single-product/location.js';

document.addEventListener('DOMContentLoaded', function () {
    initNavHeightSync();
    initCardSticky();
    initPriceCalculator();
    initProductVariants();
    initProductQuantity();
    initQuantityButtons();
    initInstallments();
    initLabelWidth();
    initLocation();
});
