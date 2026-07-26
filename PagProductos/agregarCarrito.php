<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// 2. Verificar que haya un usuario autenticado
if (!isset($_SESSION['id_usuario'])) {
    die("Debes iniciar sesión para agregar productos");
}

include 'conexionProducto.php';

// 3. Obtener el ID real del usuario de la sesión
$id_usuario = $_SESSION['id_usuario'];

if (!isset($_POST['id_producto'])) {
    die("No llegó el id_producto");
}

$id_producto = $_POST['id_producto'];

// Comprobar si el producto ya está en el carrito
$sql = "SELECT * FROM carrito WHERE id_usuario=? AND id_producto=?";
$stmt = $conexion->prepare($sql);

if (!$stmt) {
    die("Error en prepare SELECT: " . $conexion->error);
}

$stmt->bind_param("ii", $id_usuario, $id_producto);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    // Si existe, aumentar cantidad
    $sql = "UPDATE carrito SET cantidad=cantidad+1 WHERE id_usuario=? AND id_producto=?";
    $stmt = $conexion->prepare($sql);
    
    if (!$stmt) {
        die("Error en prepare UPDATE: " . $conexion->error);
    }
    
    $stmt->bind_param("ii", $id_usuario, $id_producto);
    $stmt->execute();
} else {
    // Si no existe, insertar nuevo registro
    $cantidad = 1;
    $sql = "INSERT INTO carrito(id_usuario, id_producto, cantidad) VALUES(?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    
    if (!$stmt) {
        die("Error en prepare INSERT: " . $conexion->error);
    }
    
    $stmt->bind_param("iii", $id_usuario, $id_producto, $cantidad);
    $stmt->execute();
}

// Única salida al cliente cuando todo sale bien:
echo "ok";
?>