export function initPriceCalculator() {
    const priceElement = document.getElementById("final-price");

    if (priceElement) {
        const productPriceText = priceElement.innerText;
        const productPrice = parseFloat(productPriceText.replace(/[^0-9,.-]+/g, '').replace(',', '.'));

        const interestRate = 0.02; // Taxa de juros (2%)

        function calculateInstallment(price, rate, months) {
            if (months === 1) return price; // Sem juros para 1x
            const monthlyRate = rate / 12;
            return price * monthlyRate / (1 - Math.pow(1 + monthlyRate, -months));
        }

        for (let i = 1; i <= 12; i++) {
            const installmentElement = document.getElementById(`valor-installments-${i}`);
            if (installmentElement) {
                const installmentValue = calculateInstallment(productPrice, interestRate, i);
                installmentElement.innerText = `R$${installmentValue.toFixed(2)}`;
            }
        }
    } else {
        console.error("Price element not found.");
    }
}
