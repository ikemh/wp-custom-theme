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
