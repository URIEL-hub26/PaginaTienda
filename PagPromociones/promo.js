document.addEventListener("DOMContentLoaded", () => {
    const track = document.querySelector('.carousel-track');
    const container = document.querySelector('.carousel-container');
    const cards = document.querySelectorAll('.carousel-track .card');
    
    if (!track || cards.length === 0) return;

    let index = 0;
    const gap = 20; // El mismo valor que pusiste en el 'gap' del CSS

    function moverCarrusel() {
        // Calculamos cuántas tarjetas caben visibles en la pantalla actualmente
        const contenedorAncho = container.offsetWidth;
        const tarjetaAncho = cards[0].offsetWidth;
        const visibles = Math.round(contenedorAncho / (tarjetaAncho + gap));
        
        // El límite máximo al que puede avanzar antes de regresar al inicio
        const maxIndex = cards.length - visibles;

        index++;

        if (index > maxIndex) {
            index = 0; // Reinicia al primer producto
        }

        // Desplazamiento exacto de la tarjeta + su espacio
        const desplazamiento = index * (tarjetaAncho + gap);
        track.style.transform = `translateX(-${desplazamiento}px)`;
    }

    // Cambia de producto cada 3.5 segundos (3500 milisegundos)
    let intervalo = setInterval(moverCarrusel, 3500);

    // Si el usuario pasa el mouse por encima de un producto, pausamos el movimiento
    container.addEventListener('mouseenter', () => clearInterval(intervalo));
    
    // Cuando quita el mouse, continúa el carrusel automáticamente
    container.addEventListener('mouseleave', () => {
        intervalo = setInterval(moverCarrusel, 3500);
    });
});