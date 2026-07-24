<?php

require_once("../PagRegistro/conexion.php");


$id = $_POST["id_usuario"];
$nombre = $_POST["nombre"];
$apellido_paterno = $_POST["apellido_paterno"];
$apellido_materno = $_POST["apellido_materno"];
$correo = $_POST["correo"];
$usuario = $_POST["usuario"];
$telefono = $_POST["telefono"];
$id_rol = $_POST["id_rol"];



$sql = "UPDATE usuarios SET

nombre=?,
apellido_paterno=?,
apellido_materno=?,
correo=?,
usuario=?,
telefono=?,
id_rol=?

WHERE id_usuario=?";



$stmt = $conexion->prepare($sql);



$stmt->bind_param(
"ssssssii",
$nombre,
$apellido_paterno,
$apellido_materno,
$correo,
$usuario,
$telefono,
$id_rol,
$id
);



if($stmt->execute()){


echo "

<script>

alert('Usuario actualizado correctamente');

window.location='usuarios.php';

</script>

";


}else{


echo "

<script>

alert('Error al actualizar');

history.back();

</script>

";


}


?>