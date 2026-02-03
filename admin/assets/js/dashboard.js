// ==============================
// 1. Efecto de bienvenida
// ==============================
document.addEventListener("DOMContentLoaded", () => {
  const transition_reverse = document.getElementById("page-transition-reverse");
  
    requestAnimationFrame(() => {
    transition_reverse.classList.add("active");
  });
});

// ==============================
// 2. Estilo para los iconos activados
// ==============================
function activarOpcion(seccion) {
  document.querySelectorAll('.opciones ul li')
    .forEach(li => li.classList.remove('opcion-seleccionada'));

  const liActivo = document.querySelector(
    `.opciones ul li[data-seccion="${seccion}"]`
  );

  if (liActivo) liActivo.classList.add('opcion-seleccionada');
}
