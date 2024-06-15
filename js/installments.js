export function initInstallments() {
    // Selecionar os elementos de preço original e preço atual
    var priceElement = document.querySelector('ins .woocommerce-Price-amount bdi') || document.querySelector('.woocommerce-Price-amount bdi');
    var originalPriceElement = document.querySelector('del .woocommerce-Price-amount bdi');
    var installmentsElement = document.querySelector('.installments-price');

    if (priceElement) {
        // Extrair os preços e converter para número
        var priceText = priceElement.textContent.replace('R$', '').replace('.', '').replace(',', '.').trim();
        var price = parseFloat(priceText);

        // Calcular e renderizar o parcelamento
        if (!isNaN(price) && installmentsElement) {
            var interestRate = 0.02; // Taxa de juros de 2% ao mês
            var installments = 12;
            var installmentPrice = (price * Math.pow(1 + interestRate, installments) * interestRate) / (Math.pow(1 + interestRate, installments) - 1);
            installmentPrice = installmentPrice.toFixed(2).replace('.', ',');
            installmentsElement.innerHTML = `em até 12x de <b>R$${installmentPrice}</b>`;
        }

        // Calcular e renderizar a economia
        if (originalPriceElement) {
            var originalPriceText = originalPriceElement.textContent.replace('R$', '').replace('.', '').replace(',', '.').trim();
            var originalPrice = parseFloat(originalPriceText);

            if (!isNaN(originalPrice) && originalPrice > price) {
                var savings = originalPrice - price;
                savings = Math.round(savings); // Arredondar para o número inteiro mais próximo

                var savingsElement = document.createElement('p');
                savingsElement.classList.add('savings-amount');
                savingsElement.innerHTML = `Economize R$${savings}`;

                if (installmentsElement) {
                    installmentsElement.parentNode.insertBefore(savingsElement, installmentsElement.nextSibling);
                } else {
                    priceElement.parentNode.insertBefore(savingsElement, priceElement.nextSibling);
                }
            }
        }
    }
}
