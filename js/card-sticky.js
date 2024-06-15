export function initCardSticky() {
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
}
