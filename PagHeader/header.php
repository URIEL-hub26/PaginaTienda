<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$total_items = 0;
$monto_total = 0.00;

if (isset($_SESSION['id_usuario'])) {
    // Si la página donde se incluye el header no ha incluido la conexión, la incluimos
    if (!isset($conexion)) {
        @include_once __DIR__ . '/../PagProductos/conexionProducto.php';
    }

    // Si tu variable de conexión se llama $conexion o $conn, la detectamos:
    $db = isset($conexion) ? $conexion : (isset($conn) ? $conn : null);

    if ($db) {
        $id_usuario = $_SESSION['id_usuario'];
        $sql_badge = "SELECT SUM(carrito.cantidad) as total_cant, 
                             SUM(carrito.cantidad * productos.precio) as total_precio 
                      FROM carrito 
                      INNER JOIN productos ON carrito.id_producto = productos.id_producto 
                      WHERE carrito.id_usuario = ?";
                      
        $stmt_badge = $db->prepare($sql_badge);
        if ($stmt_badge) {
            $stmt_badge->bind_param("i", $id_usuario);
            $stmt_badge->execute();
            $res_badge = $stmt_badge->get_result()->fetch_assoc();
            
            if ($res_badge && $res_badge['total_cant']) {
                $total_items = $res_badge['total_cant'];
                $monto_total = $res_badge['total_precio'];
            }
            $stmt_badge->close();
        }
    }
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
            echo '<a href="../PagAdmin/PagAdmin.php">Administración</a>';
        }
        ?>

        <div class="barra-busqueda">
            <input type="text" id="input-busqueda" placeholder="🔍 Busca tu producto...">
        </div>
    </nav>

    <div class="iconos">
        <div class="contenedor-icono-carrito">
            <a href="../Pagcarrito/carrito.php" class="enlace-carrito">
                <div class="icono-wrapper">
                    🛒
                    <?php if ($total_items > 0): ?>
                        <span class="badge-carrito" id="badge-carrito">
                            <?php echo $total_items; ?>
                        </span>
                    <?php else: ?>
                        <span class="badge-carrito" id="badge-carrito" style="display: none;">0</span>
                    <?php endif; ?>
                </div>
                
                <span class="monto-carrito" id="monto-carrito">
                    $<?php echo number_format($monto_total, 2); ?>
                </span>
            </a>
        </div>

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

    <script>
    function configurarBusquedaInicio() {
        const inputBusqueda = document.getElementById('input-busqueda');

        if (inputBusqueda) {
            inputBusqueda.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    const texto = inputBusqueda.value.trim();

                    if (texto !== "") {
                        localStorage.setItem('terminoBusqueda', texto);
                        window.location.href = "../PagProductos/Productos.php";
                    }
                }
            });
        }
    }

    document.addEventListener("DOMContentLoaded", configurarBusquedaInicio);
    </script>
</header>