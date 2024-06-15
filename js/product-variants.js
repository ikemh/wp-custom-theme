export function initProductVariants() {
    // Função para criar botões de variantes
    function createVariantButtons(selectElement) {
        const wrapper = document.createElement('div');
        wrapper.className = 'variation-buttons';

        Array.from(selectElement.options).forEach(option => {
            if (option.value === '') {
                // Ignorar a opção "Escolha uma opção"
                return;
            }

            const button = document.createElement('button');
            button.type = 'button';
            button.textContent = option.text;
            button.dataset.value = option.value;

            // Marcar o botão como ativo se for a opção selecionada
            if (option.selected) {
                button.classList.add('active');
            }

            button.addEventListener('click', function() {
                // Atualizar a seleção no <select> original
                selectElement.value = this.dataset.value;
                // Disparar o evento de mudança para atualizar a variação
                const event = new Event('change', { bubbles: true });
                selectElement.dispatchEvent(event);

                // Atualizar a aparência dos botões
                Array.from(wrapper.children).forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
            });

            wrapper.appendChild(button);
        });

        // Substituir o <select> pelo wrapper com botões
        selectElement.style.display = 'none';
        selectElement.parentNode.insertBefore(wrapper, selectElement.nextSibling);
    }

    // Converter todos os seletores de variações em botões
    const variationSelects = document.querySelectorAll('.variations select');
    variationSelects.forEach(select => {
        createVariantButtons(select);
    });
}
