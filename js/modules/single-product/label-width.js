export function initLabelWidth() {
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
}
