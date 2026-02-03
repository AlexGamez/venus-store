import { actualizarBotonAgregar} from "./mostrarDetalleProducto.js";

// ==============================
// carrito-final.js (actualizado)
// ==============================
'use strict';

// ==============================
// Control de versión del carrito
// ==============================
const VERSION = 1;

function cargarCarrito() {
  const raw = localStorage.getItem("carrito");
  if (!raw) return [];
  try {
    const guardado = JSON.parse(raw);
    if (guardado.version !== VERSION) {
      localStorage.removeItem("carrito");
      return [];
    }
    return Array.isArray(guardado.items) ? guardado.items : [];
  } catch (e) {
    // si está corrupto, lo limpiamos
    localStorage.removeItem("carrito");
    return [];
  }
}

// Carrito inicial seguro
let carrito = cargarCarrito();

// Actualizar carrito en caso de cambios (otra pestaña / otra parte de la app)
window.addEventListener("storage", () => {
  carrito = cargarCarrito();
  renderMiniCarrito();
  renderCheckoutCarrito();
});

// Refs del DOM (se rehidratán al DOMContentLoaded si hacen falta)
let overlay = document.getElementById('overlay');
let btnCerrar = document.querySelector('.cerrar-carrito');
let btnCarrito = document.getElementById('btn-carrito') || document.getElementById('btn-carrito-fake');
let carritoModal = document.getElementById('carrito-modal');

// ==============================
// Funciones de almacenamiento
// ==============================
function guardarCarrito() {
  const data = { version: VERSION, items: carrito };
  localStorage.setItem("carrito", JSON.stringify(data));
  // notificar a otras pestañas/scripts
  window.dispatchEvent(new Event("storage"));
}

function calcularTotal() {
  return carrito.reduce((acc, p) => acc + (Number(p.precio) || 0) * (Number(p.cantidad) || 0), 0);
}

// ==============================
// Operaciones sobre productos
// ==============================
function agregarProducto(producto) {
  // producto debe traer: producto_id (number), talla (string), cantidad (number), stock (number)...
  const tallaNormalizada = producto.talla ? producto.talla.trim().toUpperCase() : "";

  // Buscar si ya existe en el carrito con la misma talla
  const existenteIndex = carrito.findIndex(item =>
    Number(item.producto_id) === Number(producto.producto_id) &&
    (item.talla || '') === tallaNormalizada
  );

  const stockNum = Number(producto.stock) || 0;
  const cantidadAAgregar = Number(producto.cantidad) || 1;

  if (existenteIndex !== -1) {
    const existente = carrito[existenteIndex];
    const nuevaCantidad = Number(existente.cantidad) + cantidadAAgregar;

    if (stockNum > 0 && nuevaCantidad > stockNum) {
      existente.cantidad = stockNum;
      Swal.fire({
        icon: "warning",
        title: "Stock insuficiente",
        text: `Solo hay ${stockNum} unidades disponibles.`,
        confirmButtonText: "Entendido"
      });
    } else {
      existente.cantidad = nuevaCantidad;
    }
  } else {
    // Si no existe, lo añade limitado por stock
    const cantidadFinal = stockNum > 0 ? Math.min(cantidadAAgregar, stockNum) : cantidadAAgregar;
    carrito.push({
      producto_id: Number(producto.producto_id),
      nombre: producto.nombre || '',
      precio: Number(producto.precio) || 0,
      cantidad: Number(cantidadFinal),
      imagen: producto.imagen || '',
      talla: tallaNormalizada,
      stock: stockNum
    });

    if (stockNum > 0 && cantidadAAgregar > stockNum) {
      Swal.fire({
        icon: "warning",
        title: "Stock insuficiente",
        text: `Solo hay ${stockNum} unidades disponibles. Se añadió la máxima cantidad.`,
        confirmButtonText: "Entendido"
      });
    }
  }

  guardarCarrito();
  renderMiniCarrito();
  renderCheckoutCarrito();
}

// cambiar cantidad usando índice numérico
function cambiarCantidad(index, delta) {
  index = parseInt(index, 10);
  if (Number.isNaN(index) || !carrito[index]) return;

  const item = carrito[index];
  const stock = Number(item.stock) || 0;
  let nueva = Number(item.cantidad) + Number(delta);

  if (stock > 0 && nueva > stock) {
    item.cantidad = stock;
    Swal.fire({ icon: "warning", title: "¡A tope!", timer: 1100, showConfirmButton: false, text: `Máximo ${stock} unds disponibles.` });
  } else if (nueva <= 0) {
    carrito.splice(index, 1);
  } else {
    item.cantidad = nueva;
  }

  guardarCarrito();
  renderMiniCarrito();
  renderCheckoutCarrito();
}

function eliminarProducto(index) {
  index = parseInt(index, 10);
  if (Number.isNaN(index)) return;
  carrito.splice(index, 1);
  guardarCarrito();
  renderMiniCarrito();
  renderCheckoutCarrito();
}

