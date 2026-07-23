<?php
require_once("conexion.php");

session_start();

$usuario = $_POST["email"];
$password = $_POST["password"];

$sql="SELECT * FROM usuarios WHERE usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    if (password_verify($password, $fila["password"])){
        // Crear variables de sesion
    $_SESSION["id"] = $fila["id"];
    $_SESSION["usuario"] = $fila["usuario"];
        //echo "Bienvenido". $_SESSION["usuario"];
        header("location: inicio.php");
        exit();
    } else {
        echo "Contraseña incorrecta";
    } 
}else {
    echo "El usuario no existe.";
}

$stmt->close();
$conexion->close();
?>
