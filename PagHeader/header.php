
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<header>

    <link rel="stylesheet" href="../estilos/estiloHeader.css">

    <div class="logo">
        <h2>🛒NovaMart</h2>
    </div>

    <nav class="menu">
        <a href="../PagInicio/index.php">Inicio</a>
        <a href="../PagProductos/Productos.php">Productos</a>
        <a href="../PagPromociones/PagPromociones.php">Promociones</a>

        <?php
        if (isset($_SESSION["id_usuario"]) && $_SESSION["id_rol"] == 1) {
            echo '<a href="../PagAdmin/admin.php">Administración</a>';
        }
        ?>

        <div class="barra-busqueda">
            <input type="text" id="input-busqueda" placeholder="🔍 Busca tu producto...">
        </div>
    </nav>

    <div class="iconos">

        <a href="../Pagcarrito/carrito.php">
            🛒
        </a>

        <?php if(isset($_SESSION["id_usuario"])): ?>

            <span class="usuario">
                👋 <?= htmlspecialchars($_SESSION["nombre"]) ?>
            </span>

            <a href="../PagRegistro/logout.php">
                🚪 Cerrar sesión
            </a>

        <?php else: ?>

            <a href="../PagRegistro/login.php">
                👤 Iniciar sesión
            </a>

            <a href="../PagRegistro/registro.php">
                📝 Registrarse
            </a>

        <?php endif; ?>

    </div>

</header>