export function initProductVariants() {

    function createVariantButtons(selectElement) {
        const wrapper = document.createElement('div');
        wrapper.className = 'variation-buttons';

        Array.from(selectElement.options).forEach(option => {
            if (option.value === '') {
                return;
            }

            const button = document.createElement('button');
            button.type = 'button';
            button.textContent = option.text;
            button.dataset.value = option.value;

            if (option.selected) {
                button.classList.add('active');
            }

            button.addEventListener('click', function() {
                selectElement.value = this.dataset.value;
                const event = new Event('change', { bubbles: true });
                selectElement.dispatchEvent(event);

                Array.from(wrapper.children).forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
            });

            wrapper.appendChild(button);
        });

        selectElement.style.display = 'none';
        selectElement.parentNode.insertBefore(wrapper, selectElement.nextSibling);
    }

    const variationSelects = document.querySelectorAll('.variations select');
    variationSelects.forEach(select => {
        createVariantButtons(select);
    });
}

document.addEventListener('DOMContentLoaded', function() {
    function updateQuantity(input, isIncrement) {
        let currentValue = parseInt(input.value);
        if (!isNaN(currentValue)) {
            if (isIncrement) {
                input.value = currentValue + 1;
            } else {
                input.value = currentValue > 1 ? currentValue - 1 : 1; // Evitar valores menores que 1
            }
        }
    }

    // Adiciona event listeners aos botões de quantidade
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
});

