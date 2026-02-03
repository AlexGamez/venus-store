document.addEventListener("DOMContentLoaded", () => {
  const pagina = document.body.dataset.page;

  // Solo ejecutar este bloque si estamos en el index
  if (pagina === 'index') {

    // ===============================
    // Subrayado dinámico de botones
    // ===============================
    const underline = document.querySelector(".underline");
    const btnGroup = document.querySelector(".btn-group");
    const buttons = btnGroup ? btnGroup.querySelectorAll(".btn") : [];

    if (underline && btnGroup && buttons.length > 0) {
      function moveUnderline(button) {
        const buttonRect = button.getBoundingClientRect();
        const groupRect = btnGroup.getBoundingClientRect();
        underline.style.width = `${buttonRect.width}px`;
        underline.style.left = `${buttonRect.left - groupRect.left}px`;
      }

      // Mover al primer botón al cargar
      moveUnderline(buttons[0]);

      // Mover cada vez que se hace clic
      buttons.forEach((btn) => {
        btn.addEventListener("click", () => moveUnderline(btn));
      });
    }

    // ===============================
    // Función para "News IN" (Hombre, Mujer, Sets)
    // ===============================
    const secciones = ['hombre', 'mujer', 'set'];

    function mostrarSeccion(seccion) {
      secciones.forEach(sec => {
        const el = document.getElementById(sec);
        if (!el) return;
        el.classList.toggle('activa', sec === seccion);
      });
    }

    const btnHombre = document.getElementById('btn-hombre');
    const btnMujer = document.getElementById('btn-mujer');
    const btnSet = document.getElementById('btn-set');

    if (btnHombre && btnMujer && btnSet) {
      btnHombre.addEventListener('click', () => mostrarSeccion('hombre'));
      btnMujer.addEventListener('click', () => mostrarSeccion('mujer'));
      btnSet.addEventListener('click', () => mostrarSeccion('set'));

      // Mostrar por defecto la sección "hombre"
      mostrarSeccion('hombre');
    }
  }
});
