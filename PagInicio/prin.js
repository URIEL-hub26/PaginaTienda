
const tarjetas = document.querySelectorAll('#descripcion > div');
let indice = 0;

function ciclarTarjetas() {
    tarjetas.forEach(tarjeta => {
        tarjeta.style.display = 'none';
    });
    tarjetas[indice].style.display = 'block';
    indice = (indice + 1) % tarjetas.length;
}

if (tarjetas.length > 0) {
    ciclarTarjetas(); 
    setInterval(ciclarTarjetas, 3000); 
}
const imagen = document.querySelector('#imagen-banner img');
let subiendo = true;
let posicion = 0;

function flotarImagen() {
    if (subiendo) {
        posicion += 1;
        if (posicion >= 15) subiendo = false;
    } else {
        posicion -= 1;
        if (posicion <= 0) subiendo = true;
    }
    imagen.style.transform = `translateY(${posicion}px)`;
}

setInterval(flotarImagen, 30);