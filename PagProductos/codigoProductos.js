document.addEventListener("DOMContentLoaded", () => {
    const enlacesCategorias = document.querySelectorAll(".barra-lateral ul li a");
    const productos = document.querySelectorAll(".tarjeta-producto");

    enlacesCategorias.forEach(enlace => {
        enlace.addEventListener("click", (e) => {
            e.preventDefault();

            // 1. Cambiar la clase activa en el menú lateral    
            enlacesCategorias.forEach(link => link.classList.remove("active"));
            enlace.classList.add("active");

            // 2. Obtener la categoría seleccionada 
            const categoriaSeleccionada = enlace.getAttribute("data-categoria");

            //  Filtrar los productos
            productos.forEach(producto => {
                
                const categoriaProducto = producto.getAttribute("data-categoria");
                               
                if (categoriaSeleccionada === "todos" || categoriaProducto === categoriaSeleccionada) {
                    producto.style.display = ""; 
                } else {
                    producto.style.display = "none";
                }
            });
        });
    });
});