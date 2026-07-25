<?php

require_once("../PagRegistro/conexion.php");

$sql = "SELECT 
        usuarios.id_usuario,
        usuarios.nombre,
        usuarios.apellido_paterno,
        usuarios.apellido_materno,
        usuarios.correo,
        usuarios.usuario,
        usuarios.telefono,
        roles.nombre AS rol
        FROM usuarios
        INNER JOIN roles
        ON usuarios.id_rol = roles.id_rol";

$resultado = $conexion->query($sql);

?>

<!DOCTYPE html>
<html>
<head>

<style>

table{
    width:100%;
    border-collapse:collapse;
}

th,td{
    padding:10px;
    border:1px solid #ddd;
    text-align:center;
}

th{
    background:#2E7D32;
    color:white;
}

button{
    padding:8px;
    border:none;
    cursor:pointer;
}

.btn-editar{
    background:#2196F3;
    color:white;
}

.btn-rol{
    background:#FF9800;
    color:white;
}

.btn-eliminar{
    background:#F44336;
    color:white;
}

</style>

</head>

<body>


<table>

<thead>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Correo</th>
        <th>Usuario</th>
        <th>Teléfono</th>
        <th>Rol</th>
        <th>Acciones</th>
    </tr>
</thead>


<tbody>

<?php

while($fila = $resultado->fetch_assoc()){

?>

<tr>

<td>
<?= $fila["id_usuario"] ?>
</td>

<td>
<?= $fila["nombre"] ?>
</td>

<td>
<?= $fila["apellido_paterno"] . " " . $fila["apellido_materno"] ?>
</td>

<td>
<?= $fila["correo"] ?>
</td>

<td>
<?= $fila["usuario"] ?>
</td>

<td>
<?= $fila["telefono"] ?>
</td>

<td>
<?= $fila["rol"] ?>
</td>


<td>

<a href="editar_usuario.php?id=<?= $fila['id_usuario'] ?>">
    <button class="btn-editar">
        ✏️ Editar
    </button>
</a>


<a href="cambiar_rol.php?id=<?= $fila['id_usuario'] ?>">
    <button class="btn-rol">
        🔄 Rol
    </button>
</a>


<a href="eliminar_usuario.php?id=<?= $fila['id_usuario'] ?>"
onclick="return confirm('¿Seguro que deseas eliminar este usuario?')">

    <button class="btn-eliminar">
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


</body>
</html>