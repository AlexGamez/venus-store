<?php include './drivers/conexion.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venus Store/Carrito</title>
    <!-- icono de la página -->
    <link rel="icon" type="image/x-icon" href="./img/icono.png">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- icono de Font -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=tune" />
    
    <!-- Fuente combinada en un solo enlace -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible+Next:wght@400;700&family=Bebas+Neue&family=DM+Serif+Text&family=Jost:wght@300;600&family=League+Spartan:wght@400;700&family=Libre+Franklin:wght@300;600&family=Merienda&family=Oswald:wght@400;700&family=Roboto:wght@400;700&family=Markazi+Text:wght@400..700&display=swap" rel="stylesheet">
   
    <!-- mi css -->
    <link rel="stylesheet" href="./css/carrito.css">
    <!-- <link rel="stylesheet" href="/css/carrito.css?v=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . '/css/carrito.css') ?>"> -->

    <!-- sweet alerts -->
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
</head>

<body>
<!--Botoncito de Whtsp -->
<a href="https://wa.me/1234567890" class="whatsapp_float" target="_blank">
<img src="./img/whatsapp.png" alt="WhatsApp" />
</a>
<!-- Header -->
<header class="container-fluid custom-header">
    <nav class="navbar navbar-expand-md responsive">
        <div class="container responsive">
            <a class="navbar-brand" href="./index.php">
                <span class="titulo ms-4">Venus Store</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto me-auto mb-2 mb-md-0">
                <li class="nav-item p-2">
                <a class="nav-link active" aria-current="page" href="./catalogo.php">TIENDA</a>
                </li>
                <li class="nav-item p-2">
                <a class="nav-link active" href="./hombres.php">HOMBRES</a>
                </li>
                <li class="nav-item p-2">
                    <a class="nav-link active" href="./mujeres.php ">MUJERES</a>
                </li>
                </li>
                <li class="nav-item p-2">
                    <a href="./hot.php" class="nav-link active" aria-disabled="true">HOT
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-fire mb-1" viewBox="0 0 16 16">
                        <path d="M8 16c3.314 0 6-2 6-5.5 0-1.5-.5-4-2.5-6 .25 1.5-1.25 2-1.25 2C11 4 9 .5 6 0c.357 2 .5 4-2 6-1.25 1-2 2.729-2 4.5C2 14 4.686 16 8 16m0-1c-1.657 0-3-1-3-2.75 0-.75.25-2 1.25-3C6.125 10 7 10.5 7 10.5c-.375-1.25.5-3.25 2-3.5-.179 1-.25 2 1 3 .625.5 1 1.364 1 2.25C11 14 9.657 15 8 15"/>
                        </svg>
                    </a>
            </ul>
            <!-- Botón de búsqueda y carrito -->
            <div id="search-box" class="position-relative d-flex me-4" style="width: 20rem;">
              <form id="search-form" class="d-flex" role="search" autocomplete="off">
                <input id="search-input" class="form-control me-2 ps-1 pe-0" type="search" placeholder="¿Que deseas?" aria-label="Search">
                  <i id="search-icon" role="button" tabindex="0" aria-label="Buscar" class="bi bi-search-heart"></i><!--Icono de Lupita-->
              </form>
              <!-- Caja de sugerencias -->
              <div id="search-suggest">
              <!-- Aquí se inyectan resultados -->
              </div>
            
              <button class="btn ms-4 me-5 p-0" type="button" id="btn-carrito">
                  <i class="bi bi-handbag"></i><!--Icono de carrito-->
                  <span id="carrito-cantidad" class="carrito-burbuja">0</span>
              </button>             
            </form>
            </div>
        </div>
    </nav>
</header>

<!-- ========================================================================== -->
<!-- Sección de productos, cantidad  total -->
<!-- ========================================================================== -->

<div class="container-fluid mt-5 text-center" >
    <span class="msj-seccion">Carrito</span>
</div>   
<div class="container-fluid p-5 mt-2 padre-producto">
    <div class="row align-items-start" id="carrito-contenido-padre">
        <div class="col-12 col-md-8 d-flex">
            <div class="producto" id="productos-carrito">
                <p>Producto</p>
                <div class="carrito-contenido">
                  <!-- aquí van los productos en miniatura y al lado nombre, talla y precio unitario insertados desde JavaScript-->
                </div>
            </div>
            <div class="cantidad">
                <p>Cantidad</p>
                <div class="acciones-carrito" id="acciones-cantidad">
                </div>
            </div>
            
            <div class="total">
                <p>Total</p>
                <div class="precio">$<span id="total-carrito">0<!-- Aquí va el total del precio unitario * cantidad--></span></div>
            </div>
        </div>
        <!-- PASARELA DE PAGO -->
        <div class="col-sm-12 col-md-5 pasarela">
          aquí irá el vinculo a la pasarela de pago
          <br><br><br>
          Nota: Una vez seleccionado el método de pago y rellenado los datos de envío, serás redirigido al método de pago elegido
        </div>
    </div>
