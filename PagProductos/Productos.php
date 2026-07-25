<!DOCTYPE html>
<html>

<head>
    <title>Productos</title>
    <link rel="stylesheet" href="../estilos/estiloFooter.css">
        <link rel="stylesheet" href="../estilos/estiloHeader.css">

    <link rel="stylesheet" href="../estilos/estiloProductos.css">
</head>

<body>
    <div id="header-placeholder"></div>
    <div class="contenedor-catalogo">

        <aside class="barra-lateral">
            <h3>Categorías</h3>
            <ul>
                <li><a href="#" class="active" data-categoria="todos">Todos</a></li>
                <li><a href="#" data-categoria="abarrotes">Abarrotes</a></li>
                <li><a href="#" data-categoria="lacteos">Lácteos</a></li>
                <li><a href="#" data-categoria="bebidas">Bebidas</a></li>
                <li><a href="#" data-categoria="limpieza">Limpieza</a></li>
                <li><a href="#" data-categoria="botanas">Botanas</a></li>
                <li><a href="#" data-categoria="enlatados">Enlatados</a></li>
                <li><a href="#" data-categoria="cuidadopersonal">Cuidado personal</a></li>
            </ul>
        </aside>

        <main class="seccion-productos">
    <div class="grid-productos">
        <?php
        
        include 'conexionProducto.php'; 

       
        $sql = "SELECT p.*, LOWER(c.nombre) AS categoria_nombre 
                FROM productos p 
                INNER JOIN categorias c ON p.id_categoria = c.id_categoria";
                
        $resultado = mysqli_query($conexion, $sql);
     
        $productos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

        foreach ($productos as $producto): 
        ?>
            <div class="tarjeta-producto" data-categoria="<?php echo strtr(mb_strtolower($producto['categoria_nombre']), 'áéíóú', 'aeiou'); ?>">
                <img src="../PagInicio/imagenes/<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
                <h4><?php echo htmlspecialchars($producto['nombre']); ?></h4>
                <p class="precio">$<?php echo number_format($producto['precio'], 2); ?></p>
                <button class="btn-agregar" data-id="<?php echo $producto
                ['id_producto']; ?>"> Agregar🛒 </button>
            </div>
        <?php endforeach; ?>
    </div>
</main>

    </div>
 
<div id="footer-placeholder"></div>

<script>
    console.log("¡El script se está ejecutando correctamente!");

    fetch('../PagHeader/header.html')
        .then(response => {
            console.log("Estatus del header:", response.status); 
            return response.text();
        })
        .then(data => {
            console.log("¡El HTML del header llegó correctamente!"); 
            document.getElementById('header-placeholder').innerHTML = data;
            comprobarBusquedaDesdeInicio();
        })
        .catch(error => console.error("Error en el fetch del header:", error));

   
    fetch('../PagHeader/footer.html')
        .then(response => response.text())
        .then(data => {
            document.getElementById('footer-placeholder').innerHTML = data;
        })
        .catch(error => console.error("Error en el fetch del footer:", error));

    
    function comprobarBusquedaDesdeInicio() {
        const busquedaGuardada = localStorage.getItem('terminoBusqueda');
        console.log("Búsqueda guardada en memoria (localStorage):", busquedaGuardada);

        const revisarElementos = setInterval(() => {
            const inputBusqueda = document.getElementById('input-busqueda');
            const productos = document.querySelectorAll('.tarjeta-producto');
          
            const enlacesCategorias = document.querySelectorAll('.barra-lateral ul li a');

            console.log("¿Existe input?:", !!inputBusqueda, "| Cantidad de productos encontrados:", productos.length);

            if (inputBusqueda && productos.length > 0) {
                console.log("¡Se encontraron los elementos! Deteniendo el intervalo e inicializando filtros."); 
                clearInterval(revisarElementos);
                
            
                if (busquedaGuardada) {
                    inputBusqueda.value = busquedaGuardada;
                    filtrarProductos(busquedaGuardada, productos);
                    localStorage.removeItem('terminoBusqueda');
                }
                
                inputBusqueda.addEventListener('input', () => {
                    filtrarProductos(inputBusqueda.value, productos);
                });


                
                enlacesCategorias.forEach(enlace => {
                    enlace.addEventListener('click', (e) => {
                        e.preventDefault(); // Evita que la página salte por el '#'

                        
                        enlacesCategorias.forEach(en => en.classList.remove('active'));
                        enlace.classList.add('active');

                       
                        inputBusqueda.value = ""; 

                        //  Obtener la categoría seleccionada 
                        const categoriaSeleccionada = enlace.getAttribute('data-categoria');

                        
                        productos.forEach(producto => {
                            const categoriaProducto = producto.getAttribute('data-categoria');

                            if (categoriaSeleccionada === 'todos' || categoriaProducto === categoriaSeleccionada) {
                                producto.style.display = ""; // Muestra el producto
                            } else {
                                producto.style.display = "none"; // Oculta el producto
                            }
                        });
                    });
                });
                console.log("¡Filtro de categorías vinculado con éxito!");
            }
        }, 50);
    }

    //   FILTRADO POR TEXTO
    function filtrarProductos(texto, listaProductos) {
        const textoBusqueda = texto.toLowerCase().trim();

        listaProductos.forEach(producto => {
            const nombreProducto = producto.querySelector('h4')
                .textContent.toLowerCase();
            if (nombreProducto.includes(textoBusqueda)) {
                producto.style.display = "";
            } else {
                producto.style.display = "none";
            }
        });
    }
</script>

</body>




<div id="footer-placeholder"></div>
<script>
    fetch('../PagHeader/header.html')
        .then(response => response.text())
        .then(data => {
            document.getElementById
                ('header-placeholder').innerHTML = data;
        }
        )
</script>
<script>
    fetch('../PagHeader/footer.html')
        .then(response => response.text())
        .then(data => {
            document.getElementById
                ('footer-placeholder').innerHTML = data;
        }
        )
</script>



</html>