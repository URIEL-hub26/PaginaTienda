<?php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../PagRegistro/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de compras</title>
    <link rel="stylesheet" href="../estilos/estiloCarrito.css">
    <link rel="stylesheet" href="../estilos/estiloFooter.css">
        <link rel="stylesheet" href="../estilos/estiloHeader.css">
</head>
<body>
        <div id="header-placeholder"></div>
        <main>

    <section class="contenedor-carrito">

        <h1>Mi carrito</h1>

       <table>

<tr>
<th>Producto</th>
<th>Precio</th>
<th>Cantidad</th>
<th>Subtotal</th>
</tr>

<?php

include "../PagProductos/conexionProducto.php";

$id_usuario = $_SESSION['id_usuario'];

$sql="SELECT productos.nombre,
productos.precio,
carrito.cantidad
FROM carrito
INNER JOIN productos
ON carrito.id_producto=productos.id_producto
WHERE carrito.id_usuario=$id_usuario";

$resultado=mysqli_query($conexion,$sql);
$total=0;

while($fila=mysqli_fetch_assoc($resultado)){

$subtotal=$fila['precio']*$fila['cantidad'];

$total+=$subtotal;

echo "

<tr>

<td>{$fila['nombre']}</td>

<td>$".$fila['precio']."</td>

<td>{$fila['cantidad']}</td>

<td>$".$subtotal."</td>

</tr>

";

}

?>

</table>

        <div class="zona-inferior">
            <div class="cupon">
                <p>¿Tienes un código de descuento?</p>
                <input type="text" placeholder="Escribe tu código">
                <button>Aplicar</button>
            </div>

            <div class="resumen">
                <p>Subtotal: <strong>$<?php echo number_format($total,2); ?></strong></p>
                 <p>Envío: <strong>$0.00</strong></p>
                 <h2>Total:
                 <span>$<?php echo number_format($total,2); ?></span>
                  </h2>
        
            </div>
        </div>

        <button class="btn-comprar" onclick="window.location.href='../Pedido/pagPedido.php'">
            Continuar compra
        </button>

        <div class="aviso">
            El envío a domicilio aplica en compras de $200 o más.
        </div>

    </section>
        </main>
        <div id="footer-placeholder"></div>

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
    <script src="carrito.js"></script>
</html>