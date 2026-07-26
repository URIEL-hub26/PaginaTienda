<?php
session_start();
// Conexión a la base de datos
require_once("../PagRegistro/conexion.php");

// Consultar todos los pedidos ordenados del más reciente al más antiguo
$sql = "SELECT p.id_pedido, p.id_usuario, u.nombre AS usuario_nombre, p.fecha, p.total, p.estado 
        FROM pedidos p 
        LEFT JOIN usuarios u ON p.id_usuario = u.id_usuario 
        ORDER BY p.fecha DESC";

$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Pedidos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 10px;
            background-color: #fff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #2e7d32;
            color: white;
            font-size: 0.9rem;
            text-transform: uppercase;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 0.85rem;
            font-weight: bold;
            background-color: #fff3cd;
            color: #856404;
        }
    </style>
</head>
<body>

<table>
    <thead>
        <tr>
            <th>ID Pedido</th>
            <th>ID Usuario</th>
            <th>Cliente</th>
            <th>Fecha</th>
            <th>Total</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($resultado && $resultado->num_rows > 0): ?>
            <?php while ($fila = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><strong>#<?php echo $fila['id_pedido']; ?></strong></td>
                    <td><?php echo $fila['id_usuario']; ?></td>
                    <td><?php echo htmlspecialchars($fila['usuario_nombre'] ?? 'Cliente Registrado'); ?></td>
                    <td><?php echo $fila['fecha']; ?></td>
                    <td><strong>$<?php echo number_format($fila['total'], 2); ?></strong></td>
                    <td>
                        <span class="badge">
                            <?php echo ucfirst($fila['estado']); ?>
                        </span>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" style="text-align: center; color: #777; padding: 20px;">
                    No hay ningún pedido registrado aún en la base de datos.
                </td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>