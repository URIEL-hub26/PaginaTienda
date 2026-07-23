<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Promociones | NovaMart</title>
    <link rel="stylesheet" href="../estilos/estiloPromociones.css">
    <link rel="stylesheet" href="../estilos/estiloFooter.css">
        <link rel="stylesheet" href="../estilos/estiloHeader.css">
</head>

<body>
    <div id="header-placeholder"></div>
    <main>

        <section class="banner-slider">

    <div class="slide active">
        <h1>🍎 Hasta 50% de descuento en Frutas</h1>
        <p>Aprovecha nuestras ofertas de temporada.</p>
        <a href="#ofertas" class="btn-banner">Comprar ahora</a>
    </div>

    <div class="slide">
        <h1>🥤 2x1 en Bebidas</h1>
        <p>Solo durante este fin de semana.</p>
        <a href="#ofertas" class="btn-banner">Ver promoción</a>
    </div>

    <div class="slide">
        <h1>🛒 Envío gratis desde $200</h1>
        <p>Compra sin salir de casa.</p>
        <a href="#ofertas" class="btn-banner">Comprar</a>
    </div>

    <div class="indicadores">
        <span class="active"></span>
        <span></span>
        <span></span>
    </div>

</section>

        <section id="ofertas" class="ofertas">

            <h2>🔥 Ofertas destacadas</h2>

            <div class="grid">

                <div class="card">

                    <span class="descuento">-24%</span>

                    <img src="../PagInicio/imagenes/Arroz.webp" alt="Arroz">

                    <h3>Arroz 1 Kg</h3>

                    <p class="antes">$50.00</p>

                    <p class="precio">$38.00</p>

                </div>

                <div class="card">

                    <span class="descuento">-27%</span>

                    <img src="../PagInicio/imagenes/JabonBoltG.webp" alt="Jabón Bold">

                    <h3>Jabon Bold</h3>

                    <p class="antes">$89.90</p>

                    <p class="precio">$65.50</p>

                </div>

                <div class="card">

                    <span class="descuento">-30%</span>

                    <img src="../PagInicio/imagenes/Salsa Valentina.webp" alt="Salsa Valentina">

                    <h3>Salsa Valentina </h3>

                    <p class="antes">$25.00</p>

                    <p class="precio">$17.50</p>

                </div>

                <div class="card">

                    <span class="descuento">-21%</span>

                    <img src="../PagInicio/imagenes/Aceite C.webp" alt="Aceite">

                    <h3>Aceite 1L</h3>

                    <p class="antes">$70.00</p>

                    <p class="precio">$55.00</p>

                </div>

                <div class="card">

                    <span class="descuento">-28%</span>

                    <img src="../PagInicio/imagenes/FantaLat.webp" alt="Refresco">

                    <h3>Refresco 600ml</h3>

                    <p class="antes">$25.00</p>

                    <p class="precio">$18.00</p>

                </div>

            </div>

        </section>

        <section class="beneficios">
            <h2>⭐ Promociones Especiales</h2>
            <div class="beneficios-grid">

                <div>
                    <i class="fa-solid fa-gift"></i>
                    <h3>Compra 2 y lleva 3</h3>
                </div>

                <div>

                    <i class="fa-solid fa-truck"></i>

                    <h3>Envío gratis desde $200</h3>

                </div>

                <div>

                    <i class="fa-solid fa-apple-whole"></i>

                    <h3>15% en frutas y verduras</h3>

                </div>

            </div>

        </section>

    </main>

    <div id="footer-placeholder"></div>

    <script src="Prom.js"></script>

    <script>

        fetch('../PagHeader/header.html')
            .then(r => r.text())
            .then(data => {
                document.getElementById("header-placeholder").innerHTML = data;
            });

        fetch('../PagHeader/footer.html')
            .then(r => r.text())
            .then(data => {
                document.getElementById("footer-placeholder").innerHTML = data;
            });

    </script>

    <script>
fetch('../PagHeader/header.html')
.then(response => response.text())
.then(data => {
    document.getElementById('header-placeholder').innerHTML = data;
    // Esperamos un instante a que se pinte el DOM del header
    setTimeout(configurarBusquedaInicio, 100);
});
function configurarBusquedaInicio() {
    const inputBusqueda = document.getElementById('input-busqueda');

    if (inputBusqueda) {
        inputBusqueda.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                const texto = inputBusqueda.value.trim();
                if (texto !== "") {
                    // Guardamos el término en la memoria del navegador
                    localStorage.setItem('terminoBusqueda', texto);
                    // Redirigimos a la sección de productos
                    window.location.href = "../PagProductos/Productos.php";
                }
            }
        });
    }
}
</script>
</body>
<script>
    fetch('../PagHeader/header.html')
        .then(response => response.text())
        .then(data => {
            document.getElementById('header-placeholder').innerHTML = data;
        })
</script>

<script>
    fetch('../PagHeader/footer.html')
        .then(response => response.text())
        .then(data => {
            document.getElementById('footer-placeholder').innerHTML = data;
        })
</script>