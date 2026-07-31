
<?php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../PagRegistro/login.php");
    exit();
}

include "../PagProductos/conexionProducto.php";

$id_usuario = $_SESSION['id_usuario'];

$sql = "SELECT productos.id_producto, productos.nombre, productos.precio, carrito.cantidad 
        FROM carrito 
        INNER JOIN productos ON carrito.id_producto = productos.id_producto 
        WHERE carrito.id_usuario = ?";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$resultado = $stmt->get_result();

$subtotal = 0;
$items = [];

while ($fila = $resultado->fetch_assoc()) {
    $fila['subtotal'] = $fila['precio'] * $fila['cantidad'];
    $subtotal += $fila['subtotal'];
    $items[] = $fila;
}

$costo_envio = ($subtotal >= 200 || $subtotal == 0) ? 0 : 50;
$total_final = $subtotal + $costo_envio;
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
<?php include '../PagHeader/header.php'; ?>    
    
    <main>
        <section class="contenedor-carrito">
            <h1>Mi carrito</h1>

            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th>Acciones</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($items) > 0): ?>
                        <?php foreach ($items as $prod): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($prod['nombre']); ?></td>
                                <td>$<?php echo number_format($prod['precio'], 2); ?></td>
                                <td>
                            <form action="actualizar_carrito.php" method="POST" class="form-cantidad">
                                 <input type="hidden" name="id_producto" value="<?php echo $prod['id_producto']; ?>">        
                                 <button type="submit" name="accion" value="restar" class="btn-cant">-</button>
                                <span class="num-cant"><?php echo $prod['cantidad']; ?></span>
                                <button type="submit" name="accion" value="sumar" class="btn-cant">+</button>
                            </form>
                            </td>

                                <td>$<?php echo number_format($prod['subtotal'], 2); ?></td>

                            <td>
                        <form action="actualizar_carrito.php" method="POST" style="margin: 0;">
                            <input type="hidden" name="id_producto" value="<?php echo $prod['id_producto']; ?>">
                            <button type="submit" name="accion" value="eliminar" class="btn-eliminar" onclick="return confirm('¿Deseas quitar este producto?');">
                                🗑️
                            </button>
                        </form>
                    </td>
                </tr>

                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 20px;">Tu carrito está vacío 🛒</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <div class="zona-inferior">
                <div class="cupon">
                    <p>¿Tienes un código de descuento?</p>
                    <input type="text" placeholder="Escribe tu código">
                    <button>Aplicar</button>
                </div>

                <div class="resumen">
                    <p>Subtotal: <strong>$<?php echo number_format($subtotal, 2); ?></strong></p>
                    <p>Envío: <strong>$<?php echo number_format($costo_envio, 2); ?></strong></p>
                    <h2>Total: <span>$<?php echo number_format($total_final, 2); ?></span></h2>
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

<?php include '../PagHeader/footer.php'; ?>

    
</body>
</html>