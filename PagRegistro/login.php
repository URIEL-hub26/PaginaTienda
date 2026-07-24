<?php
session_start();
if (!isset($_SESSION["email"])){
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Iniciar sesión</title>
        <link rel="stylesheet" href="../estilos/estiloLogin.css">
        <link rel="stylesheet" href="../estilos/estiloFooter.css">
        <link rel="stylesheet" href="../estilos/estiloHeader.css">

    </head>
    <body>
                <div id="header-placeholder"></div>

<main>
<div class="container">

    <div class="card">

        <div class="logo">

            <i class="fa-solid fa-basket-shopping"></i>

            <h1>NovaMart</h1>

            <p>Bienvenido nuevamente</p>

        </div>

        <form action="validar.php" method="POST">

            <div class="input">

                <i class="fa-solid fa-envelope"></i>

                <input
                type="email"
                placeholder="Correo electrónico"
                id="email" name="email" required>

            </div>

            <div class="input">

                <i class="fa-solid fa-lock"></i>

                <input
                type="password"
                placeholder="Contraseña"
                id="password" name="password" required>

            </div>

            <div class="options">

                <label>

                    <input type="checkbox">

                    Recordarme

                </label>

                <a href="#">

                    ¿Olvidaste tu contraseña?

                </a>

            </div>

            <button class="btn">

                Iniciar sesión

            </button>

        </form>

        <div class="switch">

            ¿No tienes una cuenta?

            <a href="registro.php">

                Crear cuenta

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
    document.getElementById('header-placeholder').innerHTML = data;
});
</script>

<script>
fetch('../PagHeader/footer.html')
.then(response => response.text())
.then(data => {
    document.getElementById('footer-placeholder').innerHTML = data;
});
</script>