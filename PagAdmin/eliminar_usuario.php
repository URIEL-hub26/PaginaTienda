<?php

require_once("../PagRegistro/conexion.php");

$id = $_GET["id"];


$sql = "DELETE FROM usuarios WHERE id_usuario=?";

$stmt = $conexion->prepare($sql);

$stmt->bind_param("i",$id);


if($stmt->execute()){

    header("Location: usuarios.php");

}else{

    echo "Error al eliminar";

}

?>