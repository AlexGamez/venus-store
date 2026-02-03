// mostrarDetalleProducto.js
import { carrito } from './carrito-final.js';

// Función para abrir el modal

document.addEventListener("DOMContentLoaded", function () {
  document.body.addEventListener("click", function (e) {
    const card = e.target.closest(".flip-card");
    const botonVer = e.target.classList.contains("ver");

    // Funcion para abrir el modal
    // Caso: clic en tarjeta o en el botón "ver más"
      if (card && (botonVer || e.target.closest(".flip-card"))) {
      // Evita abrir si se clickea en botones internos del modal
      const ignorarClick = e.target.closest("p, .checkout-modal, .btn-menos-modal, .btn-mas-modal");
      if (ignorarClick) return;

      const producto_id = card.dataset.producto_id;

      fetch(`admin/front/detalle_producto.php?producto_id=${producto_id}`)
        .then(response => response.json())
        .then(data => {
          if (data && data.exito) {
            mostrarDetalleProducto(data.producto);
          } else {
            alert("No se pudo cargar la información del producto.");
          }
        })
        .catch(err => {
          console.error("Error al cargar producto:", err);
        });
    }
  });
});


// ================================================================================
// Función para el zoom del producto en el modal
// ================================================================================
document.addEventListener("DOMContentLoaded", function () {
  // código para el zoom de la imagen del producto
const zoomImg = document.getElementById('modalImagen-producto');
const container = zoomImg.parentElement;

container.addEventListener('mousemove', e => {
  const rect = container.getBoundingClientRect();
  const x = ((e.clientX - rect.left) / rect.width) * 100;
  const y = ((e.clientY - rect.top) / rect.height) * 100;
  zoomImg.style.transformOrigin = `${x}% ${y}%`;
  zoomImg.style.transform = 'scale(1.7)';
});

container.addEventListener('mouseleave', () => {
  zoomImg.style.transformOrigin = 'center center';
  zoomImg.style.transform = 'scale(1)';
});

});

// Nueva función auxiliar para manejar el botón "Añadir al carrito"
// Si ya existe en el carrito con esa talla en su tope, bloquea
function actualizarBotonAgregar(modalElement, producto) {
  const stock = Number(modalElement.dataset.selectedStock || 0);
  const talla = modalElement.dataset.selectedSize || '';
  const existente = carrito.find(i => Number(i.producto_id) === Number(producto.producto_id) && (i.talla || '') === talla);
  const agregarBtn = modalElement.querySelector('.checkout-modal');

  if (existente && stock > 0 && existente.cantidad >= stock) {
    if (agregarBtn) {
      agregarBtn.disabled = true;
      agregarBtn.textContent = "Máximo alcanzado, revisa tu carrito";
    }
  } else {
    if (agregarBtn) {
      agregarBtn.disabled = false;
      agregarBtn.textContent = "AÑADIR AL CARRITO";
    }
  }

  return existente;
}
// ==============================
// mostrarDetalleProducto.js (fragmentos relevantes)
// ==============================

