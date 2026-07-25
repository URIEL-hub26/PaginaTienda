<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
</head>
<body>

<main>

<h1>Crear cuenta</h1>

<form action="guardar.php" method="POST">

    <input type="text" placeholder="Nombre de usuario" id="usuario" name="usuario" required>

    <input type="email" placeholder="Correo electrónico" id="email" name="email" required>

    <input type="password" placeholder="Contraseña" id="password" name="password" required>

    <input type="submit" value="Enviar">

</form>

</main>

</body>
</html>