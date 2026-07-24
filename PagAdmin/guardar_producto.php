<?php

require_once("../PagRegistro/conexion.php");

session_start();


// Verificar que sea administrador

if(!isset($_SESSION["id_rol"]) || $_SESSION["id_rol"] != 1){

    header("Location: ../PagInicio/index.php");
    exit();

}


$nombre = $_POST["nombre"];
$descripcion = $_POST["descripcion"];
$precio = $_POST["precio"];
$stock = $_POST["stock"];
$imagen = $_POST["imagen"];
$id_categoria = $_POST["id_categoria"];


$sql = "INSERT INTO productos
(nombre, descripcion, precio, stock, imagen, id_categoria)
VALUES (?, ?, ?, ?, ?, ?)";


$stmt = $conexion->prepare($sql);


$stmt->bind_param(
    "ssdisi",
    $nombre,
    $descripcion,
    $precio,
    $stock,
    $imagen,
    $id_categoria
);


if($stmt->execute()){

    echo "
    <script>
    alert('Producto agregado correctamente');
    window.location='admin.php';
    </script>";

}else{

    echo "
    <script>
    alert('Error al guardar producto');
    window.location='admin.php';
    </script>";

}


$stmt->close();
$conexion->close();

?>