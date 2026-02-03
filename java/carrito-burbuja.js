// carrito-burbuja.js
'use strict';

// ==============================
// Burbuja del carrito (contador del icono)
// ==============================
document.addEventListener('DOMContentLoaded', () => {
  const spanCantidad = document.getElementById('carrito-cantidad');
  if (!spanCantidad) return;

  function leerItems() {
    try {
      const raw = localStorage.getItem('carrito');
      if (!raw) return [];
      const parsed = JSON.parse(raw);

      // Soporta formatos viejo y nuevo
      if (Array.isArray(parsed)) return parsed;                // legado: era un array
      if (Array.isArray(parsed?.items)) return parsed.items;   // actual: {version, items}
      return [];
    } catch {
      return [];
    }
  }

  function actualizarCantidadIcono() {
    const items = leerItems();
    const totalProductos = items.reduce((acc, prod) => acc + (Number(prod.cantidad) || 0), 0);

    if (totalProductos > 0) {
      spanCantidad.textContent = totalProductos;
      spanCantidad.style.display = 'inline-block';
    } else {
      spanCantidad.style.display = 'none';
    }
  }

  actualizarCantidadIcono();

  // Se actualizará cuando cambie el storage (otras pestañas) o cuando tú dispares el evento
  window.addEventListener('storage', (e) => {
    if (!e.key || e.key === 'carrito') actualizarCantidadIcono();
  });

  // (Opcional, más limpio) Si en guardarCarrito disparas un evento propio:
  // window.addEventListener('carrito:actualizado', actualizarCantidadIcono);
});
