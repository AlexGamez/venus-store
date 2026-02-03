// =================================================================
// Filtros de productos
// ================================================================
document.addEventListener("DOMContentLoaded", function () {
    const filtros = {
        color: "",
        tallas: [],
        tipo_producto: []
    };

    const colorBtns = document.querySelectorAll(".color-btn");
    const filtroTalla = document.querySelectorAll("#filtro-tallas input[type='checkbox']");
    const filtroTipo = document.querySelectorAll("#filtro-tipo input[type='checkbox']");
    const btnAplicar = document.getElementById("aplicarFiltros");
    const btnBorrar = document.getElementById("borrarFiltros");
    const productos = document.querySelectorAll(".flip-card");

    // Selección de color
    colorBtns.forEach(btn => {
        btn.addEventListener("click", function () {
            colorBtns.forEach(b => b.classList.remove("activo"));
            this.classList.add("activo");
            filtros.color = this.id.toLowerCase();
        });
    });

    // Selección de talla
    filtroTalla.forEach(checkbox => {
        checkbox.addEventListener("change", function () {
            filtros.tallas = Array.from(document.querySelectorAll("#filtro-tallas input[type='checkbox']:checked"))
                .map(cb => cb.id.toLowerCase());
        });
    });

    // Selección de tipo
    filtroTipo.forEach(checkbox => {
        checkbox.addEventListener("change", function () {
            filtros.tipo_producto = Array.from(document.querySelectorAll("#filtro-tipo input[type='checkbox']:checked"))
                .map(cb => cb.id.toLowerCase());
        });
    });

    // Aplicar filtros
    btnAplicar.addEventListener("click", function () {
        filtrarProductos();
        btnBorrar.style.display = (filtros.color || filtros.tallas.length || filtros.tipo_producto.length) ? "block" : "none";
    });

    // Borrar filtros
    btnBorrar.addEventListener("click", function () {
        filtros.color = "";
        filtros.tallas = [];
        filtros.tipo_producto = [];

        // Restablecer interfaz
        colorBtns.forEach(b => b.classList.remove("activo"));
        filtroTalla.forEach(cb => cb.checked = false);
        filtroTipo.forEach(cb => cb.checked = false);

        // Mostrar todos los productos
        productos.forEach(producto => producto.classList.remove("hidden"));

        btnBorrar.style.display = "none";
    });

    // Nueva función para filtrar productos correctamente
    function filtrarProductos() {
        let algunoCoincide = false;
        productos.forEach(producto => {
            const front = producto.querySelector(".flip-card-front");
            const colorProducto = front.getAttribute("data-color").toLowerCase();
            const tipoProducto = front.getAttribute("data-tipo_producto").toLowerCase();
    
            let tallasProducto = [];
            try {
                tallasProducto = JSON.parse(front.getAttribute("data-tallas"));
            } catch (e) {
                tallasProducto = [];
                console.warn("Error parseando tallas:", e);
            }
            
            // Extraer solo las tallas (strings) en minúscula para comparar
            const tallaProductoArr = tallasProducto.map(t => t.talla.toLowerCase());

            const coincideColor = !filtros.color || colorProducto === filtros.color;
            const coincideTalla = !filtros.tallas.length || filtros.tallas.some(tallaFiltro => tallaProductoArr.includes(tallaFiltro));
            const coincideTipo = !filtros.tipo_producto.length || filtros.tipo_producto.includes(tipoProducto);
    
            if (coincideColor && coincideTalla && coincideTipo) {
                producto.classList.remove("hidden", "removed");
                producto.style.height = "auto";
                algunoCoincide = true;
            } else {
                producto.classList.add("hidden");
                setTimeout(() => {
                    producto.classList.add("removed");
                }, 500); // Tiempo de transición antes de ocultarlo con display: none
            }
        });
        const mensaje = document.getElementById('mensaje-sin-resultados');
        if (!algunoCoincide) {
            mensaje.style.display = 'block';
        } else {
            mensaje.style.display = 'none';        
        }
    }
    
});
// =============================================
// Función para el boton "borrar filtos"
// =============================================

document.addEventListener("DOMContentLoaded", function () {
    const btnAplicar = document.getElementById("aplicarFiltros");
    const btnBorrar = document.getElementById("borrarFiltros");
    const colorBtns = document.querySelectorAll(".color-btn");
    const filtroTalla = document.querySelectorAll("#filtro-tallas input[type='checkbox']");
    const filtroTipo = document.querySelectorAll("#filtro-tipo input[type='checkbox']");
    const productos = document.querySelectorAll(".flip-card");

    function actualizarBotonBorrar() {
        const algunFiltroActivo = document.querySelector(".color-btn.activo") ||
                                  document.querySelector("#filtro-tallas input[type='checkbox']:checked") ||
                                  document.querySelector("#filtro-tipo input[type='checkbox']:checked");

        if (algunFiltroActivo) {
            btnBorrar.style.opacity = "1";
            btnBorrar.style.visibility = "visible";
        } else {
            btnBorrar.style.opacity = "0";
            btnBorrar.style.visibility = "hidden";
        }
    }

    btnAplicar.addEventListener("click", function () {
        actualizarBotonBorrar(); // Solo muestra el botón al hacer clic en "Aplicar"
    });

    btnBorrar.addEventListener("click", function () {
        //  Restablecer filtros
        colorBtns.forEach(b => b.classList.remove("activo"));
        filtroTalla.forEach(cb => cb.checked = false);
        filtroTipo.forEach(cb => cb.checked = false);

        //  Mostrar todos los productos con animación
        productos.forEach(producto => {
            producto.classList.remove("hidden", "removed");
            producto.style.height = "auto";
            document.getElementById("mensaje-sin-resultados").style.display = "none";
        });

        actualizarBotonBorrar();
    });

    actualizarBotonBorrar();
});


