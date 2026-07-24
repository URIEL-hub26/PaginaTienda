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


<table width="100%" border="1">

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