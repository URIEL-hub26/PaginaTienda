<?php
session_start();

require_once("../PagRegistro/conexion.php");

if ($_SESSION["id_rol"] != 1) {
    header("Location: ../PagInicio/index.php");
    exit();
}


$sqlCategorias = "SELECT * FROM categorias";

$categorias = $conexion->query($sqlCategorias);

// En PagAdmin.php
$sqlVentas = "SELECT MONTHNAME(fecha) AS mes, SUM(total) AS total FROM pedidos GROUP BY MONTH(fecha)";
$resVentas = $conexion->query($sqlVentas);

$meses = [];
$totales = [];

while($row = $resVentas->fetch_assoc()) {
    $meses[] = $row['mes'];
    $totales[] = $row['total'];
}
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
<!-- Plugin para mostrar los valores encima de las barras -->
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
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
            <li><a href="../PagInicio/index.php" style="color: inherit; text-decoration: none; display: block;">Salir</a></li>
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


            <iframe src="productos.php" width="100%" height="500px" style="border:none;">
            </iframe>


        </section>
        <section id="agregarProducto">

            <h1>Agregar producto</h1>

            <form action="guardar_producto.php" method="POST" enctype="multipart/form-data">

                <div class="campo">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>

                <div class="campo">
                    <label for="precio">Precio:</label>
                    <input type="number" id="precio" name="precio" step="0.01" required>
                </div>

                <div class="campo">
                    <label for="stock">Stock:</label>
                    <input type="number" id="stock" name="stock" required>
                </div>

                <div class="campo">
                    <label for="imagen">Imagen:</label>
                    <input type="file" id="imagen" name="imagen" accept="image/png,image/jpeg,image/webp" required>
                </div>

                <div class="campo">
                    <label for="id_categoria">Categoría:</label>

                    <select id="id_categoria" name="id_categoria" required>

                        <?php while ($categoria = $categorias->fetch_assoc()) { ?>

                            <option value="<?= $categoria['id_categoria'] ?>">
                                <?= $categoria['nombre'] ?>
                            </option>

                        <?php } ?>

                    </select>
                </div>

                <button type="submit">
                    Guardar producto
                </button>

            </form>

        </section>
        <section id="usuarios">

            <h1>Usuarios registrados</h1>

            <iframe src="usuarios.php" width="100%" height="500px" style="border:none;">
            </iframe>

        </section>
        <section id="pedidos">
            <h1>Pedidos</h1>
            
            <iframe 
                src="pedidos.php"
                width="100%"
                height="500px"
                style="border:none;">
            </iframe>
        </section>
     <section id="reportes">
    <h1>Reportes de Ventas</h1>
    
    <!-- Texto alineado a la izquierda arriba de la tarjeta -->
    <p class="total-texto">
        Total acumulado del semestre: <span id="totalVentas">$0 MXN</span>
    </p>

    <!-- Tarjeta blanca con la gráfica -->
    <div class="contenedor-grafica">
        <canvas id="grafica"></canvas>
    </div>
</section>
        <section id="config">
            <h1>Salir</h1>
        </section>
    </main>
    <script src="admin.js"></script>
</body>

</html>