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
echo "Productos encontrados: " . $resultado->num_rows;

?>


<table width="100%" border="1">
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


<?php

while($producto = $resultado->fetch_assoc()){

?>


<tr>


<td>
<?= $producto["nombre"] ?>
</td>


<td>
$<?= $producto["precio"] ?>
</td>


<td>
<?= $producto["stock"] ?>
</td>


<td>
<?= $producto["categoria"] ?>
</td>


<td>


<a href="editar_producto.php?id=<?= $producto['id_producto'] ?>">

<button>
✏️ Editar
</button>

</a>



<a href="eliminar_producto.php?id=<?= $producto['id_producto'] ?>"
onclick="return confirm('¿Eliminar producto?')">


<button>
🗑️ Eliminar
</button>


</a>


</td>


</tr>


<?php

}

?>


</tbody>


</table>