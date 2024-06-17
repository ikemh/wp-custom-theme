export function initCategorySlider() {
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
}
