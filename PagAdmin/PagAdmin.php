<?php
session_start();

require_once("../PagRegistro/conexion.php");

if (!isset($_SESSION["id_usuario"])) {
    header("Location: ../PagLogin/login.php");
    exit();
}

if ($_SESSION["id_rol"] != 1) {
    header("Location: ../PagInicio/index.php");
    exit();
}


$sqlCategorias = "SELECT * FROM categorias";

$categorias = $conexion->query($sqlCategorias);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>NovaMart Admin</title>
    <link rel="stylesheet" href="../estilos/estiloAdmn.css">
    <link rel="stylesheet" href="../estilos/estiloFooter.css">
    <link rel="stylesheet" href="../estilos/estiloHeader.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <aside>
        <h2>🛒 NovaMart</h2>
        <ul>
            <li onclick="show('dashboard')">Dashboard</li>
            <li onclick="show('productos')">Productos</li>
            <li onclick="show('usuarios')">Usuarios</li>
            <li onclick="show('pedidos')">Pedidos</li>
            <li onclick="show('reportes')">Reportes</li>
            <li onclick="show('config')">Configuración</li>
        </ul>
    </aside>
    <main>
        <section id="dashboard" class="active">
            <h1>Dashboard</h1>
            <div class="cards">
                <div class="card">
                    <h3>Productos</h3>
                    <h2>250</h2>
                </div>
                
                <div class="card">
                    <h3>Ventas</h3>
                    <h2>75</h2>
                </div>
                <div class="card">
                    <h3>Clientes</h3>
                    <h2>120</h2>
                </div>
                <div class="card">
                    <h3>Ingresos</h3>
                    <h2>$15,240</h2>
                </div>
            </div>
        </section>
        <section id="productos">

<h1>Productos</h1>

<button onclick="show('agregarProducto')">
➕ Agregar producto
</button>


<iframe 
src="productos.php"
width="100%"
height="500px"
style="border:none;">
</iframe>


</section>
        <section id="agregarProducto">

    <h1>Agregar producto</h1>

    <form action="guardar_producto.php" method="POST">

        <div>
            <label>Nombre:</label>
            <input type="text" name="nombre" required>
        </div>

        <div>
            <label>Descripción:</label>
            <textarea name="descripcion"></textarea>
        </div>

        <div>
            <label>Precio:</label>
            <input type="number" step="0.01" name="precio" required>
        </div>

        <div>
            <label>Stock:</label>
            <input type="number" name="stock" required>
        </div>

        <div>
            <label>Imagen:</label>
            <input type="text" name="imagen">
        </div>

        <div>

<label>Categoría:</label>

<select name="id_categoria" required>


<?php

while($categoria = $categorias->fetch_assoc()){

?>

<option value="<?= $categoria['id_categoria'] ?>">

<?= $categoria['nombre'] ?>

</option>


<?php

}

?>

</select>

</div>


        <button type="submit">
            Guardar producto
        </button>

    </form>

</section>
        <section id="usuarios">

    <h1>Usuarios registrados</h1>

    <iframe 
        src="usuarios.php"
        width="100%"
        height="500px"
        style="border:none;">
    </iframe>

</section>
        <section id="pedidos">
            <h1>Pedidos</h1>
        </section>
        <section id="reportes">
            <h1>Reportes</h1><canvas id="grafica"></canvas>
        </section>
        <section id="config">
            <h1>Configuración</h1>
        </section>
    </main>
    <script src="admin.js"></script>
</body>

</html>