const tarjetas = document.querySelectorAll('#descripcion > div');
let indice = 0;

function ciclarTarjetas() {
    tarjetas.forEach(tarjeta => {
        tarjeta.style.display = 'none';
    });
    
}
    tarjetas[indice].style.display = '';
    indice = (indice + 1) % tarjetas.length;

if (tarjetas.length > 0) {
    ciclarTarjetas(); 
    setInterval(ciclarTarjetas, 3000); 
}