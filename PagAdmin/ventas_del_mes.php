<?php
header('Content-Type: application/json');

require_once(__DIR__ . "/../PagRegistro/conexion.php");

if ($conexion->connect_error) {
    echo json_encode(['total_mes' => 0, 'error' => $conexion->connect_error]);
    exit();
}

$sql = "SELECT COALESCE(SUM(total), 0) AS total_mes 
        FROM pedidos 
        WHERE MONTH(fecha) = 7 AND YEAR(fecha) = 2026";

$resultado = $conexion->query($sql);

if ($resultado) {
    $fila = $resultado->fetch_assoc();
    echo json_encode([
        'total_mes' => (float)$fila['total_mes']
    ]);
} else {
    echo json_encode([
        'total_mes' => 0,
        'error' => $conexion->error
    ]);
}
?>