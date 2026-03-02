// ============================================
// Script principal para la gestión de productos en el CRUD: AJAX
// ============================================

// Primero Para mostrar y ocultar el formulario de agregar producto
document.addEventListener("DOMContentLoaded", () => {

    const overlay = document.getElementById("overlayAgregar");

    window.mostrarFormulario = () => {
        overlay.classList.add("activo");
    };

    window.ocultarFormulario = () => {
        overlay.classList.remove("activo");
    };

    const form = document.getElementById("formAgregarProducto");
    if (form) {
        form.addEventListener("submit", function (e) {
            e.preventDefault();

            let formData = new FormData(this);

            // Mostrar en consola los valores enviados
            for (let pair of formData.entries()) {
                console.log(pair[0] + ": " + pair[1]);
            }

            const url_agregar = `${window.BASE_URL}/admin/procesar_agregar.php`;
            fetch(url_agregar, {
                method: "POST",
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    Swal.fire({
                        title: data.status === "success" ? "¡Éxito!" : "Error",
                        text: data.message,
                        icon: data.status === "success" ? "success" : "error",
                        confirmButtonText: "OK"
                    }).then(() => {
                        if (data.status === "success") {
                            window.location.reload(); // Recargar la página solo si se agregó bien
                        }
                    });
                })
                .catch(error => {
                    Swal.fire({
                        title: "Error",
                        text: "Hubo un problema en la solicitud",
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                });
        });
    }

});

// ============================================
// Función para buscar productos en mi Crud:
// ============================================
function buscarProducto() {
    let input = document.getElementById("busqueda").value.toLowerCase();
    let filas = document.querySelectorAll("#tablaProductos tr");

    filas.forEach(fila => {
        let texto = fila.textContent.toLowerCase();
        fila.style.display = texto.includes(input) ? "" : "none";
    });
}



// =============================================
// Función para eliminar productos del Crud
// =============================================

function eliminarProducto(producto_id) {
    console.log("Intentando eliminar producto con ID:", producto_id);

    Swal.fire({
        title: "¿Estás seguro?",
        text: "Esta acción no se puede deshacer",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            const url_eliminar = `${window.BASE_URL}/admin/eliminar_producto.php?producto_id=${producto_id}`;
            fetch(url_eliminar, { //  Se envía el ID en la URL
                method: "GET"
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === "success") {
                        Swal.fire("Eliminado", "El producto ha sido eliminado", "success");
                        cargarPagina(1); //  Recarga la tabla sin refrescar la página
                    } else {
                        Swal.fire("Error", data.message, "error");
                    }
                })
                .catch(error => {
                    console.error("Error del fetch:", error);
                    Swal.fire("Error", "No se pudo conectar con el servidor", "error");
                });
        }
    });
}

// Ahora el script para las tallas y stock de la tabla tallas_productos
document.getElementById("agregar-talla").addEventListener("click", function () {
    const contenedor = document.getElementById("contenedor-tallas-stock");

    const fila = document.createElement("div");
    fila.className = "fila-talla-stock";
    fila.innerHTML = `
        <select name="talla[]" class="form-select talla-select" required>
            <option value="">Elige una talla</option>
            <option value="XS">XS</option>
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
                <option value="XXL">XXL</option>
        </select>
        <input type="number" name="stock[]" class="form-control stock-input" placeholder="Cantidad" min="0" required>
        <button type="button" class="btn btn-danger btn-sm eliminar-fila">X</button>
    `;
    contenedor.appendChild(fila);

    // Funcioncita para eliminar la fila añadida
    document.addEventListener("click", function (e) {
        if (e.target.classList.contains("eliminar-fila")) {
            const fila = e.target.closest(".fila-talla-stock");
            if (fila) fila.remove();
        }
    });
});


// =============================================
// Ordenar productos
// =============================================

// document.getElementById("ordenarProductos").addEventListener("change", function () {
//     const ordenSeleccionado = this.value;

