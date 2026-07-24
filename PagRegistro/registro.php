<!DOCTYPE html>
<html>
    <head>
        <title>Registro</title>
        <link rel="stylesheet" href="../estilos/registro.css">
        <link rel="stylesheet" href="../estilos/estiloFooter.css">
        <link rel="stylesheet" href="../estilos/estiloHeader.css">
    </head>
    <body>
        <div id="header-placeholder"></div>
<main>

<div class="container">
<div class="card">
<div class="logo">

<i class="fa-solid fa-user-plus"></i>

<h1>Crear cuenta</h1>

<p>Únete a NovaMart</p>

</div>

<form action="guardar.php" method="POST">

    <div class="row">

        <div class="input">
            <i class="fa-solid fa-user"></i>
            <input type="text" placeholder="Nombre" id="nombre" name="nombre" required>
        </div>

        <div class="input">
            <i class="fa-solid fa-user"></i>
            <input type="text" placeholder="Apellido paterno" id="apellido_paterno" name="apellido_paterno" required>
        </div>

    </div>

    <div class="input">
        <i class="fa-solid fa-user"></i>
        <input type="text" placeholder="Apellido materno" id="apellido_materno" name="apellido_materno">
    </div>

    <div class="input">
        <i class="fa-solid fa-user"></i>
        <input type="text" placeholder="Nombre de usuario" id="usuario" name="usuario" required>
    </div>

    <div class="input">
        <i class="fa-solid fa-envelope"></i>
        <input type="email" placeholder="Correo electrónico" id="correo" name="correo" required>
    </div>

    <div class="input">
        <i class="fa-solid fa-phone"></i>
        <input type="tel" placeholder="Teléfono" id="telefono" name="telefono">
    </div>

    <div class="input">
        <i class="fa-solid fa-lock"></i>
        <input type="password" placeholder="Contraseña" id="password" name="password" required>
    </div>

    <div class="terms">

        <input type="checkbox" id="terminos" required>

        <label for="terminos">
            Acepto los <a href="#">Términos y condiciones</a>
        </label>

    </div>

    <button type="submit" class="btn">
        Crear cuenta
    </button>

</form>

<div class="switch">

¿Ya tienes una cuenta?

<a href="login.php">

Iniciar sesión

</a>

</div>

</div>

</div>

</main>
<div id="footer-placeholder"></div>
    </body>
    <script>
        fetch('../PagHeader/header.html')
        .then(response => response.text())
        .then(data => {
            document.getElementById
            ('header-placeholder').innerHTML=data;
        }
        )
        </script>

    <script>
        fetch('../PagHeader/footer.html')
        .then(response => response.text())
        .then(data => {
            document.getElementById
            ('footer-placeholder').innerHTML=data;
        }
        )
        </script>