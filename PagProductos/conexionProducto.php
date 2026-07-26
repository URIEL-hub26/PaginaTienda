<?php
$host = "127.0.0.1";
$user = "root";
$password = ""; 
$database = "novamart"; 
$conexion = mysqli_connect($host, $user, $password, $database);

if (!$conexion) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}
?>