// ==============================
// 1. Funcio para pintar ventas
// ==============================
function pintarVentas(ventas, contenedor) {
  contenedor.innerHTML = "";
  ventas.forEach(v => {
    const tr = document.createElement("tr");
    const fechaSolo = v.fecha.split(" ")[0];
    const estadoClase = v.estado
      .toLowerCase()
      .replace(/\s+/g, '-'); // en-proceso


    tr.innerHTML = `
        <td><strong>#${v.id}</strong></td>
        <td>$${v.monto}</td>
        <td>${fechaSolo}</td>
        <td><span class="estado ${estadoClase}">${v.estado}</span></td>
        <td>${v.nombre}</td>
      `;
    tr.addEventListener("click", () => mostrarDetalle(v.id));
    contenedor.appendChild(tr);
  });
}

// ==============================
// 2. cargar las ventas luego del DOMException
// ==============================
function initVentas() {

  const contRecientes = document.querySelector(".ventas-recientes");
  const contGenerales = document.querySelector(".ventas-generales");

  // Ventas recientes (HOME)
  if (contRecientes) {
    fetch(`${window.BASE_URL}/admin/ventas_model.php?tipo=recientes`)
      .then(res => res.json())
      .then(data => {
        if (data.status === "success") {
          pintarVentas(data.data, contRecientes);
        }
      });
  }

  // Ventas generales (VENTAS)
  if (contGenerales) {
    fetch(`${window.BASE_URL}/admin/ventas_model.php?tipo=generales`)
      .then(res => res.json())
      .then(data => {
        if (data.status === "success") {
          pintarVentas(data.data, contGenerales);
          initSorting();
        }
      });
  }
}

// ==============================
// 3. Mostrar detalle (AJAX)
// ==============================
function mostrarDetalle(ventaId) {
  fetch(`${window.BASE_URL}/admin/detalle_venta_model.php?venta_id=${ventaId}`)
    .then(res => res.json())
    .then(data => {
      if (data.status === "success") {
        renderDetalle(data);
      } else {
        alert("Error: " + data.message);
      }
    })
    .catch(err => console.error(err));
}

// ==============================
// 4. Renderizar detalle (modal/seccion)
// ==============================
function renderDetalle(data) {
  const pedido = data.pedido;
  const detalles = data.detalles;

  let html = `
      <div class="detalle-venta">
        <h3>Venta #${pedido.venta_id}</h3>        
        <p><span>Cliente:</span> ${pedido.nombre} ${pedido.apellido}</p>
        <p><span>Dirección:</span> ${pedido.direccion}, ${pedido.ciudad}</p>
        <p><span>Tel:</span> ${pedido.telefono}</p>
        <p><span>Email:</span> ${pedido.correo}</p>
        <p><span>Fecha:</span> ${pedido.fecha}</p>
        <p><span>Estado:</span> ${pedido.estado}</p>
        <p><span>Total:</span> $${pedido.total}</p>
        <h3>Productos:</h3>

        <ul>
    `;
  detalles.forEach(d => {
    html += `
        <li>
          <img src="${d.imagen}" width="50" />
          ${d.producto_nombre} - ${d.cantidad} x $${d.precio_unitario} = $${d.subtotal}
        </li>
      `;
  });

  html += "</ul></div>";

  Swal.fire({
    title: "Detalle de Venta",
    html: html,
    width: "600px",
  });
}

// ==============================
// 5. Orden dinámico de tabla
// ==============================
function initSorting() {
  const tabla = document.getElementById("tablaPedidos");
  if (!tabla) return;
  const cabeceras = tabla.querySelectorAll("th");
  let columnaOrdenActual = null;
  let direccionOrden = 1;

  cabeceras.forEach((th, index) => {
    if (th.dataset.sortAttached === "1") return;
    th.dataset.sortAttached = "1";

    th.addEventListener("click", () => {
      const tipo = th.getAttribute("data-tipo") || "texto";
      if (columnaOrdenActual === index) {
        direccionOrden *= -1;
      } else {
        columnaOrdenActual = index;
        direccionOrden = (index === 0 ? -1 : 1);
      }

      ordenarTabla(index, tipo, direccionOrden);

      // Cambiar visualmente la dirección
      cabeceras.forEach(h => h.classList.remove("orden-asc", "orden-desc"));
      th.classList.add(direccionOrden === 1 ? "orden-asc" : "orden-desc");
    });
  });

  function ordenarTabla(colIndex, tipo, direccion) {
    const filas = Array.from(tabla.querySelector("tbody").rows);

    function parseNumber(str) {
      if (!str) return 0;
      return parseFloat(String(str).replace(/[^0-9\-,.]/g, "").replace(",", ".")) || 0;
    }

    function parseDateValue(str) {
      if (!str) return 0;
      if (/^\d{1,2}\/\d{1,2}\/\d{2,4}$/.test(str)) {
        const [d, m, yRaw] = str.split("/");
        const y = yRaw.length === 2 ? 2000 + parseInt(yRaw) : parseInt(yRaw);
        return new Date(y, m - 1, d).getTime();
      }
      return new Date(str).getTime() || 0;
    }

    const estadoOrder = { aprobado: 0, pagado: 0, completado: 0, pendiente: 1, procesando: 1, cancelado: 2 };

    filas.sort((a, b) => {
      const valorA = a.cells[colIndex]?.innerText.trim() || "";
      const valorB = b.cells[colIndex]?.innerText.trim() || "";

      if (tipo === "numero") {
        return (parseNumber(valorA) - parseNumber(valorB)) * direccion;
      }
      if (tipo === "fecha") {
        return (parseDateValue(valorA) - parseDateValue(valorB)) * direccion;
      }
      if (tipo === "estado") {
        const va = estadoOrder[valorA.toLowerCase()] ?? 99;
        const vb = estadoOrder[valorB.toLowerCase()] ?? 99;
        return (va - vb) * direccion;
      }
      return valorA.localeCompare(valorB, undefined, { numeric: true }) * direccion;
    });

    const cuerpo = tabla.querySelector("tbody");
    cuerpo.innerHTML = "";
    filas.forEach(f => cuerpo.appendChild(f));
  }
};


document.addEventListener("DOMContentLoaded", () => {
  initVentas();
});

// ==============================
// FIN - ventas.js
// ==============================