</div>
<br>
<br>
<section> 
<!-- ========================================================================================   -->
  <!-- contenedor de información de envío y pago -->
<!-- ========================================================================================   -->
<div class="container" id="pago-zone">
  <!-- PRIMERO CAJA DE DATOS DE ENTREGA -->
   <div class="row paso-final">
    <div class="col-sm-12 col-md-7 datos-entrega text-center">
      <h2>Datos de Entrega</h2>
        <form id="checkout-form" action="admin/procesar_pago.php" method="POST" onsubmit="return enviarCarrito(event)">
        <!-- nombre y apelido -->
        <div class="row g-2">
          <div class="col-md-6">
            <label class="form-label" for="name"></label>
            <input type="text" class="form-control" id="nombre" name="nombre" required placeholder="Nombres">
          </div>
          <div class="col-md-6">
            <label class="form-label" for="apellido"></label>
            <input type="text" class="form-control" id="apellido" name="apellido" required placeholder="Apellidos">
          </div>
        
        <!-- dirección y ciudad -->
          <div>
            <label class="form-label" for="direccion"></label>
            <input type="text" class="form-control" id="direccion" name="direccion" required placeholder="Dirección">
          </div>
          <!-- dirección adicionales -->
          <div class="col-lg-6">
            <label class="form-label" for="direccion_adicional"></label>
            <input type="text" class="form-control" id="direccion_adicional" name="direccion_adicional" placeholder="Casa, apartamento, etc.">
          </div>
          <!-- Ciudad -->
          <div class="col-lg-6">
            <label class="form-label"></label>
            <input type="tel" class="form-control" id="ciudad" name="ciudad" placeholder="Ciudad">
          </div>
          <!-- Teléfono -->
          <div class="col-lg-6">
            <label class="form-label"></label>
            <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Teléfono">
          </div>
          <!-- Correo -->
          <div class="mb-1 col-lg-6">
            <label class="form-label"></label>
            <input type="tel" class="form-control" id="correo" name="correo" placeholder="Correo">
        </div>
        <input type="hidden" name="carrito" id="carrito_data">
        <!-- Botón de Envío -->
        <button type="submit" class="btn w-90 mt-4 ms-5 pago">P A G A R</button>
      </form>
    </div>
  </div>
</div>
</section>

<!-- ========================================================================================   -->
  <!-- Sección del acordeon de preguntas frecuentes -->
