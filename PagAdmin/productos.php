<?php

require_once("../PagRegistro/conexion.php");

$sql = "SELECT 
        productos.id_producto,
        productos.nombre,
        productos.precio,
        productos.stock,
        categorias.nombre AS categoria
        FROM productos
        INNER JOIN categorias
        ON productos.id_categoria = categorias.id_categoria";

$resultado = $conexion->query($sql);

?>

<!DOCTYPE html>
<html>

<head>
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

        th,
        td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
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

        /* Estilos de botones estándar */
        button {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: bold;
        }

        .btn-editar {
            background: #2196F3;
            color: white;
        }

        .btn-eliminar {
            background: #F44336;
            color: white;
        }
    </style>
</head>

<body>

    <table>

        <thead>
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Categoría</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>

            <?php while ($producto = $resultado->fetch_assoc()) { ?>

                <tr>
                    <td><?= $producto["nombre"] ?></td>
                    <td>$<?= number_format($producto["precio"], 2) ?></td>
                    <td><?= $producto["stock"] ?></td>
                    <td><?= $producto["categoria"] ?></td>
                    <td>
                        <a href="editar_producto.php?id=<?= $producto['id_producto'] ?>">
                            <button class="btn-editar">✏️ Editar</button>
                        </a>
                        <a href="eliminar_producto.php?id=<?= $producto['id_producto'] ?>"
                           onclick="return confirm('¿Eliminar producto?')">
                            <button class="btn-eliminar">🗑️ Eliminar</button>
                        </a>
                    </td>
                </tr>

            <?php } ?>

        </tbody>

    </table>

</body>

</html>