async function mostrarTallasYStock(producto_id) {
  const modal = document.getElementById('productoModal');
  const tallasContainer = modal.querySelector('.tallas-botones');
  const stockSpan = modal.querySelector('.stock');
  const tallaActualSpan = modal.querySelector('#talla-activa');

  tallasContainer.innerHTML = '';
  modal.dataset.selectedStock = 0;
  modal.dataset.selectedSize = '';

  try {
    const resp = await fetch('admin/front/obtener_tallas_stock.php?producto_id=' + producto_id);
    const data = await resp.json();

    if (!Array.isArray(data) || data.length === 0) {
      // no tallas
      stockSpan.textContent = 'Sin stock';
      return data;
    }

    data.forEach((item, idx) => {
      const btn = document.createElement('button');
      btn.type = 'button';
      btn.textContent = item.talla;
      btn.dataset.stock = item.stock;
      btn.classList.add('talla-btn');

      if (parseInt(item.stock, 10) <= 0) {
        btn.classList.add('sin-stock');
        btn.disabled = true;
        btn.title = 'Sin existencias';
      } else {
        btn.addEventListener('click', () => {
          tallaActualSpan.textContent = item.talla;
          stockSpan.textContent = `Unds disponibles: ${item.stock}`;
          modal.dataset.selectedStock = Number(item.stock);
          modal.dataset.selectedSize = item.talla;
          
          // marcar activo
          tallasContainer.querySelectorAll('button').forEach(b => b.classList.toggle('activo', b === btn));
          // actualizar cantidad UI y botones +/-
          
          // Asegurar que la cantidad no supere el nuevo stock
          const cantidadSpan = modal.querySelector('.cantidad-modal');
          if (cantidadSpan) {
            cantidadSpan.textContent = '1';
          }
          // actualizar estado del botón Agregar cada vez que cambie la talla
          const producto_id_actual = modal.dataset.producto_id;
          actualizarCantidadUIModal();
          actualizarBotonAgregar(modal, { producto_id: producto_id_actual });
        });
      }

      tallasContainer.appendChild(btn);

      // seleccionar el primero (por defecto) si es la primera iteración
      if (idx === 0) {
        tallaActualSpan.textContent = item.talla;
        stockSpan.textContent = `Unds disponibles: ${item.stock}`;
        modal.dataset.selectedStock = Number(item.stock);
        modal.dataset.selectedSize = item.talla;
        if (!btn.disabled) btn.classList.add('activo');
      }
    });

    // asegurar que el UI de cantidad/ botones del modal se actualice
    actualizarCantidadUIModal();

    return data;
  } catch (error) {
    console.error("Error al obtener las tallas y stock:", error);
    return [];
  }
}

// función auxiliar que maneja UI de botones + / - en el modal
function actualizarCantidadUIModal() {
  const modal = document.getElementById('productoModal');
  const btnMas = modal.querySelector('.btn-mas-modal');
  const btnMenos = modal.querySelector('.btn-menos-modal');
  const agregarBtn = modal.querySelector('.checkout-modal');
  const cantidadSpan = modal.querySelector('.cantidad-modal');

  if (!cantidadSpan) return;
    const qty = parseInt(cantidadSpan.textContent || '1', 10);
    const stock = parseInt(modal.dataset.selectedStock || '0', 10) || 0;

    btnMenos.disabled = qty <= 1;
    btnMenos.classList.toggle('deshabilitado', btnMenos.disabled);

    if (stock > 0) {
      btnMas.disabled = qty >= stock;
      btnMas.classList.toggle('deshabilitado', btnMas.disabled);
      agregarBtn.disabled = qty <= 0 || qty > stock;
    } else {
      // sin stock “conocido”: permitimos + y agregar (puede ser un producto sin tallas)
      btnMas.disabled = false;
      btnMas.classList.toggle('deshabilitado', false);
      agregarBtn.disabled = false;
    }
    const producto_id_actual = modal.dataset.producto_id;
    if (producto_id_actual) {
      actualizarBotonAgregar(modal, { producto_id: producto_id_actual });
    }
  }

// attach handlers for modal + and - once DOM is ready
document.addEventListener("DOMContentLoaded", () => {
  const modal = document.getElementById('productoModal');
  if (!modal) return;

  const btnMas = modal.querySelector('.btn-mas-modal');
  const btnMenos = modal.querySelector('.btn-menos-modal');
  const cantidadSpan = modal.querySelector('.cantidad-modal');

  if (btnMas) {
    btnMas.addEventListener('click', () => {
      const stock = parseInt(modal.dataset.selectedStock || '0', 10) || 0;
      const qty = parseInt(cantidadSpan.textContent || '1', 10);

      //  no cambies nada si ya está en el tope
      if (stock > 0 && qty >= stock) {
        // ya llegaste al tope → no cambies el texto
        Swal.fire({ icon: "warning", title: "Stock alcanzado", text: `Solo ${stock} Unds disponibles.` });
        return;
      }

      cantidadSpan.textContent = String(qty + 1);
      actualizarCantidadUIModal();
    });
  }

  if (btnMenos) {
    btnMenos.addEventListener('click', () => {
      const qty = parseInt(cantidadSpan.textContent || '1', 10);
      if (qty <= 1) return; //  evita bajar de 1

      cantidadSpan.textContent = String(qty - 1);
      actualizarCantidadUIModal();
    });
  }
});

