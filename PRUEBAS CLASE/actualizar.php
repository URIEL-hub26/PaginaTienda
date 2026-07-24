<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Actualizar</title>
    </head>
    <body>
        <form action="editar.php" method="POST">
            <div class="form-group" style="padding-top: 50px">
                <label for="usuario">Usuario</label>
                <input type="text" id="usuario" name="usuario" required>
            </div>

            <div class="form-group"  style="padding-top: 50px">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group"  style="padding-top: 50px">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit">Enviar</button>
        </form>
    </body>

</html>
