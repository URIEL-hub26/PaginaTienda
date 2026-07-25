<?php
require_once("../PagRegistro/conexion.php");

$sql = "SELECT * FROM categorias";
$resultadoCategorias = $conexion->query($sql);

?>

<!DOCTYPE html>
<html>

<head>
<title>Agregar Producto</title>
</head>

<body>


<h2>Agregar Producto</h2>


<form action="guardar_producto.php" method="POST">


<label>Nombre:</label>
<input type="text" name="nombre" required>

<br><br>


<label>Descripción:</label>
<textarea name="descripcion"></textarea>

<br><br>


<label>Precio:</label>
<input type="number" 
step="0.01" 
name="precio" 
required>


<br><br>


<label>Cantidad:</label>

<input type="number" 
name="cantidad" 
required>


<br><br>


<label>Categoría:</label>

<select name="id_categoria">


<?php

while($categoria = $resultadoCategorias->fetch_assoc()){

?>
<option value="<?= $categoria['id_categoria'] ?>">
<?= $categoria['nombre'] ?>
</option>

<?php

}

?>

</select>


<br><br>


<button type="submit">

Guardar producto

</button>


</form>


</body>

</html>