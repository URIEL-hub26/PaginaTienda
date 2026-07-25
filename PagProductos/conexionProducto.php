<?php
$host = "127.0.0.1";
$user = "root";
$password = ""; // Tu contraseña de MySQL de XAMPP (por defecto está vacía)
$database = "novamart"; // Asegúrate de escribir exactamente el nombre de tu BD

$conexion = mysqli_connect($host, $user, $password, $database);

if (!$conexion) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}
?>