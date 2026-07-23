<?php
require_once("conexion.php");
$usuario=$_POST["usuario"];
$correo=$_POST["email"];
$password=password_hash($_POST["password"], PASSWORD_DEFAULT);

$sql="INSERT INTO usuarios (usuario, correo, password) VALUES (?, ?, ?)";
$stmt=$conexion->prepare($sql);
$stmt->bind_param("sss", $usuario, $correo, $password);

if ($stmt->execute()){
    echo"Ususario registrado.";
} else {
    echo "Error al registrar el usuario.";
}
$stmt->close();
?>