<?php
require_once("conexion.php");

$id = 2;
$sql = "DELETE FROM usuarios WHERE id = ?";

$stmt = $conexion->prepare($sql);
$stmt -> bind_param("i", $id);

if ($stmt->execute()){
    echo "Ususario eliminado.";
} else {
    echo "Error al eliminar el usuario.";
}

$stmt->close();
$conexion->close();
?>