// ================================================================
// Ahora la sección para Ordernar productos según lo que se elija
// ================================================================

document.addEventListener("DOMContentLoaded", function () {
    const contenedor = document.querySelector(".contenedor-productos");
    const productosOriginales = Array.from(contenedor.children);
    const opcionSeleccionada = document.getElementById("opcionSeleccionada");
    const opcionesOrden = document.querySelectorAll("#ordenarPor li");
    const botonOrdenar = document.querySelector(".select-btn");
    const menuOrden = document.querySelector(".select-options");

    // Mostrar / ocultar el menú
    botonOrdenar.addEventListener("click", function () {
        menuOrden.classList.toggle("active");
    });

    // Cerrar el menú si se hace clic fuera de él
    document.addEventListener("click", function (event) {
        if (!botonOrdenar.contains(event.target) && !menuOrden.contains(event.target)) {
            menuOrden.classList.remove("active");
        }
    });

    opcionesOrden.forEach(item => {
        item.addEventListener("click", function () {
            const criterio = this.getAttribute("value");
            let productos = Array.from(document.querySelectorAll(".flip-card"));

            // Aplicar animación de salida
            productos.forEach(prod => prod.classList.add("oculto"));

            setTimeout(() => {
                // Actualizar el texto del botón con la opción seleccionada
                opcionSeleccionada.textContent = this.textContent;

                // Quitar la clase 'selected' y agregarla a la seleccionada
                opcionesOrden.forEach(opcion => opcion.classList.remove("selected"));
                this.classList.add("selected");

                if (criterio === "defecto") {
                    // Restaurar orden original
                    contenedor.innerHTML = "";
                    productosOriginales.forEach(producto => contenedor.appendChild(producto));
                } else {
                    // Ordenar productos
                    productos.sort((a, b) => {
                        let aData = a.querySelector(".flip-card-front").dataset;
                        let bData = b.querySelector(".flip-card-front").dataset;

                        if (criterio === "masVendidos") {
                            return bData.ventas - aData.ventas;
                        } else if (criterio === "alfabetico") {
                            return aData.nombre.localeCompare(bData.nombre);
                        } else if (criterio === "precioDesc") {
                            return aData.precio - bData.precio;
                        } else if (criterio === "precioAsc") {
                            return bData.precio - aData.precio;
                        }
                        return 0;
                    });

                    // Agregar los productos ordenados al contenedor
                    contenedor.innerHTML = "";
                    productos.forEach(producto => contenedor.appendChild(producto));
                }

                // Aplicar animación de entrada
                setTimeout(() => {
                    productos.forEach(prod => prod.classList.remove("oculto"));
                }, 50);
            }, 300); // Tiempo de animación antes de reordenar
        });
    });
});


// ================================================================
// Ahora la transición para los filtros NOTA: Solo transición
// ================================================================

document.querySelectorAll(".filter-header").forEach(button => {
    button.addEventListener("click", () => {
        const category = button.parentElement;
        category.classList.toggle("active");

        // Cierra otras categorías si una se abre
        document.querySelectorAll(".filter-options").forEach(item => {
            if (item !== category) {
                item.classList.remove("active");
            }
        });
    });
});

// ahora para que "por defecto" aparezca por defecto
document.addEventListener("DOMContentLoaded", function () {
    const opciones = document.querySelectorAll("#ordenarPor li");
    const opcionSeleccionada = document.getElementById("opcionSeleccionada");

    opciones.forEach(opcion => {
        opcion.addEventListener("click", function () {
            // Remueve la clase 'selected' de todas las opciones
            opciones.forEach(o => o.classList.remove("selected"));
            // Agrega la clase 'selected' a la opción seleccionada
            this.classList.add("selected");
            // Actualiza el texto del botón con la opción seleccionada
            opcionSeleccionada.textContent = this.textContent;
        });
    });
});



// ****************************************************************************
// Función para que el menú nav en móvil se cierre al dar click fuera, tocó aquí porque el index tiene un head distinto
// ****************************************************************************

// document.addEventListener("click", function (event) {
//   const navbar = document.getElementById("navbarNav");
//   const toggler = document.querySelector(".navbar-toggler");

//   // Verifica si el menú está abierto
//   const isOpen = navbar.classList.contains("show");

//   // Si está abierto y el click NO ocurrió dentro del navbar ni en el botón
//   if (isOpen && !navbar.contains(event.target) && !toggler.contains(event.target)) {
//     const collapse = new bootstrap.Collapse(navbar, {
//       toggle: false
//     });
//     collapse.hide();
//   }
// });

// // ****************************************************************************
// // Quitar focus del botón hamburguesa cada vez que se pulse
// // ****************************************************************************
// const toggler = document.querySelector(".navbar-toggler");
// toggler.addEventListener("click", function () {
//   this.blur();
// });
