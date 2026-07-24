<?php
require_once("conexion.php");

$id = 1;
$correo=$_POST["usuario"];
$password=password_hash($_POST["password"], PASSWORD_DEFAULT);

$sql = "UPDATE usuarios SET usuario =?, correo=?,password=? WHERE id =?";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("sssi", $usuario, $correo, $password, $id);

if ($stmt->execute()){
    echo "Usuario actualizado.";
}else {
    echo "Error al actualizar.";
}

$stmt->close();
$conexion->close();