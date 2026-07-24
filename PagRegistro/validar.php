<?php
require_once("conexion.php");

session_start();

$email = $_POST["email"];
$password = $_POST["password"];

$sql="SELECT * FROM usuarios WHERE correo = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    if (password_verify($password, $fila["password"])){
        // Crear variables de sesion
$_SESSION["id_usuario"] = $fila["id_usuario"];
$_SESSION["usuario"] = $fila["usuario"];
$_SESSION["id_rol"] = $fila["id_rol"];
        //echo "Bienvenido". $_SESSION["usuario"];
        if ($fila["id_rol"] == 1) {
            header("Location: ../PagAdmin/PagAdmin.php");
        } elseif ($fila["id_rol"] == 2) {
            header("Location: ../PagEmpleado/empleado.php");
        } else {
            header("Location: ../PagInicio/index.php");
        } exit();
    } else {
        echo "<script>
                alert('Contraseña incorrecta');
                window.location='login.php';
            </script>";
    } 
}else {
        echo "<script>
            alert('El usuario no existe');
            window.location='login.php';
        </script>";
}

$stmt->close();
$conexion->close();
?>
