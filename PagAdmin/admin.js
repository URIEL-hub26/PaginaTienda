// Variable global para controlar la instancia del gráfico
let miGrafica = null;

/*==================================
        INICIALIZACIÓN
==================================*/
document.addEventListener("DOMContentLoaded", () => {
    // Si tienes alguna función adicional como mostrarProductos(), se llama aquí
    if (typeof mostrarProductos === "function") {
        mostrarProductos();
    }

    // Inicializar el buscador si existe el input
    const buscador = document.getElementById("buscar");
    if (buscador) {
        buscador.addEventListener("keyup", buscarProducto);
    }

    // Mostrar el dashboard por defecto al cargar
    show("dashboard");
});

/*==================================
        CAMBIAR SECCIONES
==================================*/
function show(id) {
    // Ocultar todas las secciones
    document.querySelectorAll("section").forEach(seccion => {
        seccion.classList.remove("active");
    });

    // Activar la sección seleccionada
    const seccionActiva = document.getElementById(id);
    if (seccionActiva) {
        seccionActiva.classList.add("active");
    }

    // Renderizar la gráfica SOLO cuando el usuario entre a "reportes"
    if (id === "reportes") {
        crearGrafica();
    }
}

/*==================================
        BUSCADOR
==================================*/
function buscarProducto() {
    const buscadorInput = document.getElementById("buscar");
    if (!buscadorInput) return;

    const texto = buscadorInput.value.toLowerCase();
    const filas = document.querySelectorAll("#tabla tbody tr");

    filas.forEach(fila => {
        const celdaNombre = fila.cells[0];
        if (celdaNombre) {
            const nombre = celdaNombre.textContent.toLowerCase();
            fila.style.display = nombre.includes(texto) ? "" : "none";
        }
    });
}

/*==================================
        GRAFICA (Chart.js)
==================================*/
// Registrar el plugin de datalabels en Chart.js
Chart.register(ChartDataLabels);

function crearGrafica() {
    const canvas = document.getElementById("grafica");
    if (!canvas) return;

    const datosVentas = [12000, 19000, 15000, 22000, 18000, 25000];

    // Total acumulado arriba de la tarjeta
    const total = datosVentas.reduce((acc, val) => acc + val, 0);
    const totalElemento = document.getElementById("totalVentas");
    if (totalElemento) {
        totalElemento.textContent = "$" + total.toLocaleString("es-MX") + " MXN";
    }

    if (miGrafica) {
        miGrafica.destroy();
    }

    miGrafica = new Chart(canvas, {
        type: "bar",
        data: {
            labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio"],
            datasets: [{
                label: "Ventas",
                data: datosVentas,
                backgroundColor: [
                    "#2E7D32",
                    "#43A047",
                    "#66BB6A",
                    "#81C784",
                    "#A5D6A7",
                    "#C8E6C9"
                ],
                borderWidth: 1,
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            // Dar un poco de espacio extra arriba para que los números no se corten
            layout: {
                padding: {
                    top: 25
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                // ==========================================
                // CONFIGURACIÓN DE LOS VALORES EN CADA BARRA
                // ==========================================
                datalabels: {
                    anchor: 'end',      // Anclar al final de la barra
                    align: 'top',       // Posicionar justo encima de la barra
                    formatter: function(value) {
                        // Formatea el valor con signo $ y comas (ej. $15,000)
                        return '$' + value.toLocaleString('es-MX');
                    },
                    font: {
                        weight: 'bold',
                        size: 12
                    },
                    color: '#333333'
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Mes del Año',
                        color: '#333333',
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Ganancias (MXN)',
                        color: '#333333',
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    }
                }
            }
        }
    });
}