//     let orden;
//     switch (ordenSeleccionado) {
//         case "fecha_desc":
//             orden = "producto_id DESC";
//             break;
//         case "fecha_asc":
//             orden = "producto_id ASC";
//             break;
//         case "precio_asc":
//             orden = "precio ASC";
//             break;
//         case "precio_desc":
//             orden = "precio DESC";
//             break;
//         case "stock_desc":
//             orden = "stock DESC";
//             break;
//         case "stock_asc":
//             orden = "stock ASC";
//             break;
//         case "nombre_asc":
//             orden = "nombre ASC";
//             break;
//         case "nombre_desc":
//             orden = "nombre DESC";
//             break;
//         default:
//             orden = "producto_id DESC";
//     }

//     fetch(`/admin/paginacion_productos.php?orden=${encodeURIComponent(orden)}`)
//         .then(response => response.text())
//         .then(data => {
//             document.getElementById("tablaProductos").innerHTML = data;
//         })
//         .catch(error => console.error("Error:", error));
// });

// ============================================
// Funcion para editar los productos como tal
// ============================================

// Función para añadir una fila de talla y stock en el modal de edición
function agregarFilaTallaEditar(talla = '', stock = '') {
    console.log("🧪 Insertando fila:", talla, stock);

    const contenedor = document.getElementById('contenedor-tallas-edit');
    const div = document.createElement('div');
    div.className = 'fila-talla-stock-edit';
    div.innerHTML = `
        <div class="d-flex mb-2 gap-2">
            <select name="talla[]" class="form-select" required>
                <option value="">Selecciona Talla</option>
                <option value="XS" ${talla === 'XS' ? 'selected' : ''}>XS</option>
                <option value="S" ${talla === 'S' ? 'selected' : ''}>S</option>
                <option value="M" ${talla === 'M' ? 'selected' : ''}>M</option>
                <option value="L" ${talla === 'L' ? 'selected' : ''}>L</option>
                <option value="XL" ${talla === 'XL' ? 'selected' : ''}>XL</option>
            </select>
            <input type="number" class="form-control" placeholder="Stock" name="stock[]" value="${stock}" required>
            <button type="button" class="btn btn-danger btn-sm" onclick="this.parentNode.remove()">x</button>
        </div>
        `;
    contenedor.appendChild(div);
}


// Lógica para leer imagenes
function esBase64(src) {
    return typeof src === "string" && src.startsWith("data:image");
}

function esUrl(src) {
    return typeof src === "string" && src.startsWith("http");
}

function setPreview(imgEl, src) {
    const fallback = "https://www.venuzstore.com/fotos/default.png";

    if (!src || src === "0") {
        imgEl.src = fallback;
        return;
    }

    if (esBase64(src) || esUrl(src)) {
        imgEl.src = src;
    } else {
        imgEl.src = fallback;
    }
}

// *************************************************************************************
function abrirModalEditar(producto_id, nombre, descripcion, precio, imagen, imagen_back, genero, tipo_producto, color, fecha, new_in, talla = [], stock = []) {

    console.log("📌 Datos recibidos en abrirModalEditar:");
    console.log({ producto_id, nombre, descripcion, precio, stock, imagen, imagen_back, genero, tipo_producto, color, fecha, new_in, talla, });

    document.getElementById("editar_producto_id").value = producto_id;
    document.getElementById("editar_nombre").value = nombre;
    document.getElementById("editar_descripcion").value = descripcion;
    document.getElementById("editar_precio").value = precio;
    document.getElementById("editar_genero").value = genero;
    document.getElementById("editar_tipo_producto").value = tipo_producto || "";
    document.getElementById("editar_color").value = color || "";
    document.getElementById("fecha-editar").value = fecha;
    document.getElementById("new-in-editar").value = new_in;

    const defaultImage = "https://www.venuzstore.com/fotos/default.png";

    //Mostrar imagenes miniaturas
    // Imagen frontal e Imagen trasera
    const previewFrontal = document.getElementById("editar_imagen_preview");
    const previewBack = document.getElementById("editar_imagen_back_preview");

    setPreview(previewFrontal, imagen);
    setPreview(previewBack, imagen_back);

    // Cargar tallas y stock
    const contenedor = document.getElementById("contenedor-tallas-edit");
    contenedor.innerHTML = ""; // Limpiar antes de cargar nuevas filas
    for (let i = 0; i < talla.length; i++) {
        agregarFilaTallaEditar(talla[i], stock[i]);
    }
    // Obtener imágenes adicionales desde PHP
    const urlImg = `${window.BASE_URL}/obtener_imagenes_adicionales.php?producto_id=${producto_id}`;
    fetch(urlImg)
        .then(res => {
            if (!res.ok) throw new Error(`HTTP ${res.status}`);
            return res.json();
        })
        .then(data => {
            for (let i = 0; i < 3; i++) {
                const input = document.getElementById(`editar_imagenes_adicionales_${i + 1}`);
                if (input) {
                    input.value = data[i] || ''; // Si no hay imagen, deja vacío
                }
            }
        })
        .catch(err => {
            console.error("Error cargando imágenes adicionales:", err);
        });
}

