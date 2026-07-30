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
        GRÁFICA (Chart.js)
==================================*/
// Registrar el plugin de datalabels si ChartDataLabels está disponible
if (typeof ChartDataLabels !== "undefined" && typeof Chart !== "undefined") {
    Chart.register(ChartDataLabels);
}

async function crearGrafica() {
    const canvas = document.getElementById("grafica");
    if (!canvas) return;

    // 1. Obtener la suma real desde ventas_del_mes.php
    let totalJulioBD = 0;
    try {
        const respuesta = await fetch("ventas_del_mes.php");
        if (!respuesta.ok) {
            throw new Error(`Error HTTP: ${respuesta.status}`);
        }
        const datos = await respuesta.json();
        totalJulioBD = parseFloat(datos.total_mes) || 0;
    } catch (error) {
        console.error("Error al obtener las ventas de la BD:", error);
    }

    // 2. Meses y valores (Enero a Junio simulados/anteriores, Julio REAL de pedidos)
    const etiquetasMeses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio"];
    const datosVentas = [12000, 19000, 15000, 22000, 18000, 25000, totalJulioBD];

    // 3. Actualizar el Total Acumulado en el DOM
    const total = datosVentas.reduce((acc, val) => acc + val, 0);
    const totalElemento = document.getElementById("totalVentas");
    if (totalElemento) {
        totalElemento.textContent = "$" + total.toLocaleString("es-MX") + " MXN";
    }

    // 4. Destruir gráfica previa si ya existía
    if (miGrafica) {
        miGrafica.destroy();
    }

    // 5. Renderizar gráfica
    miGrafica = new Chart(canvas, {
        type: "bar",
        data: {
            labels: etiquetasMeses,
            datasets: [{
                label: "Ventas",
                data: datosVentas,
                backgroundColor: [
                    "#2E7D32",
                    "#43A047",
                    "#66BB6A",
                    "#81C784",
                    "#A5D6A7",
                    "#C8E6C9",
                    "#1B5E20" // Destacar mes actual
                ],
                borderWidth: 1,
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            layout: {
                padding: { top: 25 }
            },
            plugins: {
                legend: { display: false },
                datalabels: {
                    anchor: 'end',
                    align: 'top',
                    formatter: (value) => '$' + value.toLocaleString('es-MX'),
                    font: { weight: 'bold', size: 11 },
                    color: '#333333'
                }
            },
            scales: {
                x: {
                    title: { display: true, text: 'Mes del Año', color: '#333333', font: { size: 14, weight: 'bold' } }
                },
                y: {
                    beginAtZero: true,
                    title: { display: true, text: 'Ganancias (MXN)', color: '#333333', font: { size: 14, weight: 'bold' } }
                }
            }
        }
    });
}

/*==================================
        IMPRESIÓN DE REPORTES
==================================*/
function imprimirReporte() {
    const canvas = document.getElementById('grafica');
    if (!canvas) {
        alert("No se encontró la gráfica para imprimir.");
        return;
    }

    // 1. Convertir la gráfica a imagen en formato PNG
    const imagenGrafica = canvas.toDataURL('image/png');
    const totalTexto = document.getElementById('totalVentas') ? document.getElementById('totalVentas').innerText : '$0 MXN';

    // 2. Abrir una nueva pestaña
    const ventanaImpresion = window.open('', '_blank');

    // 3. Estructurar el HTML de la pestaña de impresión
    ventanaImpresion.document.write(`
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <title>Reporte de Ventas - NovaMart</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    padding: 40px;
                    color: #333;
                    background-color: #fff;
                }
                .header {
                    text-align: center;
                    border-bottom: 3px solid #2e7d32;
                    padding-bottom: 12px;
                    margin-bottom: 25px;
                }
                .header h1 {
                    margin: 0;
                    color: #2e7d32;
                    font-size: 1.8rem;
                }
                .header p {
                    margin: 5px 0 0 0;
                    color: #666;
                    font-size: 0.9rem;
                }
                .info-box {
                    background-color: #f8f9fa;
                    border-left: 5px solid #2e7d32;
                    padding: 15px;
                    font-size: 1.1rem;
                    margin-bottom: 30px;
                }
                .grafica-contenedor {
                    text-align: center;
                    margin: 20px 0;
                }
                .grafica-img {
                    width: 100%;
                    max-width: 750px;
                    height: auto;
                    border: 1px solid #ddd;
                    border-radius: 8px;
                    padding: 10px;
                }
                .acciones {
                    text-align: center;
                    margin-top: 30px;
                }
                .btn-imprimir-pdf {
                    padding: 10px 20px;
                    background-color: #2e7d32;
                    color: white;
                    border: none;
                    border-radius: 4px;
                    font-weight: bold;
                    cursor: pointer;
                    font-size: 1rem;
                }
                @media print {
                    .acciones { display: none; }
                    body { padding: 0; }
                }
            </style>
        </head>
        <body>
            <div class="header">
                <h1>🛒 NovaMart - Reporte de Ventas</h1>
                <p>Fecha de emisión: ${new Date().toLocaleDateString('es-MX', { year: 'numeric', month: 'long', day: 'numeric' })}</p>
            </div>

            <div class="info-box">
                <strong>Total acumulado del semestre:</strong> ${totalTexto}
            </div>

            <div class="grafica-contenedor">
                <img src="${imagenGrafica}" class="grafica-img" alt="Gráfica de Ventas Semestral">
            </div>

            <div class="acciones">
                <button class="btn-imprimir-pdf" onclick="window.print()">🖨️ Imprimir / Guardar en PDF</button>
            </div>

            <script>
                // Disparar la ventana de impresión al cargar la página
                window.onload = function() {
                    window.print();
                };
            <\/script>
        </body>
        </html>
    `);

    ventanaImpresion.document.close();
}