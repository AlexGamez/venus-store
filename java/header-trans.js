// *****************************************************************
// Función para el primer header que a su vez es el carrusel de texto
// *****************************************************************
const texts = ["Cambios y devoluciones Gratis", "Envíos GRATIS desde cualquier monto", "Aprovecha las ofertas Hot"];
let index = 0;
const textElement = document.getElementById("text-carousel");

function changeText() {
  // Efecto de salida
  textElement.style.transform = "translateY(-100%)";
  textElement.style.opacity = "0";

  setTimeout(() => {
    index = (index + 1) % texts.length; // Cambia al siguiente texto
    textElement.innerText = texts[index];

    // Efecto de entrada
    textElement.style.transform = "translateY(100%)"; // Posiciona fuera de la vista
    textElement.style.opacity = "0";

    setTimeout(() => {
      textElement.style.transform = "translateY(0%)";
      textElement.style.opacity = "1";
    }, 300); // Pequeño retraso para que el texto ya esté cambiado antes de entrar
  }, 500); // Tiempo de la animación de salida
}

setInterval(changeText, 4300); // Cambia cada 3 segundos


// *-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*
// Función del segundo header
// *-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*
document.addEventListener('DOMContentLoaded', () => {
  const pagina = document.body.dataset.page;
  // Solo ejecutar este bloque si estamos en el index
    if (pagina === 'index') {
      let lastScrollY = window.scrollY;
      const header = document.querySelector('.cabecero');
      const carrusel = document.querySelector('.carousel-container');

      window.addEventListener('scroll', () => {
        if (window.scrollY > lastScrollY) {
          // Al desplazarse hacia abajo, oculta el header
          header.style.transform = 'translateY(-100%)';
          header.style.top = '0';
        } else {
          // Al desplazarse hacia arriba, muestra el header
          header.style.transform = 'translateY(0)';
            
          if (window.scrollY === 0) {
            // En el tope → debajo del carrusel
            header.style.top = carrusel.offsetHeight + 'px';
          } else {
            // Durante el scroll → cubrir carrusel
            header.style.top = '0';
          }
        }
        lastScrollY = window.scrollY;
      });
    }
});
// ****************************************************************************
// Función para que el menú nav en móvil se cierre al dar click fuera
// ****************************************************************************

document.addEventListener("click", function (event) {
  const navbar = document.getElementById("navbarNav");
  const toggler = document.querySelector(".navbar-toggler");

  // Verifica si el menú está abierto
  const isOpen = navbar.classList.contains("show");

  // Si está abierto y el click NO ocurrió dentro del navbar ni en el botón
  if (isOpen && !navbar.contains(event.target) && !toggler.contains(event.target)) {
    const collapse = new bootstrap.Collapse(navbar, {
      toggle: false
    });
    collapse.hide();
  }
});

// ****************************************************************************
// Quitar focus del botón hamburguesa cada vez que se pulse
// ****************************************************************************
const toggler = document.querySelector(".navbar-toggler");
toggler.addEventListener("click", function () {
  this.blur();
});
