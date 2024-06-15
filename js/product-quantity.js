export function initProductQuantity() {
    // Selecionar o input de quantidade existente
    const quantityInput = document.querySelector('.quantity input');

    if (quantityInput) {
        const quantityWrapper = document.createElement('div');
        quantityWrapper.className = 'quantity-wrapper';

        // Criar a estrutura da tabela
        const table = document.createElement('table');
        const tbody = document.createElement('tbody');
        const tr = document.createElement('tr');

        // Adicionar o span "Quantidade" dentro de um <th> com classe "label"
        const th = document.createElement('th');
        th.className = 'label';
        const quantityLabel = document.createElement('span');
        quantityLabel.textContent = 'Quantidade';
        quantityLabel.className = 'quantity-label';
        th.appendChild(quantityLabel);
        tr.appendChild(th);

        // Criar os botões de incremento e decremento e o display de quantidade dentro de um <td> com classe "quantity-td"
        const td = document.createElement('td');
        td.className = 'quantity-td';

        const decrementButton = document.createElement('button');
        decrementButton.type = 'button';
        decrementButton.textContent = '-';
        decrementButton.className = 'qtyminus';
        td.appendChild(decrementButton);

        const quantityDisplay = document.createElement('span');
        quantityDisplay.className = 'quantity-display';
        quantityDisplay.textContent = quantityInput.value;
        td.appendChild(quantityDisplay);

        const incrementButton = document.createElement('button');
        incrementButton.type = 'button';
        incrementButton.textContent = '+';
        incrementButton.className = 'qtyplus';
        td.appendChild(incrementButton);

        // Adicionar o input de quantidade ao wrapper, mas sem exibir
        td.appendChild(quantityInput);
        quantityInput.style.display = 'none';

        tr.appendChild(td);
        tbody.appendChild(tr);
        table.appendChild(tbody);
        quantityWrapper.appendChild(table);

        // Adicionar event listeners aos botões de incremento e decremento
        decrementButton.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value);
            if (!isNaN(currentValue) && currentValue > 1) {
                quantityInput.value = currentValue - 1;
                quantityDisplay.textContent = quantityInput.value;
                quantityInput.dispatchEvent(new Event('change')); // Atualizar o valor do input
            }
        });

        incrementButton.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value);
            if (!isNaN(currentValue)) {
                quantityInput.value = currentValue + 1;
                quantityDisplay.textContent = quantityInput.value;
                quantityInput.dispatchEvent(new Event('change')); // Atualizar o valor do input
            }
        });

        // Substituir o .quantity div pelo novo quantityWrapper
        const quantityDiv = document.querySelector('.quantity');
        quantityDiv.parentNode.replaceChild(quantityWrapper, quantityDiv);
    }
}
