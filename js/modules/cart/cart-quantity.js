export function initCartQuantity() {
    const quantityDivs = document.querySelectorAll('.quantity');
    quantityDivs.forEach(quantityDiv => {
        const quantityInput = quantityDiv.querySelector('input');

        if (quantityInput) {
            const quantityWrapper = document.createElement('div');
            quantityWrapper.className = 'quantity-wrapper';

            const table = document.createElement('table');
            const tbody = document.createElement('tbody');
            const tr = document.createElement('tr');

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

            quantityDiv.parentNode.replaceChild(quantityWrapper, quantityDiv);

            const newDecrementButton = quantityWrapper.querySelector('.qtyminus');
            const newIncrementButton = quantityWrapper.querySelector('.qtyplus');

            newDecrementButton.addEventListener('click', function() {
                let currentValue = parseInt(quantityInput.value);
                if (!isNaN(currentValue) && currentValue > 1) {
                    quantityInput.value = currentValue - 1;
                    quantityInput.dispatchEvent(new Event('change'));
                }
            });

            newIncrementButton.addEventListener('click', function() {
                let currentValue = parseInt(quantityInput.value);
                if (!isNaN(currentValue)) {
                    quantityInput.value = currentValue + 1;
                    quantityInput.dispatchEvent(new Event('change'));
                }
            });

            quantityInput.addEventListener('change', function() {
                let currentValue = parseInt(quantityInput.value);
                if (!isNaN(currentValue) && currentValue > 0) {
                    // Extrair a chave correta do item do carrinho
                    const cartItemKey = quantityInput.name.match(/cart\[(.*?)\]\[qty\]/)[1];
                    updateCartQuantity(cartItemKey, currentValue);
                }
            });
        }
    });
}

async function updateCartQuantity(cartItemKey, quantity) {
    try {
        const response = await fetch(cart_quantity_params.ajax_url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
            },
            body: new URLSearchParams({
                action: 'update_cart_quantity',
                cart_item_key: cartItemKey,
                quantity: quantity,
                nonce: cart_quantity_params.nonce
            })
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();

        if (data.success) {
            console.log('Response data:', data);

            // Atualize o contador de itens do carrinho no header
            const cartCount = document.querySelector('.cart-count');
            if (cartCount) {
                const newCartCount = data.data.cart_count.toString();
                cartCount.textContent = newCartCount;
            }

            // Atualize o total do carrinho na página
            const cartTotalElement = document.querySelector('.cart-total');
            if (cartTotalElement) {
                cartTotalElement.textContent = data.data.cart_total;
            }

            // Atualize o preço do produto na página
            const productRow = document.querySelector(`tr[data-cart-item-key="${cartItemKey}"]`);
            if (productRow) {
                const productPriceElement = productRow.querySelector('.product-subtotal .woocommerce-Price-amount.amount');
                if (productPriceElement) {
                    const priceString = data.data.product_price.match(/&nbsp;([\d.,]+)/)[1].replace('.', '').replace(',', '.');
                    const priceNumber = parseFloat(priceString) * quantity;

                    // Formate o novo valor para exibição
                    const formattedPrice = new Intl.NumberFormat('pt-BR', {
                        style: 'currency',
                        currency: 'BRL'
                    }).format(priceNumber);

                    // Atualize o HTML com o novo valor
                    productPriceElement.innerHTML = formattedPrice;
                }
            }

            const priceSubtotal = document.querySelector('.order-total .woocommerce-Price-amount.amount');
            if (priceSubtotal) {
                priceSubtotal.innerHTML = data.data.cart_total.toString() ;
            }

            const priceTotal = document.querySelector('.cart-subtotal .woocommerce-Price-amount.amount');
            if (priceTotal) {
                priceTotal.innerHTML = data.data.cart_total.toString() ;
            }
        } else {
            throw new Error(data.data.message);
        }
    } catch (error) {
        console.error('Error updating cart:', error);
    }
}
