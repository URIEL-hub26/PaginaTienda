<?php

session_start();

require "../PagRegistro/conexion.php";

if ($_SESSION["id_rol"] != 1) {
    die("Acceso denegado");
}

$id = $_POST["id_producto"];
$nombre = $_POST["nombre"];
$precio = $_POST["precio"];
$stock = $_POST["stock"];
$id_categoria = $_POST["id_categoria"];
$imagen = $_POST["imagen_actual"];

if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {

    $nombreImagen = time() . "_" . basename($_FILES["imagen"]["name"]);

    move_uploaded_file(
        $_FILES["imagen"]["tmp_name"],
        "../imagenes/productos/" . $nombreImagen
    );

    $imagen = $nombreImagen;
}
$sql = "UPDATE productos
SET nombre=?,
precio=?,
stock=?,
imagen=?,
id_categoria=?
WHERE id_producto=?";

$stmt = $conexion->prepare($sql);

$stmt->bind_param(
    "sdisii",
    $nombre,
    $precio,
    $stock,
    $imagen,
    $id_categoria,
    $id
);

if($stmt->execute()){

    header("Location: productos.php");
    exit();

}else{

    echo "Error: ".$stmt->error;

}