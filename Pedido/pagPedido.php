
<?php
session_start();

// Validar si el usuario inició sesión
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../PagRegistro/login.php");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];
include '../PagProductos/conexionProducto.php';

// 1. CÁLCULO DEL TOTAL Y RESUMEN DESDE LA BASE DE DATOS 
$sql_monto = "SELECT SUM(c.cantidad * p.precio) AS subtotal 
              FROM carrito c 
              INNER JOIN productos p ON c.id_producto = p.id_producto 
              WHERE c.id_usuario = ?";
$stmt_monto = $conexion->prepare($sql_monto);
$stmt_monto->bind_param("i", $id_usuario);
$stmt_monto->execute();
$res_monto = $stmt_monto->get_result()->fetch_assoc();

$subtotal = $res_monto['subtotal'] ?? 0;
$costo_envio = ($subtotal >= 200 || $subtotal == 0) ? 0 : 50;
$total_final = $subtotal + $costo_envio;

// 2. PROCESAMIENTO DEL PEDIDO VÍA POST (FETCH)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    ob_clean();

    // Obtener los productos actuales del carrito
    $sql_carrito = "SELECT c.id_producto, c.cantidad, p.precio 
                    FROM carrito c 
                    INNER JOIN productos p ON c.id_producto = p.id_producto 
                    WHERE c.id_usuario = ?";
    $stmt = $conexion->prepare($sql_carrito);
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    $items = [];
    $subtotal_calculado = 0;

    while ($row = $resultado->fetch_assoc()) {
        $items[] = $row;
        $subtotal_calculado += $row['precio'] * $row['cantidad'];
    }

    if (empty($items)) {
        echo "carrito_vacio";
        exit();
    }

    // Calcular costo de envío y total final
    $envio_calculado = ($subtotal_calculado >= 200) ? 0 : 50;
    $total_con_envio = $subtotal_calculado + $envio_calculado;

    $fecha = date("Y-m-d H:i:s");
    $estado = "Pendiente";

    // Insertar en la tabla pedidos
    $sql_pedido = "INSERT INTO pedidos (id_usuario, fecha, total, estado) VALUES (?, ?, ?, ?)";
    $stmt_pedido = $conexion->prepare($sql_pedido);

    if (!$stmt_pedido) {
        echo "Error en la consulta de pedidos: " . $conexion->error;
        exit();
    }

    $stmt_pedido->bind_param("isds", $id_usuario, $fecha, $total_con_envio, $estado);

    if ($stmt_pedido->execute()) {
        $id_pedido = $conexion->insert_id;

        // Insertar cada producto en detalle_pedido
        $sql_det = "INSERT INTO detalle_pedido (id_pedido, id_producto, cantidad, precio_unitario, subtotal) VALUES (?, ?, ?, ?, ?)";
        $stmt_det = $conexion->prepare($sql_det);

        foreach ($items as $item) {
            $subtotal_prod = $item['precio'] * $item['cantidad'];
            $stmt_det->bind_param("iiidd", $id_pedido, $item['id_producto'], $item['cantidad'], $item['precio'], $subtotal_prod);
            $stmt_det->execute();
        }

        // Vaciar el carrito de la base de datos
        $sql_limpiar = "DELETE FROM carrito WHERE id_usuario = ?";
        $stmt_limpiar = $conexion->prepare($sql_limpiar);
        $stmt_limpiar->bind_param("i", $id_usuario);
        $stmt_limpiar->execute();

        echo "ok";
    } else {
        echo "Error MySQL al insertar pedido: " . $stmt_pedido->error;
    }
    exit();
}
?>

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
<?php include '../PagHeader/header.php'; ?>    <main>

    <section id="contenedor-pedido">
        <div id="titulo-paso">
            <h2>7. CONFIRMACIÓN DE PEDIDO</h2>
        </div>
        <div id="caja-pedido">
            <h1>Confirmar pedido</h1>

            <div id="datos-entrega">
                <div class="tarjeta">
                    <h3>Dirección de envío</h3>
                    
                    <div style="margin-bottom: 10px;">
                        <label style="font-size: 13px; color: #555;">Nombre completo:</label>
                        <input type="text" id="input-nombre" placeholder="Ej. María López" style="width: 100%; padding: 8px; margin-top: 4px; border: 1px solid #ccc; border-radius: 4px;" required>
                    </div>

                    <div style="margin-bottom: 10px;">
                        <label style="font-size: 13px; color: #555;">Dirección (Calle, número, colonia):</label>
                        <input type="text" id="input-direccion" placeholder="Ej. Calle 5 #123, Col. Centro" style="width: 100%; padding: 8px; margin-top: 4px; border: 1px solid #ccc; border-radius: 4px;" required>
                    </div>

                    <div style="margin-bottom: 10px;">
                        <label style="font-size: 13px; color: #555;">Teléfono de contacto:</label>
                        <input type="text" id="input-telefono" placeholder="Ej. 55 1234 5678" style="width: 100%; padding: 8px; margin-top: 4px; border: 1px solid #ccc; border-radius: 4px;" required>
                    </div>
                </div>

                <div class="tarjeta">
                    <h3>Tipo de entrega</h3>
                    <div class="opcion-entrega">
                        <input type="radio" name="entrega" value="domicilio" checked>
                        <div>
                            <p><b>Envío a domicilio</b></p>
                            <p>(Gratis en compras de $200 o más)</p>
                        </div>
                    </div>

                    <div class="opcion-entrega">
                        <input type="radio" name="entrega" value="tienda">
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
                    <p>$<?php echo number_format($subtotal, 2); ?></p>
                </div>

                <div class="fila">
                    <p>Envío:</p>
                    <p>$<?php echo number_format($costo_envio, 2); ?></p>
                </div>

                <hr>

                <div class="fila total">
                    <p>Total a pagar:</p>
                    <p>$<?php echo number_format($total_final, 2); ?></p>
                </div>

                <button id="btn-realizar">Realizar pedido</button>

                <div id="mensaje-pago">
                    <span>🛡️</span>
                    <p>Pagarás al recibir tu pedido</p>
                </div>
            </div>
        </div>
    </section>
