<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmación de pedido</title>
    <link rel="stylesheet" href="../estilos/estiloFooter.css">
        <link rel="stylesheet" href="../estilos/estiloHeader.css">

    <link rel="stylesheet" href="../estilos/estiloPedido.css">

</head>

<body>
    <div id="header-placeholder"></div>

    <section id="contenedor-pedido">
    <div id="titulo-paso">
    <h2>7. CONFIRMACIÓN DE PEDIDO</h2>
        </div>
        <div id="caja-pedido">

            <h1>Confirmar pedido</h1>

            <div id="datos-entrega">
            <div class="tarjeta">
            <h3>Dirección de envío</h3>
                <p><b>María López</b></p>
                <p>Calle 5 #123, Col. Centro</p>
                <p>Ciudad de México, CDMX</p>
            <p>Tel. 55 1234 5678</p>
                <button>Cambiar dirección</button>
                </div>
            <div class="tarjeta">
                <h3>Tipo de entrega</h3>
                <div class="opcion-entrega">
                <input type="radio" name="entrega" checked>
                <div>
        <p><b>Envío a domicilio</b></p>
            <p>(Gratis en compras de $200 o más)</p>
            </div>
            </div>

                <div class="opcion-entrega">
                <input type="radio" name="entrega">
                <div>
                    <p><b>Recoger en tienda</b></p>
                    <p>Sin costo</p>
                </div>
                </div>
                </div>

            </div>

            <div id="resumen">
                <h3>Resumen del pedido</h3>

                <div class="fila">
                    <p>Subtotal:</p>
                    <p>$210.00</p>
                </div>

                <div class="fila">
                    <p>Envío:</p>
                    <p>$0.00</p>
                </div>

                <hr>

                <div class="fila total">
                    <p>Total a pagar:</p>
                    <p>$210.00</p>
                </div>

                <button id="btn-realizar">Realizar pedido</button>

                <div id="mensaje-pago">
                    <span>🛡️</span>
                    <p>Pagarás al recibir tu pedido</p>
                </div>
    </div>
</div>
</section>
<div id="footer-placeholder"></div>

</body>
<script>
    fetch('../PagHeader/header.html')
        .then(response => response.text())
        .then(data => {
            document.getElementById
                ('header-placeholder').innerHTML = data;
        }
        )
</script>
<script>
    fetch('../PagHeader/footer.html')
        .then(response => response.text())
        .then(data => {
            document.getElementById
                ('footer-placeholder').innerHTML = data;
        }
        )
</script>
</html>