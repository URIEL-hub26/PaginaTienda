<?php

require_once("../PagRegistro/conexion.php");

session_start();

if(!isset($_SESSION["id_rol"]) || $_SESSION["id_rol"] != 1){

    header("Location: ../PagInicio/index.php");
    exit();

}


$nombre = $_POST["nombre"];
$descripcion = $_POST["descripcion"];
$precio = $_POST["precio"];
$stock = $_POST["stock"];
$imagen = $_FILES["imagen"];
$id_categoria = $_POST["id_categoria"];

$carpeta = "../PagInicio/imagenes/";

$nombreImagen = time() . "_" . basename($_FILES["imagen"]["name"]);

$rutaDestino = $carpeta . $nombreImagen;

if(move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaDestino)){

    // La imagen se guardó correctamente

}else{

    echo "<script>
            alert('Error al subir la imagen');
            history.back();
        </script>";

    exit();
}
$imagen = $nombreImagen;
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
    window.location='PagAdmin.php';
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