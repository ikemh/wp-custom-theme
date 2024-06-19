export function initCartQuantity() {
    // Selecionar todos os inputs de quantidade existentes
    const quantityDivs = document.querySelectorAll('.quantity');
    quantityDivs.forEach(quantityDiv => {
        const quantityInput = quantityDiv.querySelector('input');
        console.log('quantityInput:', quantityInput); // Verificação

        if (quantityInput) {
            const quantityWrapper = document.createElement('div');
            quantityWrapper.className = 'quantity-wrapper';

            // Criar a estrutura da tabela
            const table = document.createElement('table');
            const tbody = document.createElement('tbody');
            const tr = document.createElement('tr');

            // Criar os botões de incremento e decremento e o display de quantidade dentro de um <td> com classe "quantity-td"
            const td = document.createElement('td');
            td.className = 'quantity-td';

            const decrementButton = document.createElement('button');
            decrementButton.type = 'button';
            decrementButton.textContent = '-';
            decrementButton.className = 'qtyminus';
            td.appendChild(decrementButton);

            td.appendChild(quantityInput);
            quantityInput.className = 'quantity-input';

            const incrementButton = document.createElement('button');
            incrementButton.type = 'button';
            incrementButton.textContent = '+';
            incrementButton.className = 'qtyplus';
            td.appendChild(incrementButton);

            tr.appendChild(td);
            tbody.appendChild(tr);
            table.appendChild(tbody);
            quantityWrapper.appendChild(table);

            // Substituir o .quantity div pelo novo quantityWrapper
            console.log('quantityDiv:', quantityDiv); // Verificação
            quantityDiv.parentNode.replaceChild(quantityWrapper, quantityDiv);

            // Selecionar novamente os botões após a substituição
            const newDecrementButton = quantityWrapper.querySelector('.qtyminus');
            const newIncrementButton = quantityWrapper.querySelector('.qtyplus');

            // Adicionar event listeners aos botões de incremento e decremento
            newDecrementButton.addEventListener('click', function() {
                console.log('Decrement button clicked');
                let currentValue = parseInt(quantityInput.value);
                if (!isNaN(currentValue) && currentValue > 1) {
                    quantityInput.value = currentValue - 1;
                    quantityInput.dispatchEvent(new Event('change')); // Atualizar o valor do input
                }
            });

            newIncrementButton.addEventListener('click', function() {
                console.log('Increment button clicked');
                let currentValue = parseInt(quantityInput.value);
                if (!isNaN(currentValue)) {
                    quantityInput.value = currentValue + 1;
                    quantityInput.dispatchEvent(new Event('change')); // Atualizar o valor do input
                }
            });

            // Adicionar event listener ao input para atualizar a página quando o valor for alterado
            quantityInput.addEventListener('change', function() {
                console.log('Quantity input changed');
                let currentValue = parseInt(quantityInput.value);
                if (!isNaN(currentValue) && currentValue > 0) {
                    const updateCartButton = document.querySelector('button[name="update_cart"]');
                    if (updateCartButton) {
                        updateCartButton.click();
                    }
                }
            });
        }
    });
}
