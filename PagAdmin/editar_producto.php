<?php
session_start();
require "../PagRegistro/conexion.php";

if ($_SESSION["id_rol"] != 1) {
    header("Location: ../PagInicio/index.php");
    exit();
}

if (!isset($_GET["id"])) {
    die("Producto no encontrado.");
}

$id = intval($_GET["id"]);

// Obtener producto
$sql = "SELECT * FROM productos WHERE id_producto = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$resultado = $stmt->get_result();
$producto = $resultado->fetch_assoc();

if (!$producto) {
    die("Producto no existe.");
}

// Obtener categorías
$sqlCategorias = "SELECT * FROM categorias";
$categorias = $conexion->query($sqlCategorias);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar producto</title>
<link rel="stylesheet" href="../estilos/editarProducto.css">
    
</head>

<body>
<div class="contenedor-editar">
<h2>Editar producto</h2>

<form action="actualizar_producto.php" method="POST" enctype="multipart/form-data">
<input type="hidden" name="id_producto" value="<?= $producto['id_producto'] ?>">

<label>Nombre</label>

<input
type="text"
name="nombre"
value="<?= htmlspecialchars($producto['nombre']) ?>"
required>

<label>Precio</label>

<input
type="number"
step="0.01"
name="precio"
value="<?= $producto['precio'] ?>"
required>

<label>Stock</label>

<input
type="number"
name="stock"
value="<?= $producto['stock'] ?>"
required>

<input type="hidden" name="imagen_actual" value="<?= $producto['imagen'] ?>">

<label>Imagen actual</label><br>

<img
class="imagen-producto"
src="../PagInicio/imagenes/<?= $producto['imagen'] ?>">
<br>
     <label>Nueva imagen</label>

<input
type="file"
name="imagen"
accept="image/png,image/jpeg,image/webp">

<small>Si no seleccionas una imagen, se conservará la actual.</small>
<label>Categoría</label>

<select name="id_categoria">

<?php while($categoria=$categorias->fetch_assoc()){ ?>

<option
value="<?= $categoria['id_categoria'] ?>"

<?= ($categoria['id_categoria']==$producto['id_categoria'])?'selected':''; ?>>

<?= $categoria['nombre'] ?>

</option>

<?php } ?>

</select>

<button type="submit">

Guardar cambios

</button>

</form>
</div>

</body>
</html>