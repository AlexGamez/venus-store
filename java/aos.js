// Inicializa AOS
AOS.init({
  duration: 1000,
  easing: 'ease-in-out',
  once: true,
  offset: 20,
});


document.addEventListener('aos:in', ({ detail: el }) => {
  const count = aosRepeats.get(el) || 0;
  if (count + 1 >= maxRepeats) {
    el.removeAttribute('data-aos'); // desactiva el efecto
  } else {
    aosRepeats.set(el, count + 1);
  }
});

// Swiper config
const pagina = document.body.dataset.page;

if (pagina === 'index') {
  const swiper = new Swiper(".mySwiper", {
    loop: true,
    autoplay: {
      delay: 4400,
      disableOnInteraction: false,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    effect: 'fade',
    speed: 800,
  });

  swiper.on('slideChangeTransitionStart', () => {
    document.querySelectorAll('[data-aos]').forEach(el => {
      el.classList.remove('aos-animate');
      void el.offsetWidth;
      el.classList.add('aos-animate');
    });
  });
}
