<?php
session_start();
require "../PagRegistro/conexion.php";

// Verificar que sea administrador
if (!isset($_SESSION["id_usuario"]) || $_SESSION["id_rol"] != 1) {
    die("Acceso denegado.");
}

// Verificar que llegue el ID
if (!isset($_GET["id"])) {
    die("ID de producto no recibido.");
}

$id = intval($_GET["id"]);

// Eliminar producto
$sql = "DELETE FROM productos WHERE id_producto = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: productos.php?eliminado=1");
    exit;
} else {
    echo "Error al eliminar: " . $stmt->error;
}
?>