export function initCategorySlider() {
  const categories = document.querySelectorAll(".category-block");

  categories.forEach((category) => {
    const products = category.querySelector(".products");
    const productElements = Array.from(
      category.querySelectorAll(".products .product")
    );
    const prevButtonContainer = document.createElement("div");
    const nextButtonContainer = document.createElement("div");
    const prevButton = document.createElement("button");
    const nextButton = document.createElement("button");

    // Obter o valor de 1 rem em pixels
    const remInPixels = parseFloat(
      getComputedStyle(document.documentElement).fontSize
    );

    prevButtonContainer.className = "button-container prev-button-container";
    nextButtonContainer.className = "button-container next-button-container";
    prevButton.className = "prevButton";
    nextButton.className = "nextButton";

    prevButton.style.display = "none"; // Esconde o botão "Anterior" inicialmente

    // Obter as posições dos cards
    let cardPositions = productElements.map((el) => el.offsetLeft);

    // Função para atualizar as posições dos cards (para redimensionamento da janela)
    const updateCardPositions = () => {
      cardPositions = productElements.map((el) => el.offsetLeft);
    };

    // Função para atualizar a visibilidade dos botões
    const updateButtonsVisibility = () => {
      const maxScrollLeft = products.scrollWidth - products.clientWidth;
      const currentScrollLeft = products.scrollLeft;

      const tolerance = 1; // Ajuste conforme necessário para lidar com arredondamentos

      if (currentScrollLeft <= tolerance) {
        prevButton.style.display = "none";
      } else {
        prevButton.style.display = "block";
      }

      if (currentScrollLeft >= maxScrollLeft - tolerance) {
        nextButton.style.display = "none";
      } else {
        nextButton.style.display = "block";
      }
    };

    // Evento de rolagem para atualizar a visibilidade dos botões
    products.addEventListener("scroll", () => {
      updateButtonsVisibility();
    });

    // Botão "Anterior"
    prevButton.addEventListener("click", () => {
      const currentIndex = getCurrentCardIndex();
      const prevIndex = Math.max(0, currentIndex - 1);
      let prevPosition = cardPositions[prevIndex] - 3.25 * remInPixels; // Subtrai 1 rem em pixels

      // Garante que não seja menor que zero
      if (prevPosition < 0) {
        prevPosition = 0;
      }

      products.scrollTo({ left: prevPosition, behavior: "smooth" });
    });

    // Botão "Próximo"
    nextButton.addEventListener("click", () => {
      const currentIndex = getCurrentCardIndex();
      const nextIndex = Math.min(productElements.length - 1, currentIndex + 1);
      let nextPosition = cardPositions[nextIndex] - 3.25 * remInPixels; // Adiciona 1 rem em pixels

      // Garante que não ultrapasse o máximo de rolagem
      const maxScrollLeft = products.scrollWidth - products.clientWidth;
      if (nextPosition > maxScrollLeft) {
        nextPosition = maxScrollLeft;
      }

      products.scrollTo({ left: nextPosition, behavior: "smooth" });
    });

    // Função para encontrar o índice do card atual
    const getCurrentCardIndex = () => {
      const currentScrollLeft = products.scrollLeft;
      let closestIndex = 0;
      let closestDistance = Infinity;

      cardPositions.forEach((pos, index) => {
        const distance = Math.abs(pos - currentScrollLeft);
        if (distance < closestDistance) {
          closestDistance = distance;
          closestIndex = index;
        }
      });

      return closestIndex;
    };

    // Evento de redimensionamento para atualizar as posições dos cards
    window.addEventListener("resize", () => {
      updateCardPositions();
    });

    prevButtonContainer.appendChild(prevButton);
    nextButtonContainer.appendChild(nextButton);

    const sliderButtons = document.createElement("div");
    sliderButtons.className = "slider-buttons";
    sliderButtons.appendChild(prevButtonContainer);
    sliderButtons.appendChild(nextButtonContainer);

    category.style.position = "relative";
    category.appendChild(sliderButtons);

    // Atualiza a visibilidade dos botões inicialmente
    updateButtonsVisibility();
  });
}
