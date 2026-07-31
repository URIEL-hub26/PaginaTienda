<?php
session_start();

if (!isset($_SESSION['id_usuario']) || !isset($_POST['id_producto']) || !isset($_POST['accion'])) {
    header("Location: carrito.php");
    exit();
}

include "../PagProductos/conexionProducto.php";

$id_usuario = $_SESSION['id_usuario'];
$id_producto = $_POST['id_producto'];
$accion = $_POST['accion'];

if ($accion === 'sumar') {

    $sql = "UPDATE carrito SET cantidad = cantidad + 1 WHERE id_usuario = ? AND id_producto = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ii", $id_usuario, $id_producto);
    $stmt->execute();

} elseif ($accion === 'restar') {
  
    $sql_cant = "SELECT cantidad FROM carrito WHERE id_usuario = ? AND id_producto = ?";
    $stmt = $conexion->prepare($sql_cant);
    $stmt->bind_param("ii", $id_usuario, $id_producto);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_assoc();

    if ($res) {
        if ($res['cantidad'] > 1) {
  
            $sql = "UPDATE carrito SET cantidad = cantidad - 1 WHERE id_usuario = ? AND id_producto = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("ii", $id_usuario, $id_producto);
            $stmt->execute();
        } else {
      
            $sql = "DELETE FROM carrito WHERE id_usuario = ? AND id_producto = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("ii", $id_usuario, $id_producto);
            $stmt->execute();
        }
    }

} elseif ($accion === 'eliminar') {

    $sql = "DELETE FROM carrito WHERE id_usuario = ? AND id_producto = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ii", $id_usuario, $id_producto);
    $stmt->execute();
}
header("Location: carrito.php");
exit();