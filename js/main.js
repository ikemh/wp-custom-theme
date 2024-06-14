document.addEventListener('DOMContentLoaded', function (***REMOVED*** {
    console.log("DOM fully loaded and parsed"***REMOVED***;
}***REMOVED***;

document.addEventListener('DOMContentLoaded', function (***REMOVED*** {
    const menuToggle = document.querySelector('.menu-toggle'***REMOVED***;
    const nav = document.querySelector('.main-menu'***REMOVED***;

    menuToggle.addEventListener('click', function (***REMOVED*** {
        nav.classList.toggle('active'***REMOVED***;
    }***REMOVED***;
}***REMOVED***;


let slideIndex = 0;
showSlides(***REMOVED***;

function showSlides(***REMOVED*** {
    let i;
    let slides = document.getElementsByClassName("slide"***REMOVED***;
    let dots = document.getElementsByClassName("dot"***REMOVED***;
    for (i = 0; i < slides.length; i++***REMOVED*** {
        slides[i***REMOVED***.style.display = "none";  
    }
    slideIndex++;
    if (slideIndex > slides.length***REMOVED*** {slideIndex = 1}    
    for (i = 0; i < dots.length; i++***REMOVED*** {
        dots[i***REMOVED***.className = dots[i***REMOVED***.className.replace(" active", ""***REMOVED***;
    }
    if (slides[slideIndex-1***REMOVED******REMOVED*** {
        slides[slideIndex-1***REMOVED***.style.display = "block";  
    }
    if (dots[slideIndex-1***REMOVED******REMOVED*** {
        dots[slideIndex-1***REMOVED***.className += " active";
    }
    setTimeout(showSlides, 5000***REMOVED***; // Muda a imagem a cada 5 segundos
}


document.addEventListener('DOMContentLoaded', (***REMOVED*** => {
    const categories = document.querySelectorAll('.category-block'***REMOVED***;

    categories.forEach(category => {
        const products = category.querySelector('.products'***REMOVED***;
        const product = category.querySelector('.products .product'***REMOVED***;
        const prevButtonContainer = document.createElement('div'***REMOVED***;
        const nextButtonContainer = document.createElement('div'***REMOVED***;
        const prevButton = document.createElement('button'***REMOVED***;
        const nextButton = document.createElement('button'***REMOVED***;
        let scrollPosition = 0;

        prevButtonContainer.className = 'button-container prev-button-container';
        nextButtonContainer.className = 'button-container next-button-container';
        prevButton.className = 'prevButton';
        nextButton.className = 'nextButton';

        prevButton.style.display = 'none'; // Esconde o botão "Anterior" inicialmente

        const updateButtonsVisibility = (***REMOVED*** => {
            if (scrollPosition <= 0***REMOVED*** {
                prevButton.style.display = 'none';
            } else {
                prevButton.style.display = 'block';
            }

            if (scrollPosition >= (products.scrollWidth - products.clientWidth***REMOVED******REMOVED*** {
                nextButton.style.display = 'none';
            } else {
                nextButton.style.display = 'block';
            }
        };

        prevButton.addEventListener('click', (***REMOVED*** => {
            const productWidth = product.offsetWidth + parseInt(window.getComputedStyle(product***REMOVED***.marginRight***REMOVED***;
            scrollPosition -= productWidth;
            if (scrollPosition < 0***REMOVED*** scrollPosition = 0;
            products.scrollTo({ left: scrollPosition, behavior: 'smooth' }***REMOVED***;
            updateButtonsVisibility(***REMOVED***;
        }***REMOVED***;

        nextButton.addEventListener('click', (***REMOVED*** => {
            const productWidth = product.offsetWidth + parseInt(window.getComputedStyle(product***REMOVED***.marginRight***REMOVED***;
            scrollPosition += productWidth;
            if (scrollPosition > (products.scrollWidth - products.clientWidth***REMOVED******REMOVED*** {
                scrollPosition = products.scrollWidth - products.clientWidth;
            }
            products.scrollTo({ left: scrollPosition, behavior: 'smooth' }***REMOVED***;
            updateButtonsVisibility(***REMOVED***;
        }***REMOVED***;

        prevButtonContainer.appendChild(prevButton***REMOVED***;
        nextButtonContainer.appendChild(nextButton***REMOVED***;

        const sliderButtons = document.createElement('div'***REMOVED***;
        sliderButtons.className = 'slider-buttons';
        sliderButtons.appendChild(prevButtonContainer***REMOVED***;
        sliderButtons.appendChild(nextButtonContainer***REMOVED***;

        category.style.position = 'relative'; // Certifique-se de que o pai seja relativo para posicionar os botões absolutamente
        category.appendChild(sliderButtons***REMOVED***;

        updateButtonsVisibility(***REMOVED***; // Chama a função para definir a visibilidade dos botões inicialmente
    }***REMOVED***;
}***REMOVED***;


document.addEventListener('DOMContentLoaded', function(***REMOVED*** {
    function syncNavHeight(***REMOVED*** {
        var mainImage = document.querySelector('.woocommerce-product-gallery__image.flex-active-slide'***REMOVED***;
        var nav = document.querySelector('.flex-control-nav'***REMOVED***;
        if (mainImage && nav***REMOVED*** {
            nav.style.maxHeight = mainImage.clientHeight + 'px';
        }
    }

    // Chamar a função ao carregar e ao redimensionar a janela
    syncNavHeight(***REMOVED***;
    window.addEventListener('resize', syncNavHeight***REMOVED***;

    // Também chamar a função após a alteração das imagens (se houver zoom***REMOVED***
    var observer = new MutationObserver(syncNavHeight***REMOVED***;
    observer.observe(document.querySelector('.woocommerce-product-gallery__wrapper'***REMOVED***, {
        attributes: true,
        childList: true,
        subtree: true
    }***REMOVED***;
}***REMOVED***;

document.addEventListener('DOMContentLoaded', function(***REMOVED*** {
    function updateQuantity(input, isIncrement***REMOVED*** {
        let currentValue = parseInt(input.value***REMOVED***;
        if (!isNaN(currentValue***REMOVED******REMOVED*** {
            if (isIncrement***REMOVED*** {
                input.value = currentValue + 1;
            } else {
                input.value = currentValue > 1 ? currentValue - 1 : 1; // Evitar valores menores que 1
            }
        }
    }

    // Adiciona event listeners aos botões de quantidade
    document.querySelectorAll('.qtyminus'***REMOVED***.forEach(button => {
        button.addEventListener('click', function(***REMOVED*** {
            const input = this.nextElementSibling;
            updateQuantity(input, false***REMOVED***;
        }***REMOVED***;
    }***REMOVED***;

    document.querySelectorAll('.qtyplus'***REMOVED***.forEach(button => {
        button.addEventListener('click', function(***REMOVED*** {
            const input = this.previousElementSibling;
            updateQuantity(input, true***REMOVED***;
        }***REMOVED***;
    }***REMOVED***;
}***REMOVED***;

//PARCELAMENTO DO PRODUTO
document.addEventListener('DOMContentLoaded', function(***REMOVED*** {
    // Selecionar os elementos de preço original e preço atual
    var priceElement = document.querySelector('ins .woocommerce-Price-amount bdi'***REMOVED*** || document.querySelector('.woocommerce-Price-amount bdi'***REMOVED***;
    var originalPriceElement = document.querySelector('del .woocommerce-Price-amount bdi'***REMOVED***;
    var installmentsElement = document.querySelector('.installments-price'***REMOVED***;

    if (priceElement***REMOVED*** {
        // Extrair os preços e converter para número
        var priceText = priceElement.textContent.replace('R$', ''***REMOVED***.replace('.', ''***REMOVED***.replace(',', '.'***REMOVED***.trim(***REMOVED***;
        var price = parseFloat(priceText***REMOVED***;

        // Calcular e renderizar o parcelamento
        if (!isNaN(price***REMOVED*** && installmentsElement***REMOVED*** {
            var interestRate = 0.02; // Taxa de juros de 2% ao mês
            var installments = 12;
            var installmentPrice = (price * Math.pow(1 + interestRate, installments***REMOVED*** * interestRate***REMOVED*** / (Math.pow(1 + interestRate, installments***REMOVED*** - 1***REMOVED***;
            installmentPrice = installmentPrice.toFixed(2***REMOVED***.replace('.', ','***REMOVED***;
            installmentsElement.innerHTML = `em até 12x de <b>R$${installmentPrice}</b>`;
        }

        // Calcular e renderizar a economia
        if (originalPriceElement***REMOVED*** {
            var originalPriceText = originalPriceElement.textContent.replace('R$', ''***REMOVED***.replace('.', ''***REMOVED***.replace(',', '.'***REMOVED***.trim(***REMOVED***;
            var originalPrice = parseFloat(originalPriceText***REMOVED***;

            if (!isNaN(originalPrice***REMOVED*** && originalPrice > price***REMOVED*** {
                var savings = originalPrice - price;
                savings = Math.round(savings***REMOVED***; // Arredondar para o número inteiro mais próximo

                var savingsElement = document.createElement('p'***REMOVED***;
                savingsElement.classList.add('savings-amount'***REMOVED***;
                savingsElement.innerHTML = `Economize R$${savings}`;

                if (installmentsElement***REMOVED*** {
                    installmentsElement.parentNode.insertBefore(savingsElement, installmentsElement.nextSibling***REMOVED***;
                } else {
                    priceElement.parentNode.insertBefore(savingsElement, priceElement.nextSibling***REMOVED***;
                }
            }
        }
    }
}***REMOVED***;

//VARIANTES DO PRODUTO
document.addEventListener('DOMContentLoaded', function(***REMOVED*** {
    // Função para criar botões de variantes
    function createVariantButtons(selectElement***REMOVED*** {
        const wrapper = document.createElement('div'***REMOVED***;
        wrapper.className = 'variation-buttons';

        Array.from(selectElement.options***REMOVED***.forEach(option => {
            if (option.value === ''***REMOVED*** {
                // Ignorar a opção "Escolha uma opção"
                return;
            }

            const button = document.createElement('button'***REMOVED***;
            button.type = 'button';
            button.textContent = option.text;
            button.dataset.value = option.value;

            // Marcar o botão como ativo se for a opção selecionada
            if (option.selected***REMOVED*** {
                button.classList.add('active'***REMOVED***;
            }

            button.addEventListener('click', function(***REMOVED*** {
                // Atualizar a seleção no <select> original
                selectElement.value = this.dataset.value;
                // Disparar o evento de mudança para atualizar a variação
                const event = new Event('change', { bubbles: true }***REMOVED***;
                selectElement.dispatchEvent(event***REMOVED***;

                // Atualizar a aparência dos botões
                Array.from(wrapper.children***REMOVED***.forEach(btn => btn.classList.remove('active'***REMOVED******REMOVED***;
                this.classList.add('active'***REMOVED***;
            }***REMOVED***;

            wrapper.appendChild(button***REMOVED***;
        }***REMOVED***;

        // Substituir o <select> pelo wrapper com botões
        selectElement.style.display = 'none';
        selectElement.parentNode.insertBefore(wrapper, selectElement.nextSibling***REMOVED***;
    }

    // Converter todos os seletores de variações em botões
    const variationSelects = document.querySelectorAll('.variations select'***REMOVED***;
    variationSelects.forEach(select => {
        createVariantButtons(select***REMOVED***;
    }***REMOVED***;
}***REMOVED***;


//QUANTIDADE DO PRODUTO
document.addEventListener('DOMContentLoaded', function(***REMOVED*** {
    // Selecionar o input de quantidade existente
    const quantityInput = document.querySelector('.quantity input'***REMOVED***;

    if (quantityInput***REMOVED*** {
        const quantityWrapper = document.createElement('div'***REMOVED***;
        quantityWrapper.className = 'quantity-wrapper';

        // Criar a estrutura da tabela
        const table = document.createElement('table'***REMOVED***;
        const tbody = document.createElement('tbody'***REMOVED***;
        const tr = document.createElement('tr'***REMOVED***;

        // Adicionar o span "Quantidade" dentro de um <th> com classe "label"
        const th = document.createElement('th'***REMOVED***;
        th.className = 'label';
        const quantityLabel = document.createElement('span'***REMOVED***;
        quantityLabel.textContent = 'Quantidade';
        quantityLabel.className = 'quantity-label';
        th.appendChild(quantityLabel***REMOVED***;
        tr.appendChild(th***REMOVED***;

        // Criar os botões de incremento e decremento e o display de quantidade dentro de um <td> com classe "quantity-td"
        const td = document.createElement('td'***REMOVED***;
        td.className = 'quantity-td';

        const decrementButton = document.createElement('button'***REMOVED***;
        decrementButton.type = 'button';
        decrementButton.textContent = '-';
        decrementButton.className = 'qtyminus';
        td.appendChild(decrementButton***REMOVED***;

        const quantityDisplay = document.createElement('span'***REMOVED***;
        quantityDisplay.className = 'quantity-display';
        quantityDisplay.textContent = quantityInput.value;
        td.appendChild(quantityDisplay***REMOVED***;

        const incrementButton = document.createElement('button'***REMOVED***;
        incrementButton.type = 'button';
        incrementButton.textContent = '+';
        incrementButton.className = 'qtyplus';
        td.appendChild(incrementButton***REMOVED***;

        // Adicionar o input de quantidade ao wrapper, mas sem exibir
        td.appendChild(quantityInput***REMOVED***;
        quantityInput.style.display = 'none';

        tr.appendChild(td***REMOVED***;
        tbody.appendChild(tr***REMOVED***;
        table.appendChild(tbody***REMOVED***;
        quantityWrapper.appendChild(table***REMOVED***;

        // Adicionar event listeners aos botões de incremento e decremento
        decrementButton.addEventListener('click', function(***REMOVED*** {
            let currentValue = parseInt(quantityInput.value***REMOVED***;
            if (!isNaN(currentValue***REMOVED*** && currentValue > 1***REMOVED*** {
                quantityInput.value = currentValue - 1;
                quantityDisplay.textContent = quantityInput.value;
                quantityInput.dispatchEvent(new Event('change'***REMOVED******REMOVED***; // Atualizar o valor do input
            }
        }***REMOVED***;

        incrementButton.addEventListener('click', function(***REMOVED*** {
            let currentValue = parseInt(quantityInput.value***REMOVED***;
            if (!isNaN(currentValue***REMOVED******REMOVED*** {
                quantityInput.value = currentValue + 1;
                quantityDisplay.textContent = quantityInput.value;
                quantityInput.dispatchEvent(new Event('change'***REMOVED******REMOVED***; // Atualizar o valor do input
            }
        }***REMOVED***;

        // Substituir o .quantity div pelo novo quantityWrapper
        const quantityDiv = document.querySelector('.quantity'***REMOVED***;
        quantityDiv.parentNode.replaceChild(quantityWrapper, quantityDiv***REMOVED***;
    }
}***REMOVED***;



    

document.addEventListener('DOMContentLoaded', function(***REMOVED*** {
    // Selecione todas as th com a classe "label"
    const labels = document.querySelectorAll('th.label'***REMOVED***;
    
    // Encontre a largura máxima
    let maxWidth = 0;
    labels.forEach(label => {
        if (label.offsetWidth > maxWidth***REMOVED*** {
            maxWidth = label.offsetWidth;
        }
    }***REMOVED***;
    
    // Defina todas as th com a classe "label" para a largura máxima
    labels.forEach(label => {
        label.style.width = maxWidth + 'px';
    }***REMOVED***;
}***REMOVED***;

jQuery(document***REMOVED***.ready(function($***REMOVED*** {
    // Function to get the user's location based on IP
    function getLocation(***REMOVED*** {
        console.log("Chamando API de localização."***REMOVED***;
        $.get("https://ipapi.co/json/", function(response***REMOVED*** {
            console.log("Resposta da API:", response***REMOVED***;
            var city = response.city;
            var region = response.region;
            if (city && region***REMOVED*** {
                $('#location'***REMOVED***.text(city + ', ' + region***REMOVED***;
            } else {
                $('#location'***REMOVED***.text('sua localização'***REMOVED***;
            }
        }, "json"***REMOVED***.fail(function(***REMOVED*** {
            $('#location'***REMOVED***.text('sua localização'***REMOVED***;
        }***REMOVED***;
    }

    // Call the location function on page load
    getLocation(***REMOVED***;
}***REMOVED***;


document.addEventListener("DOMContentLoaded", function (***REMOVED*** {
    let lastScrollTop = 0;
    const cardSticky = document.querySelector(".card--sticky"***REMOVED***;
    const scrollIncrement = 80; // Incremento em pixels para cada unidade de rolagem

    window.addEventListener("scroll", function (***REMOVED*** {
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const cardHeight = cardSticky.offsetHeight;
        const windowHeight = window.innerHeight;

        if (cardHeight <= windowHeight***REMOVED*** {
            cardSticky.style.top = "0";
            return; // Se a altura do card não ultrapassar a altura da tela, manter o top em 0
        }

        const maxTop = 0;
        const minTop = -(cardHeight - windowHeight***REMOVED***;

        let currentTop = parseFloat(window.getComputedStyle(cardSticky***REMOVED***.top***REMOVED*** || 0;

        if (scrollTop > lastScrollTop***REMOVED*** {
            // Rolagem para baixo
            currentTop = Math.max(currentTop - scrollIncrement, minTop***REMOVED***;
        } else {
            // Rolagem para cima
            currentTop = Math.min(currentTop + scrollIncrement, maxTop***REMOVED***;
        }

        cardSticky.style.top = `${currentTop}px`;
        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // Evita números negativos
    }, false***REMOVED***;
}***REMOVED***;

document.addEventListener("DOMContentLoaded", function(***REMOVED*** {
    const priceElement = document.getElementById("final-price"***REMOVED***;

    if (priceElement***REMOVED*** {
        const productPriceText = priceElement.innerText;
        const productPrice = parseFloat(productPriceText.replace(/[^0-9,.-***REMOVED***+/g, ''***REMOVED***.replace(',', '.'***REMOVED******REMOVED***;

        const interestRate = 0.02; // Taxa de juros (2%***REMOVED***

        function calculateInstallment(price, rate, months***REMOVED*** {
            if (months === 1***REMOVED*** return price; // Sem juros para 1x
            const monthlyRate = rate / 12;
            return price * monthlyRate / (1 - Math.pow(1 + monthlyRate, -months***REMOVED******REMOVED***;
        }

        for (let i = 1; i <= 12; i++***REMOVED*** {
            const installmentElement = document.getElementById(`valor-installments-${i}`***REMOVED***;
            if (installmentElement***REMOVED*** {
                const installmentValue = calculateInstallment(productPrice, interestRate, i***REMOVED***;
                installmentElement.innerText = `R$${installmentValue.toFixed(2***REMOVED***}`;
            }
        }
    } else {
        console.error("Price element not found."***REMOVED***;
    }
}***REMOVED***;