// Mostrar detalle (ahora async para esperar tallas)
async function mostrarDetalleProducto(producto) {
  const modalElement = document.getElementById("productoModal");

  // ID del producto para dataset
  modalElement.dataset.producto_id = producto.producto_id;

  // Reset cantidad visible
  const cantidadSpan = modalElement.querySelector('.cantidad-modal');
  if (cantidadSpan) cantidadSpan.textContent = '1';

  // Título, precio, descripción
  modalElement.querySelector(".modal-title-producto").textContent = producto.nombre || "Producto sin nombre";
  modalElement.querySelector("#modalPrecio").textContent = parseFloat(producto.precio || 0).toFixed(2);
  modalElement.querySelector("#modalDescripcion").textContent = producto.descripcion || "";

  // Imagen principal (con fallback)
  const imgPrincipal = modalElement.querySelector("#modalImagen-producto");
  if (imgPrincipal) {
    imgPrincipal.src = producto.imagen || "https://via.placeholder.com/300x400?text=Sin+imagen";
    imgPrincipal.onerror = () => {
      imgPrincipal.src = "https://via.placeholder.com/300x400?text=Sin+imagen";
    };
  }

  // --- Carrusel: normaliza entradas (strings u objetos) ---
  const carrusel = modalElement.querySelector(".carrusel-interno");
  if (carrusel) {
    carrusel.innerHTML = "";

    // Normalización de imágenes
    const normalizeSrc = (x) => {
      if (!x) return null;
      if (typeof x === "string") return x;
      if (typeof x === "object" && (x.url || x.src || x.ruta)) return x.url || x.src || x.ruta;
      return null;
    };

    const imagenes = [];
    const front = normalizeSrc(producto.imagen);
    const back  = normalizeSrc(producto.imagen_back);

    if (front) imagenes.push(front);
    if (back)  imagenes.push(back);

    if (Array.isArray(producto.imagenes_adicionales)) {
      for (const it of producto.imagenes_adicionales) {
        const s = normalizeSrc(it);
        if (s) imagenes.push(s);
      }
    }

    // Construcción del carrusel
    imagenes.forEach((src, i) => {
      const div = document.createElement("div");
      div.classList.add("div-dinamico");

      const img = document.createElement("img");
      img.src = src;
      img.alt = i === 0 ? "Frontal" : "Imagen";
      img.onerror = () => { img.src = "https://via.placeholder.com/120x120?text=Img"; };

      // Click de miniatura → actualiza principal y la lupa
      img.addEventListener("click", () => {
        if (!imgPrincipal) return;
        imgPrincipal.classList.add("fade-out");
        setTimeout(() => {
          imgPrincipal.src = src;
          imgPrincipal.classList.remove("fade-out");
          imgPrincipal.classList.add("fade-in");
          setTimeout(() => imgPrincipal.classList.remove("fade-in"), 200);

          // sincroniza la lupa con la nueva imagen
          const lupa = document.querySelector(".lupa");
          if (lupa) lupa.style.backgroundImage = `url(${imgPrincipal.src})`;
        }, 200);
      });

      div.appendChild(img);
      carrusel.appendChild(div);
    });
  }

  // Carga tallas/stock y fija dataset
  await mostrarTallasYStock(producto.producto_id);
  // Actualiza estado del botón agregar
  actualizarBotonAgregar(modalElement, producto)
  // Actualiza estado de +/−
  actualizarCantidadUIModal();

  // Muestra modal con Bootstrap
  const bsModal = new bootstrap.Modal(modalElement);
  bsModal.show();
}

// ***********************************************************************
// funcion para complementar el resultado de busqueda de productos
// ***********************************************************************
document.addEventListener("DOMContentLoaded", () => {
  const params = new URLSearchParams(window.location.search);
  const producto_id = params.get("producto");
  if (producto_id && typeof mostrarDetalleProducto === 'function') {
    // OJO: aquí no basta el ID, hay que cargar los datos primero
    fetch(`admin/front/detalle_producto.php?producto_id=${producto_id}`)
      .then(r => r.json())
      .then(data => {
        if (data && data.exito) {
          mostrarDetalleProducto(data.producto);
        }
      })
      .catch(err => console.error("Error al cargar producto:", err));
  }
});


// ==========================================================================
// Función para ajustar alto de overlay y carrito flotante en viejos navegadores
// ==========================================================================
function setVH() {
  document.documentElement.style.setProperty('--vh', `${window.innerHeight * 0.01}px`);
}
window.addEventListener('resize', setVH);
setVH();

export {
  actualizarBotonAgregar,
}