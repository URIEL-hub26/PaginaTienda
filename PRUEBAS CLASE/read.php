<?php
require_once("conexion.php");

$sql ="SELECT * FROM usuarios";
$resultado = $conexion -> query ($sql);

if($resultado -> num_rows > 0){
    while ($fila = $resultado -> fetch_assoc()){
        echo "Usuario: " . $fila["usuario"] . "<br>";
        echo "Correo: " . $fila["correo"] . "<br>";
    }
} else {
    echo "No hay usuarios registrados.";
}

$conexion->close();
?>