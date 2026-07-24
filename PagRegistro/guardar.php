<?php
require_once("conexion.php");
$nombre = $_POST["nombre"];
$apellidoP = $_POST["apellido_paterno"];
$apellidoM = $_POST["apellido_materno"];
$correo = $_POST["correo"];
$usuario = $_POST["usuario"];
$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
$telefono = $_POST["telefono"];
$id_rol=3;

$sql="INSERT INTO usuarios (nombre, apellido_paterno, apellido_materno, usuario, correo, telefono, password, id_rol)
VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt=$conexion->prepare($sql);
$stmt->bind_param( "sssssssi",
    $nombre,
    $apellidoP,
    $apellidoM,
    $usuario,
    $correo,
    $telefono,
    $password,
    $id_rol);

if ($stmt->execute()){
echo "<script>
                alert('Registrado con exito. ¡Bienvenido!');
                window.location='../PagInicio/index.php';
            </script>";
} else {
    echo "Error al registrar el usuario. ". $stmt->error;
}
$stmt->close();
$conexion->close();
?>