<!-- ========================================================================================   -->

  <div class="container-fluid mt-5 p-5 d-flex justify-content-center papi-acordion">
    <div class="accordion mt-2 mb-4" id="faqAccordion">
      <h3>Dudas Frecuentes</h3><br>
      <p>Ante cualquier duda recuerda que siempre cuentas con nuestras líneas de atención vía Whatsapp y Correo</p><br>
  <!-- Pregunta 1 -->
  
      <div class="accordion-item lado-visible">
        <div class="under">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed lado-visible-text" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="false">
              ¿Debo comprar la talla que normalmente uso?
            </button>
          </h2>
          <!-- despliegue-->
          <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
            <div class="accordion-body">
              Sí, recomendamos elegir la talla que usas normalmente, pero puedes revisar nuestra guía de tallas.
            </div>
          </div>
        </div>
      </div>

  <!-- Pregunta 2 -->

      <div class="accordion-item mt-4 lado-visible">
        <div class="under">
          <h2 class="accordion-header">
          <button class="accordion-button collapsed lado-visible-text" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false">
            ¿Puedo hacer cambio de mi producto?
          </button>
          </h2>
          <!-- despliegue-->
          <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
            <div class="accordion-body">
              ¡Claro que sí! Puedes hacer cambios dentro de los 7 días naturales posteriores a la compra, puedes solicitarlo a través de nuestro whatsapp o correo con asunto "Cambio" o "devolución" según sea el caso. Recuerda que el producto debe estar en perfecto estado y con etiquetas.
            </div>
          </div>
        </div>
      </div>

  <!-- Pregunta 3 -->

      <div class="accordion-item mt-4 lado-visible">
        <div class="under">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed lado-visible-text" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false">
              ¿Cuánto tarda en ser entregado mi producto?
            </button>
          </h2>
          <!-- despliegue-->
          <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
            <div class="accordion-body">
              Si bien el el tiempo de envío puede variar según la zona destino, en promedio las órdenes se entrega entre 2 a 5 días hábiles.
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<!-- Pie de página -->
<footer class="footer1">
    <div class="footer">
        <div class="ubicacion">
            <p>VENUS STORE</p>
            <span>Venus, siempre tu mejor elección para lucir bien</span>
        </div>
    <div class="contacto">
        <p>CONTÁCTANOS:</p>
        <span>316 516 5397</span>
        <span>venuz.store.colombia@gmail.com</span>
    </div><br>
    <div class="redes">
        <p>SÍGUENOS EN:</p>
        <div class="social-login-icons"> <!-- Tiktok -->
            <div class="socialcontainer">
                <div class="icon social-icon-1-1">
                <svg
                    viewBox="0 0 448 512"
                    height="1.7em"
                    xmlns="http://www.w3.org/2000/svg"
                    class="svgIcontwit"
                    fill="white"
                >
                    <path
                    fill="#ffffff" 
                    d="M448 209.9a210.1 210.1 0 0 1 -122.8-39.3V349.4A162.6 162.6 0 1 1 185 188.3V278.2a74.6 74.6 0 1 0 52.2 71.2V0l88 0a121.2 121.2 0 0 0 1.9 22.2h0A122.2 122.2 0 0 0 381 102.4a121.4 121.4 0 0 0 67 20.1z"
                    ></path>
                </svg>
                </div>
                <div class="social-icon-1">
                <svg
                    viewBox="0 0 512 512"
                    height="1.7em"
                    xmlns="http://www.w3.org/2000/svg"
                    class="svgIcontwit"
                    fill="white"
                >
                    <path
                        d="M448 209.9a210.1 210.1 0 0 1 -122.8-39.3V349.4A162.6 162.6 0 1 1 185 188.3V278.2a74.6 74.6 0 1 0 52.2 71.2V0l88 0a121.2 121.2 0 0 0 1.9 22.2h0A122.2 122.2 0 0 0 381 102.4a121.4 121.4 0 0 0 67 20.1z"
                    ></path>
                </svg>
                </div>

            </div>
            <div class="socialcontainer"> <!-- Instagram -->
                <div class="icon social-icon-2-2">
                <svg
                    fill="white"
                    class="svgIcon"
                    viewBox="0 0 448 512"
                    height="1.5em"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                    fill="#ffffff" 
                    d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"
                    ></path>
                </svg>
                </div>
                <div class="social-icon-2">
                <svg
                    fill="white"
                    class="svgIcon"
                    viewBox="0 0 448 512"
                    height="1.5em"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                    d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"
                    ></path>
                </svg>
                </div>
            </div>
            <a href="https://www.facebook.com/profile.php?id=61566389901912" target="_blank">
            <div class="socialcontainer"> <!-- facebook -->
                <div class="icon social-icon-3-3">
                <svg
                    viewBox="0 0 384 512"
                    fill="white"
                    height="1.6em"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                    fill="#ffffff" 
                    d="M80 299.3V512H196V299.3h86.5l18-97.8H196V166.9c0-51.7 20.3-71.5 72.7-71.5c16.3 0 29.4 .4 37 1.2V7.9C291.4 4 256.4 0 236.2 0C129.3 0 80 50.5 80 159.4v42.1H14v97.8H80z"
                    ></path>
                </svg>
                </div>
                <div class="social-icon-3">
                <svg
                    viewBox="0 0 384 512"
                    fill="white"
                    height="1.6em"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                    d="M80 299.3V512H196V299.3h86.5l18-97.8H196V166.9c0-51.7 20.3-71.5 72.7-71.5c16.3 0 29.4 .4 37 1.2V7.9C291.4 4 256.4 0 236.2 0C129.3 0 80 50.5 80 159.4v42.1H14v97.8H80z"
                    ></path>
                </svg>
                </div>
            </div> </a>
        </div>
    </div>
</div>
<br>
<br>
<div class="ultimo">
<span>© 2024, Venus Store</span>
<span><a href="./cumplimiento.html">Aviso de Cumplimiento</a></span>
<span><a href="./terminos.html">Términos y Condiciones</a></span>
</div>
</footer>

<!-- Ruta global para busqueda de productos -->
<script>
  window.BASE_URL = "<?php echo rtrim(dirname($_SERVER['SCRIPT_NAME']), '/'); ?>";
</script>

<!-- Aquí los scripts de Java -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- mi js -->
<script type="module" src="<?= BASE_URL ?>/java/main.js"></script>

</body>
</html>