export function initQuantityButtons() {
    function updateQuantity(input, isIncrement) {
        let currentValue = parseInt(input.value);
        if (!isNaN(currentValue)) {
            if (isIncrement) {
                input.value = currentValue + 1;
            } else {
                input.value = currentValue > 1 ? currentValue - 1 : 1;
            }
        }
    }

    // Add event listeners aos botões de quantidade
    document.querySelectorAll('.qtyminus').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.nextElementSibling;
            updateQuantity(input, false);
        });
    });

    document.querySelectorAll('.qtyplus').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.previousElementSibling;
            updateQuantity(input, true);
        });
    });
}
