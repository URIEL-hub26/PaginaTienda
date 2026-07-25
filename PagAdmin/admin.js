

/*==================================
        BUSCADOR
==================================*/

function buscarProducto(){

    const texto = document
                    .getElementById("buscar")
                    .value
                    .toLowerCase();

    const filas = document.querySelectorAll("#tabla tbody tr");

    filas.forEach(fila=>{

        const nombre = fila.cells[0]
                            .textContent
                            .toLowerCase();

        fila.style.display =
            nombre.includes(texto)
            ? ""
            : "none";

    });

}

/*==================================
        CAMBIAR SECCIONES
==================================*/

function show(id){

    document
        .querySelectorAll("section")
        .forEach(seccion=>{

            seccion.classList.remove("active");

        });

    document
        .getElementById(id)
        .classList.add("active");

}

/*==================================
        GRAFICA
==================================*/

function crearGrafica(){

    const canvas = document.getElementById("grafica");

    if(canvas==null)
        return;

    new Chart(canvas,{

        type:"bar",

        data:{

            labels:[

                "Enero",

                "Febrero",

                "Marzo",

                "Abril",

                "Mayo",

                "Junio"

            ],

            datasets:[{

                label:"Ventas",

                data:[

                    120,

                    180,

                    150,

                    210,

                    260,

                    300

                ],

                backgroundColor:[
                    "#2E7D32",
                    "#43A047",
                    "#66BB6A",
                    "#81C784",
                    "#A5D6A7",
                    "#C8E6C9"
                ]

            }]

        },

        options:{

            responsive:true,

            maintainAspectRatio:false,

            plugins:{

                legend:{

                    display:false

                }

            }

        }

    });

}

/*==================================
        INICIALIZAR
==================================*/

document.addEventListener("DOMContentLoaded",()=>{

    mostrarProductos();

    crearGrafica();

});

/*==================================
        EVENTOS
==================================*/

const buscador = document.getElementById("buscar");

if(buscador){

    buscador.addEventListener("keyup",buscarProducto);

}