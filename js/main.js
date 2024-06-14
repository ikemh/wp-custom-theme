document.addEventListener('DOMContentLoaded', function () {
    console.log("DOM fully loaded and parsed");
});

document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.querySelector('.menu-toggle');
    const nav = document.querySelector('.main-menu');

    menuToggle.addEventListener('click', function () {
        nav.classList.toggle('active');
    });
});


let slideIndex = 0;
showSlides();

function showSlides() {
    let i;
    let slides = document.getElementsByClassName("slide");
    let dots = document.getElementsByClassName("dot");
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";  
    }
    slideIndex++;
    if (slideIndex > slides.length) {slideIndex = 1}    
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    if (slides[slideIndex-1]) {
        slides[slideIndex-1].style.display = "block";  
    }
    if (dots[slideIndex-1]) {
        dots[slideIndex-1].className += " active";
    }
    setTimeout(showSlides, 5000); // Muda a imagem a cada 5 segundos
}


document.addEventListener('DOMContentLoaded', () => {
    const categories = document.querySelectorAll('.category-block');

    categories.forEach(category => {
        const products = category.querySelector('.products');
        const product = category.querySelector('.products .product');
        const prevButtonContainer = document.createElement('div');
        const nextButtonContainer = document.createElement('div');
        const prevButton = document.createElement('button');
        const nextButton = document.createElement('button');
        let scrollPosition = 0;

        prevButtonContainer.className = 'button-container prev-button-container';
        nextButtonContainer.className = 'button-container next-button-container';
        prevButton.className = 'prevButton';
        nextButton.className = 'nextButton';

        prevButton.style.display = 'none'; // Esconde o botão "Anterior" inicialmente

        const updateButtonsVisibility = () => {
            if (scrollPosition <= 0) {
                prevButton.style.display = 'none';
            } else {
                prevButton.style.display = 'block';
            }

            if (scrollPosition >= (products.scrollWidth - products.clientWidth)) {
                nextButton.style.display = 'none';
            } else {
                nextButton.style.display = 'block';
            }
        };

        prevButton.addEventListener('click', () => {
            const productWidth = product.offsetWidth + parseInt(window.getComputedStyle(product).marginRight);
            scrollPosition -= productWidth;
            if (scrollPosition < 0) scrollPosition = 0;
            products.scrollTo({ left: scrollPosition, behavior: 'smooth' });
            updateButtonsVisibility();
        });

        nextButton.addEventListener('click', () => {
            const productWidth = product.offsetWidth + parseInt(window.getComputedStyle(product).marginRight);
            scrollPosition += productWidth;
            if (scrollPosition > (products.scrollWidth - products.clientWidth)) {
                scrollPosition = products.scrollWidth - products.clientWidth;
            }
            products.scrollTo({ left: scrollPosition, behavior: 'smooth' });
            updateButtonsVisibility();
        });

        prevButtonContainer.appendChild(prevButton);
        nextButtonContainer.appendChild(nextButton);

        const sliderButtons = document.createElement('div');
        sliderButtons.className = 'slider-buttons';
        sliderButtons.appendChild(prevButtonContainer);
        sliderButtons.appendChild(nextButtonContainer);

        category.style.position = 'relative'; // Certifique-se de que o pai seja relativo para posicionar os botões absolutamente
        category.appendChild(sliderButtons);

        updateButtonsVisibility(); // Chama a função para definir a visibilidade dos botões inicialmente
    });
});


document.addEventListener('DOMContentLoaded', function() {
    function syncNavHeight() {
        var mainImage = document.querySelector('.woocommerce-product-gallery__image.flex-active-slide');
        var nav = document.querySelector('.flex-control-nav');
        if (mainImage && nav) {
            nav.style.maxHeight = mainImage.clientHeight + 'px';
        }
    }

    // Chamar a função ao carregar e ao redimensionar a janela
    syncNavHeight();
    window.addEventListener('resize', syncNavHeight);

    // Também chamar a função após a alteração das imagens (se houver zoom)
    var observer = new MutationObserver(syncNavHeight);
    observer.observe(document.querySelector('.woocommerce-product-gallery__wrapper'), {
        attributes: true,
        childList: true,
        subtree: true
    });
});

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

//PARCELAMENTO DO PRODUTO
document.addEventListener('DOMContentLoaded', function() {
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
});

//VARIANTES DO PRODUTO
document.addEventListener('DOMContentLoaded', function() {
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
});


//QUANTIDADE DO PRODUTO
document.addEventListener('DOMContentLoaded', function() {
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
});



    

document.addEventListener('DOMContentLoaded', function() {
    // Selecione todas as th com a classe "label"
    const labels = document.querySelectorAll('th.label');
    
    // Encontre a largura máxima
    let maxWidth = 0;
    labels.forEach(label => {
        if (label.offsetWidth > maxWidth) {
            maxWidth = label.offsetWidth;
        }
    });
    
    // Defina todas as th com a classe "label" para a largura máxima
    labels.forEach(label => {
        label.style.width = maxWidth + 'px';
    });
});

jQuery(document).ready(function($) {
    // Function to get the user's location based on IP
    function getLocation() {
        console.log("Chamando API de localização.");
        $.get("https://ipapi.co/json/", function(response) {
            console.log("Resposta da API:", response);
            var city = response.city;
            var region = response.region;
            if (city && region) {
                $('#location').text(city + ', ' + region);
            } else {
                $('#location').text('sua localização');
            }
        }, "json").fail(function() {
            $('#location').text('sua localização');
        });
    }

    // Call the location function on page load
    getLocation();
});


document.addEventListener("DOMContentLoaded", function () {
    let lastScrollTop = 0;
    const cardSticky = document.querySelector(".card--sticky");
    const scrollIncrement = 80; // Incremento em pixels para cada unidade de rolagem

    window.addEventListener("scroll", function () {
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const cardHeight = cardSticky.offsetHeight;
        const windowHeight = window.innerHeight;

        if (cardHeight <= windowHeight) {
            cardSticky.style.top = "0";
            return; // Se a altura do card não ultrapassar a altura da tela, manter o top em 0
        }

        const maxTop = 0;
        const minTop = -(cardHeight - windowHeight);

        let currentTop = parseFloat(window.getComputedStyle(cardSticky).top) || 0;

        if (scrollTop > lastScrollTop) {
            // Rolagem para baixo
            currentTop = Math.max(currentTop - scrollIncrement, minTop);
        } else {
            // Rolagem para cima
            currentTop = Math.min(currentTop + scrollIncrement, maxTop);
        }

        cardSticky.style.top = `${currentTop}px`;
        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // Evita números negativos
    }, false);
});

document.addEventListener("DOMContentLoaded", function() {
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
});
