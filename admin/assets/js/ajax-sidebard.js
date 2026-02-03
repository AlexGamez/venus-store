// Captura de clics
document.addEventListener("DOMContentLoaded", () => {
  const opciones = document.querySelectorAll('.opciones ul li[data-seccion]');

  opciones.forEach(li => {
    li.addEventListener('click', () => {
      const seccion = li.dataset.seccion;

      // marcar activo
      activarOpcion(seccion);

      // cambiar URL sin recargar
      history.pushState({ seccion }, '', `?page=${seccion}`);

      // cargar contenido
      cargarSeccion(seccion);
    });
  });

  // cargar sección inicial
  cargarDesdeURL();
});


// Leer sección desde la URL
function cargarDesdeURL() {
  const params = new URLSearchParams(window.location.search);
  const seccion = params.get('page') || 'home';

  activarOpcion(seccion);
  cargarSeccion(seccion);
}

// Soporte para botón atrás / adelante
window.addEventListener('popstate', e => {
  const seccion = e.state?.seccion || 'home';

  activarOpcion(seccion);
  cargarSeccion(seccion);
});


// Ajax de sidebar
function cargarSeccion(seccion) {
  const cont = document.getElementById('contenido');

  // Animación de salida para cada seccion
  cont.classList.add('vista-saliendo');

    setTimeout(() => {  
      fetch(`${window.BASE_URL}/admin/pages/${seccion}.php`)
    
        .then(res => {
            if (!res.ok) throw new Error('Error al cargar sección');
            return res.text();
        })
        .then(html => {
          
          // esto reemplaza el contenido
          cont.innerHTML = html;

          // esto prepara la animacion de entrada
          cont.classList.remove('vista-saliendo');
          cont.classList.add('vista-entrando');

          // Esto refuerza el repaint y quitamos la clase por si se pega
          requestAnimationFrame(() => {
            cont.classList.remove('vista-entrando');
            });

          // Logica para el cambio de vistas/seccion
          if (seccion === 'inventario') initInventario();
          if (seccion === 'ventas') initVentas();
          if (seccion === "home") {
              initVentas();
              cargarGraficaVentas();
            }
        })
        .catch(err => {
            console.error(err);
            document.getElementById('contenido').innerHTML = `
                <p>Error cargando la sección</p>
            `;
        });
      }, 300);
}
