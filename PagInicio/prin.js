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

const testimonios = [
    { nombre: "María G.", texto: "Excelente servicio, llegó a tiempo", estrellas: "⭐⭐⭐⭐⭐" },
    { nombre: "Carlos R.", texto: "Productos de buena calidad", estrellas: "⭐⭐⭐⭐" },
    { nombre: "Ana L.", texto: "Muy recomendable, compraré de nuevo", estrellas: "⭐⭐⭐⭐⭐" },
    { nombre: "Pedro M.", texto: "Los precios son muy accesibles", estrellas: "⭐⭐⭐⭐" }
];

let testimonioActual = 0;

function cambiarTestimonio() {
    testimonioActual = (testimonioActual + 1) % testimonios.length;
    const testimonio = testimonios[testimonioActual];
    
    const testimonioTexto = document.querySelector('.testimonio-texto');
    const testimonioNombre = document.querySelector('.testimonio-nombre');
    const testimonioEstrellas = document.querySelector('.testimonio-estrellas');
    
    if (testimonioTexto) testimonioTexto.textContent = `"${testimonio.texto}"`;
    if (testimonioNombre) testimonioNombre.textContent = `- ${testimonio.nombre}`;
    if (testimonioEstrellas) testimonioEstrellas.textContent = testimonio.estrellas;
}

setInterval(cambiarTestimonio, 4000);