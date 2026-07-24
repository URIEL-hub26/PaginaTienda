<?php

require_once("../PagRegistro/conexion.php");

$id = $_GET["id"];


// Obtener datos del usuario
$sql = "SELECT * FROM usuarios WHERE id_usuario = ?";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$resultado = $stmt->get_result();

$usuario = $resultado->fetch_assoc();



// Obtener roles disponibles
$sqlRoles = "SELECT * FROM roles";

$resultadoRoles = $conexion->query($sqlRoles);

?>

<!DOCTYPE html>
<html>

<head>
<title>Editar Usuario</title>
</head>


<body>


<h2>Editar Usuario</h2>


<form action="actualizar_usuario.php" method="POST">


<input type="hidden" 
name="id_usuario"
value="<?= $usuario['id_usuario'] ?>">



<label>Nombre:</label>

<input type="text" 
name="nombre"
value="<?= $usuario['nombre'] ?>">


<br>


<label>Apellido paterno:</label>

<input type="text" 
name="apellido_paterno"
value="<?= $usuario['apellido_paterno'] ?>">


<br>


<label>Apellido materno:</label>

<input type="text" 
name="apellido_materno"
value="<?= $usuario['apellido_materno'] ?>">


<br>


<label>Correo:</label>

<input type="email" 
name="correo"
value="<?= $usuario['correo'] ?>">


<br>


<label>Usuario:</label>

<input type="text" 
name="usuario"
value="<?= $usuario['usuario'] ?>">


<br>


<label>Teléfono:</label>

<input type="text" 
name="telefono"
value="<?= $usuario['telefono'] ?>">


<br><br>


<label>Rol:</label>


<select name="id_rol">


<?php

while($rol = $resultadoRoles->fetch_assoc()){


?>

<option 
value="<?= $rol['id_rol'] ?>"

<?php

if($rol['id_rol'] == $usuario['id_rol']){

    echo "selected";

}

?>

>

<?= $rol['nombre'] ?>

</option>


<?php

}

?>


</select>


<br><br>


<button type="submit">
Guardar cambios
</button>


</form>


</body>

</html>