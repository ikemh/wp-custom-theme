export function initMenuToggle() {
    const menuToggle = document.querySelector('.menu-toggle');
    const nav = document.querySelector('.main-menu');

    menuToggle.addEventListener('click', function () {
        nav.classList.toggle('active');
    });
}