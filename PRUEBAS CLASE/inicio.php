<?php
session_start();
if (!isset($_SESSION["usuario"])){
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <tittle>Inicio</tittle>
</head>
<body>
    <h1>Bienvenido al sistema</h1>
    <p>
        usuario:
        <strong>
            <?php
            echo $_SESSION["usuario"];
            ?>
            </strong>
</p>
<a href="cerrar.php">Cerrar sesión</a>
</body>
</html>