// ==============================
// Renderizado: mini-carrito modal
// ==============================
function renderMiniCarrito() {
  const carritoContenido = document.querySelector(".carrito-contenido");
  const carritoTotal = document.getElementById("carrito-total");
  const mensajeVacio = document.getElementById("mensaje-vacio");
  const totalFooter = document.querySelector(".carrito-footer");

  if (!carritoContenido) return;

  carritoContenido.innerHTML = "";

  if (!carrito || carrito.length === 0) {
    if (mensajeVacio) mensajeVacio.style.display = "block";
    if (totalFooter) totalFooter.style.display = "none";
    if (carritoTotal) carritoTotal.textContent = "0";
    return;
  }

  if (mensajeVacio) mensajeVacio.style.display = "none";
  if (totalFooter) totalFooter.style.display = "block";

  carrito.forEach((p, idx) => {
    const div = document.createElement("div");
    div.classList.add("producto-mini");
    div.innerHTML = `
      <div class="producto-item">
        <div class="producto-img">
          <img src="${p.imagen || '/foto/default.png'}" alt="${p.nombre || 'Producto'}" class="miniatura">
        </div>
        <div class="producto-info">
          <p class="nombre">${p.nombre}</p>
          <span class="precio-actual">$${(p.precio * p.cantidad).toLocaleString()}</span>
          <span class="talla">Talla: ${p.talla || ""}</span>
          <div class="padre_de_acciones">
            <div class="acciones">
              <button class="btn-menos" data-id="${idx}">−</button>
              <span>${p.cantidad}</span>
              <button class="btn-mas" data-id="${idx}">+</button>
              <button class="btn-eliminar" data-id="${idx}"title="Eliminar">
                <i class="bi bi-x-lg equis"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    `;
    carritoContenido.appendChild(div);
  });

  if (carritoTotal) carritoTotal.textContent = calcularTotal().toLocaleString();
}

// ==============================
// Mostrar / Ocultar carrito
// ==============================
function mostrarCarrito() {
  renderMiniCarrito();
  if (carritoModal) carritoModal.classList.add('abierto');
  if (overlay) overlay.classList.add('visible');
}

function ocultarCarrito() {
  if (carritoModal) carritoModal.classList.remove('abierto');
  if (overlay) overlay.classList.remove('visible');
}


// ==============================
// Renderizado: checkout final
// ==============================
function renderCheckoutCarrito() {
  const productosDiv = document.querySelector(".carrito-contenido");
  const accionesDiv = document.getElementById("acciones-cantidad");
  const totalUnitarioSpan = document.getElementById("total-carrito");

  if (!productosDiv || !accionesDiv || !totalUnitarioSpan) return;

  productosDiv.innerHTML = "";
  accionesDiv.innerHTML = "";

  if (!carrito || carrito.length === 0) {
    productosDiv.innerHTML = '<p class="carrito-vacio">Ups, no has añadido nada aún</p>';
    accionesDiv.innerHTML = "";
    totalUnitarioSpan.textContent = "0";
    return;
  }

  let totalGeneral = 0;
  carrito.forEach((p, id) => {
    productosDiv.innerHTML += `
      <div class="d-flex align-items-center mb-2 p-detalles">
        <img src="${p.imagen}" alt="${p.nombre}">
        <div class="producto-detalles ms-3">
          <p class="mb-2 productos">${p.nombre}</p>
          <p class="mb-2 cantidades">Talla: ${p.talla}</p>
          <p class="mb-2 totales">$${p.precio.toLocaleString()}</p>
        </div>
      </div>
    `;

    accionesDiv.innerHTML += `
      <div class="d-flex mt-4 padre">
        <div class="mt-3 botones">
          <button class="btn-menos" data-id="${id}">−</button>
          <span class="ms-1">${p.cantidad}</span>
          <button class="btn-mas" data-id="${id}">+</button>
          <button class="btn-eliminar ms-2" data-id="${id}" title="Eliminar">
            <i class="bi bi-x-lg"></i>
          </button>
        </div>
      </div>
    `;

    totalGeneral += p.precio * p.cantidad;
  });

  totalUnitarioSpan.textContent = totalGeneral.toLocaleString();
}