[
    { input: "editar_imagen", preview: "editar_imagen_preview" },
    { input: "editar_imagen_back", preview: "editar_imagen_back_preview" }
].forEach(({ input, preview }) => {
    const inputEl = document.getElementById(input);
    const previewEl = document.getElementById(preview);

    inputEl.addEventListener("input", e => {
        setPreview(previewEl, e.target.value);
    });
});


// Enviar el formulario con AJAX
document.getElementById("formEditarProducto").addEventListener("submit", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    fetch(`${window.BASE_URL}/procesar_edicion.php`, {
        method: "POST",
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            Swal.fire({
                title: data.status === "success" ? "¡Actualizado!" : "Error",
                text: data.message,
                icon: data.status === "success" ? "success" : "error",
                confirmButtonText: "OK"
            }).then(() => {
                if (data.status === "success") {
                    document.querySelector("#modalEditar .btn-close").click();
                    window.location.reload();
                }
            });
        })
        .catch(error => {
            Swal.fire("Error", "Hubo un problema en la solicitud", "error");
        });
});


// ****************************************************************************************
// Conecta el botón de editar con el modal editar
// ****************************************************************************************
function asignarEventosEditar() {
    document.querySelectorAll('.btn-abrir-editar').forEach(btn => {
        btn.addEventListener('click', () => {
            const producto_id = btn.dataset.id;
            const nombre = btn.dataset.nombre;
            const descripcion = btn.dataset.descripcion;
            const precio = btn.dataset.precio;
            const imagen = btn.dataset.imagen;
            const imagen_back = btn.dataset.imagen_back;
            const genero = btn.dataset.genero;
            const tipo_producto = btn.dataset.tipo_producto;
            const color = btn.dataset.color;
            const fecha = btn.dataset.fecha;
            const new_in = btn.dataset.new_in;


            // Parsear JSON
            const talla = JSON.parse(btn.dataset.talla || '[]');
            const stock = JSON.parse(btn.dataset.stock || '[]');

            $('#modalEditar').modal('show');

            setTimeout(() => {
                abrirModalEditar(
                    producto_id, nombre, descripcion, precio, imagen, imagen_back,
                    genero, tipo_producto, color, fecha, new_in, talla, stock
                );
            }); // tiempo para que el DOM esté listo
        });
    });
}
// *************************************************************
// Cargar la primera página al abrir
function initInventario() {
    cargarPagina(1);

    function cargarPagina(pagina) {
        let xhr = new XMLHttpRequest();
        xhr.open("GET", "paginacion_productos.php?pagina=" + pagina, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("tablaProductos").innerHTML = xhr.responseText;
                asignarEventosEditar(); // Asignar eventos de edición
            }
        };
        xhr.send();
    }
    // Hacer la función global para que los botones la usen
    window.cargarPagina = cargarPagina;
};