<?php include '../PagHeader/footer.php'; ?>


    <script>
        document.getElementById("btn-realizar").addEventListener("click", function (e) {
            e.preventDefault();

            const nombre = document.getElementById("input-nombre").value.trim();
            const direccion = document.getElementById("input-direccion").value.trim();
            const telefono = document.getElementById("input-telefono").value.trim();
            const opcionSeleccionada = document.querySelector('input[name="entrega"]:checked').value;

            if (!nombre || !direccion || !telefono) {
                alert("Por favor, completa todos los campos de nombre, dirección y teléfono.");
                return;
            }

            const datos = "entrega=" + encodeURIComponent(opcionSeleccionada) +
                          "&nombre=" + encodeURIComponent(nombre) +
                          "&direccion=" + encodeURIComponent(direccion) +
                          "&telefono=" + encodeURIComponent(telefono);

            fetch("pagPedido.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: datos
            })
            .then(response => response.text())
            .then(respuesta => {
                if (respuesta.trim() === "ok") {
                    localStorage.removeItem('carrito'); // Limpiar carrito local
                    alert("¡Pedido realizado con éxito! 🛍️");
                    window.location.href = "../PagInicio/index.php";
                } else if (respuesta.trim() === "carrito_vacio") {
                    alert("Tu carrito está vacío.");
                } else {
                    alert("Ocurrió un error al procesar la compra.");
                    console.log("Respuesta del servidor:", respuesta);
                }
            })
            .catch(error => {
                console.error("Error en la petición:", error);
                alert("Ocurrió un error de conexión.");
            });
        });
    </script>

<?php include '../PagHeader/footer.php'; ?>

</body>

</html>