// ==============================
// Enviar carrito al backend
// ==============================
function enviarCarrito(event) {
  event.preventDefault();

  if (!carrito || carrito.length === 0) {
    Swal.fire("Tu carrito está vacío", "", "warning");
    return;
  }

  const agotado = carrito.find(p => !p.stock || p.cantidad > p.stock);
  if (agotado) {
    Swal.fire({
      icon: "warning",
      title: "Stock insuficiente 😔",
      text: `El producto ${agotado.nombre} (talla ${agotado.talla || "-"}) se acaba de agotar 💔, te invitamos a mirar otras opciones.`,
      confirmButtonText: "Entendido"
    });
    return; //  no se envía al backend
  }

  fetch(`admin/front/procesar_pago.php`, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      carrito: carrito,
      nombre: document.querySelector("#nombre")?.value || "",
      apellido: document.querySelector("#apellido")?.value || "",
      direccion: document.querySelector("#direccion")?.value || "",
      direccion_adicional: document.querySelector("#direccion_adicional")?.value || "",
      ciudad: document.querySelector("#ciudad")?.value || "",
      telefono: document.querySelector("#telefono")?.value || "",
      correo: document.querySelector("#correo")?.value || ""
    }),
  })
  .then((res) => res.text())
  .then((data) => {
    if (data.startsWith("OK|")) {
      let token = data.split("|")[1];
      localStorage.removeItem("carrito");
      window.location.href = "gracias.php?token=" + token;
    } else {
      Swal.fire({
        icon: "error",
        title: "¿Alguien más compró primero?",
        text: "Descuida, tu dinero está intacto.",
        confirmButtonText: "Entendido"
     });
    } 
  })
  .catch((err) => console.error("Error:", err));
}

// ==============================
// Eventos globales
// ==============================
document.addEventListener("DOMContentLoaded", () => {
  // Re-hidratar referencias del DOM por si el script cargó en <head>
  overlay = document.getElementById('overlay');
  btnCerrar = document.querySelector('.cerrar-carrito');
  btnCarrito = document.getElementById('btn-carrito') || document.getElementById('btn-carrito-fake');
  carritoModal = document.getElementById('carrito-modal');

  // El botón que está dentro del modal (checkout-modal) ya usa obtenerDatosProducto (ver abajo)
  document.querySelectorAll(".checkout-modal").forEach((btn) => {
    btn.addEventListener("click", () => {
      const modal = document.getElementById("productoModal");
      const producto_id = modal.dataset.producto_id;
      
      // Valida en el instante del click
      actualizarBotonAgregar(modal, { producto_id });
      if (btn.disabled) {
      e.preventDefault();
      return; // ya mostrará "Máximo alcanzado"
      }
      const producto = obtenerDatosProducto();
      agregarProducto(producto);
      mostrarCarrito();
      Swal.fire({ title: "Producto agregado", icon: "success", timer: 1100, showConfirmButton: false, position: "center" });
    });
  });

  if (overlay) overlay.addEventListener('click', ocultarCarrito);
  if (btnCerrar) btnCerrar.addEventListener('click', ocultarCarrito);

  if (btnCarrito) {
    btnCarrito.addEventListener('click', () => {
      const abierto = carritoModal?.classList.toggle('abierto');
      if (abierto) {
        overlay?.classList.add('visible');
        renderMiniCarrito();
      } else {
        overlay?.classList.remove('visible');
      }
    });
  }

  // Delegación para botones (+, −, eliminar) en los items (usa data-id que es índice)
  document.addEventListener("click", (e) => {
  // Buscar el botón más cercano con las clases relevantes
  const boton = e.target.closest(".btn-mas, .btn-menos, .btn-eliminar");
  if (!boton) return; // No clic en ningún botón válido

  const idRaw = boton.dataset?.id;
  if (idRaw === undefined) return;

  const id = parseInt(idRaw, 10);
  if (Number.isNaN(id)) return;

  if (boton.classList.contains("btn-mas")) {
    cambiarCantidad(id, +1);
  } else if (boton.classList.contains("btn-menos")) {
    cambiarCantidad(id, -1);
  } else if (boton.classList.contains("btn-eliminar")) {
    eliminarProducto(id);
  }
});

  // Inicializar
  renderMiniCarrito();
  renderCheckoutCarrito();

  const checkoutForm = document.getElementById("checkout-form");
  if (checkoutForm) checkoutForm.addEventListener("submit", enviarCarrito);
});

// ==============================
// Obtener datos producto (solo modal)
// ==============================
function obtenerDatosProducto() {
  const card = document.getElementById("productoModal");
  if (!card) return {};

  const cantidadSpan = card.querySelector(".cantidad-modal");
  const cantidad = cantidadSpan ? parseInt(cantidadSpan.textContent, 10) : 1;

  const tallaSpan = card.querySelector("#talla-activa");
  const talla = tallaSpan ? tallaSpan.textContent.trim() : "";

  const nombre = card.querySelector(".modal-title-producto")?.textContent.trim() || "";
  let precioTexto = card.querySelector("#modalPrecio")?.textContent.trim() || "";
  precioTexto = precioTexto.replace(/[$.,]/g, "");
  const precio = parseFloat(precioTexto) || 0;

  const imagen = card.querySelector("#modalImagen-producto")?.src || "";
  const stock = parseInt(card.dataset.selectedStock || card.dataset.stock || 0, 10) || 0;

  return {
    producto_id: parseInt(card.dataset.producto_id, 10) || 0,
    nombre,
    precio,
    cantidad,
    imagen,
    talla,
    stock
  };
}

// ==============================
// Exportaciones para otros módulos
// ==============================
export {
  agregarProducto,
  mostrarCarrito,
  guardarCarrito,
  obtenerDatosProducto,
  renderMiniCarrito,
  renderCheckoutCarrito,
  carrito,
};