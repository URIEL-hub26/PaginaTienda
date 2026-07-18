const listaCarrito = document.getElementById('lista-carrito');
const txtSubtotal = document.getElementById('cart-subtotal');
const txtTotal = document.getElementById('cart-total');

function renderizarCarrito() {
    // 1. Traer los productos guardados en el localStorage
    let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    
    // Limpiar la tabla por completo antes de pintar
    listaCarrito.innerHTML = '';
    let totalCarrito = 0;

    // Si el carrito no tiene nada guardado
    if (carrito.length === 0) {
        listaCarrito.innerHTML = '<tr><td colspan="5" style="text-align: center; padding: 20px;">Tu carrito está vacío 🛒</td></tr>';
        txtSubtotal.textContent = '$0.00';
        txtTotal.textContent = '$0.00';
        return;
    }

    // 2. Recorrer la lista de productos y crear sus filas
    carrito.forEach((producto, index) => {
        const subtotal = producto.precio * producto.cantidad;
        totalCarrito += subtotal;

        const fila = document.createElement('tr');
        fila.innerHTML = `
            <td>
                <img src="${producto.imagen}" width="40" style="margin-right: 10px; vertical-align: middle; border-radius: 4px;">
                ${producto.titulo}
            </td>
            <td>$${producto.precio.toFixed(2)}</td>
            <td>
                <button class="btn-menos" data-index="${index}" style="padding: 2px 8px; cursor:pointer;">-</button>
                <span style="margin: 0 10px; font-weight: bold;">${producto.cantidad}</span>
                <button class="btn-mas" data-index="${index}" style="padding: 2px 8px; cursor:pointer;">+</button>
            </td>
            <td>$${subtotal.toFixed(2)}</td>
            <td><button class="btn-eliminar" data-index="${index}" style="background: none; border: none; cursor: pointer; font-size: 1.1rem;">❌</button></td>
        `;
        listaCarrito.appendChild(fila);
    });


    txtSubtotal.textContent = `$${totalCarrito.toFixed(2)}`;
    txtTotal.textContent = `$${totalCarrito.toFixed(2)}`;

    asignarEventosBotones();
}

function asignarEventosBotones() {
    let carrito = JSON.parse(localStorage.getItem('carrito')) || [];

    // Lógica para el botón Más (+)
    document.querySelectorAll('.btn-mas').forEach(boton => {
        boton.addEventListener('click', (e) => {
            const index = e.target.getAttribute('data-index');
            carrito[index].cantidad++;
            localStorage.setItem('carrito', JSON.stringify(carrito));
            renderizarCarrito(); // Recarga la tabla de inmediato
        });
    });

    // Lógica para el botón Menos (-)
    document.querySelectorAll('.btn-menos').forEach(boton => {
        boton.addEventListener('click', (e) => {
            const index = e.target.getAttribute('data-index');
            if (carrito[index].cantidad > 1) {
                carrito[index].cantidad--;
                localStorage.setItem('carrito', JSON.stringify(carrito));
                renderizarCarrito();
            }
        });
    });

    // Lógica para el botón Eliminar (❌)
    document.querySelectorAll('.btn-eliminar').forEach(boton => {
        boton.addEventListener('click', (e) => {
            const index = e.target.getAttribute('data-index');
            carrito.splice(index, 1); // Remueve el producto seleccionado
            localStorage.setItem('carrito', JSON.stringify(carrito));
            renderizarCarrito();
        });
    });
}

// Arrancar la función en cuanto carga la página del carrito
renderizarCarrito();