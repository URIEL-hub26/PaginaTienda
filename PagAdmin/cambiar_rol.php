<?php
require_once("../PagRegistro/conexion.php");
$id = $_GET["id"];
$sql = "UPDATE usuarios 
SET id_rol = 
CASE id_rol
WHEN 3 THEN 2
WHEN 2 THEN 1
WHEN 1 THEN 3
END
WHERE id_usuario=?";

$stmt=$conexion->prepare($sql);
$stmt->bind_param("i",$id);
$stmt->execute();

header("Location: usuarios.php");

?>