// ==========================================================================
// función para busqueda de productos
// ==========================================================================
document.addEventListener("DOMContentLoaded", () => {
  const $form    = document.getElementById('search-form');
  const $input   = document.getElementById('search-input');
  const $icon    = document.getElementById('search-icon');

  let resultados = [];
  let activeIndex = -1;
  let t;

  function debounce(fn, delay=300){
    return (...args)=>{ clearTimeout(t); t = setTimeout(()=>fn(...args), delay); }
  }

  function formatCOP(n){ try { return Number(n).toLocaleString('es-CO'); } catch { return n; } }

  const $suggest = document.getElementById('search-suggest');

  function render(items) {
  resultados = items;
  activeIndex = -1;
  $suggest.innerHTML = '';

  if (!items.length) {
    $suggest.innerHTML = '<p class="list-group-item text-center align-items-center mt-2">No se encontraron resultados</p>';
    $suggest.classList.remove('d-none');
    return;
  }

  items.forEach((p, i) => {
    const el = document.createElement('button');
    el.type = 'button';
    el.className = 'list-group-item list-group-item-action sugerencia';
    el.dataset.id = p.producto_id;
    el.dataset.page = p.page;

    el.innerHTML = `
      <img src="${p.imagen}" alt="imagen-resultado">
      <span class="flex-grow-1 text-start ms-2">${escapeHtml(p.nombre)}</span>
      <span class="span-2">$${formatCOP(p.precio)}</span>
    `;

    $suggest.appendChild(el);

    // animación escalonada
    setTimeout(() => el.classList.add('mostrar'), i * 60);
  });
  
  $suggest.classList.remove('d-none');            // si usas bootstrap
  // forzar reflow antes de añadir la clase para que la transición se anime
  requestAnimationFrame(() => {
    $suggest.classList.add('abierto');
  });
  $suggest.classList.remove('d-none');
}

  function escapeHtml(s=''){return s.replace(/[&<>"']/g, m=>({ '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;' }[m]));}

  const buscar = debounce(async (q)=>{
    if (!q || q.trim().length < 2) { $suggest.classList.add('d-none'); $suggest.innerHTML=''; resultados=[]; return; }
    try{
      const url = `${window.BASE_URL}/admin/front/buscar-productos.php?q=${encodeURIComponent(q)}`;
      const resp = await fetch(url);
      if (!resp.ok) throw new Error(`HTTP ${resp.status}`);
      const data = await resp.json();
      render(Array.isArray(data) ? data : []);
  } catch (e) {
    console.error('Error buscando:', e);
  }
    }, 300);
  // input
  $input.addEventListener('input', e => buscar(e.target.value));

  // teclado en input (Enter, Esc, ↑, ↓)
  $input.addEventListener('keydown', (e)=>{
    const visible = !$suggest.classList.contains('d-none');
    if (!visible) return;

    const items = Array.from($suggest.querySelectorAll('.sugerencia'));
    if (!items.length) return;

    if (e.key === 'ArrowDown') {
      e.preventDefault();
      activeIndex = (activeIndex + 1) % items.length;
      updateActive(items);
    } else if (e.key === 'ArrowUp') {
      e.preventDefault();
      activeIndex = (activeIndex - 1 + items.length) % items.length;
      updateActive(items);
    } else if (e.key === 'Enter') {
      e.preventDefault();
      const btn = items[activeIndex >= 0 ? activeIndex : 0];
      if (btn) navegar(btn.dataset.page, btn.dataset.id);
    } else if (e.key === 'Escape') {
      cerrar();
    }
  });

  function updateActive(items){
    items.forEach((el,i)=> el.classList.toggle('active', i===activeIndex));
  }

  function cerrar(){
  // quitar la clase que abre (inicia la transición de cierre)
  $suggest.classList.remove('abierto');

  // limpiar los items y esconder del DOM después de que termine la transición
  setTimeout(() => {
    $suggest.classList.add('d-none');   // si usas bootstrap
    $suggest.innerHTML = '';
  }, 250); // debe coincidir o ser ligeramente mayor que la transición CSS (aquí 250ms)
  resultados = [];
  activeIndex = -1;
}

  // click en sugerencias
  $suggest.addEventListener('click', (e)=>{
    const btn = e.target.closest('.sugerencia');
    if (!btn) return;
    navegar(btn.dataset.page, btn.dataset.id);
  });

  // click en la lupa: usa el primero si hay lista; si no, dispara búsqueda y usa el primero
  $icon.addEventListener('click', async ()=>{
    const visible = !$suggest.classList.contains('d-none');
    if (visible) {
      const first = $suggest.querySelector('.sugerencia');
      if (first) { navegar(first.dataset.page, first.dataset.id); }
      return;
    }
    const q = $input.value.trim();
    if (!q) return;
    try {
      const url = `${window.BASE_URL}/admin/front/buscar-productos.php?q=${encodeURIComponent(q)}`;
      const resp = await fetch(url);
      if (!resp.ok) throw new Error(`HTTP ${resp.status}`);
      const data = await resp.json();
      render(Array.isArray(data) ? data : []);
    } catch (e) {
      console.error('Error buscando:', e);
    }
  });

  // click fuera -> cerrar
  document.addEventListener('click', (e)=>{
    if (!document.getElementById('search-box').contains(e.target)) cerrar();
  });

  // prevenir submit del form (Enter)
  $form.addEventListener('submit', (e)=>{
    e.preventDefault();
    const first = $suggest.querySelector('.sugerencia');
    if (first) navegar(first.dataset.page, first.dataset.id);
  });

  function navegar(page, id){
    cerrar();
    // redirige a la página del género con el parámetro ?producto=ID
    window.location.href = `${page}?producto=${id}`;
  }
});
