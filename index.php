<?php include './drivers/conexion.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Venus Store/Inicio</title>
  <!-- icono de la página -->
  <link rel="icon" type="image/x-icon" href="img/icono.png">
  
  <!-- icono de Font -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=tune" />

  <!-- Fuente combinada en un solo enlace -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible+Next:wght@400;700&family=Bebas+Neue&family=DM+Serif+Text&family=Jost:wght@300;600&family=League+Spartan:wght@400;700&family=Libre+Franklin:wght@300;600&family=Merienda&family=Oswald:wght@400;700&family=Roboto:wght@400;700&family=Markazi+Text:wght@400..700&family=Sansation:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
  
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!-- AOS -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  
  <!-- Swiper -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

  <!-- mi css -->
  <link rel="stylesheet" href="./css/index.css">
  <link rel="stylesheet" href="./css/popup.css">

  <!-- sweet alerts -->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body data-page="index">

<!--Botoncito de Whtsp -->
<a href="https://wa.me/+573171821403" class="whatsapp_float" target="_blank">
  <img src="./img/whatsapp.png" alt="WhatsApp" />
</a>

<!-- Header -->
<div class="container-fluid bg-black carousel-container ">
    <header class="carousel-text " id="text-carousel"> 💖 Bienvenido a nuestra tienda 💖 </header>
</div>

<header class="cabecero">
    <nav class="navbar navbar-expand-md responsive">
        <div class="container responsive">
            <a class="navbar-brand" href="./index.php">
                <span class="titulo ms-4 ms-0">Venus Store</span>
            </a>
            <button class="navbar-toggler me-4" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse ms-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto me-auto mb-2 mb-md-0">
                <li class="nav-item p-2 px-2">
                <a class="nav-link active" aria-current="page" href="./catalogo.php">TIENDA</a>
                </li>
                <li class="nav-item p-2 px-2">
                <a class="nav-link active" href="./hombres.php">HOMBRES</a>
                </li>
                <li class="nav-item p-2 px-2">
                  <a class="nav-link active" href="./mujeres.php ">MUJERES</a>
                </li>
                </li>
                <li class="nav-item p-2 px-2">
                    <a class="nav-link active" href="./hot.php" aria-disabled="true">HOT
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-fire mb-1" viewBox="0 0 16 16">
                        <path d="M8 16c3.314 0 6-2 6-5.5 0-1.5-.5-4-2.5-6 .25 1.5-1.25 2-1.25 2C11 4 9 .5 6 0c.357 2 .5 4-2 6-1.25 1-2 2.729-2 4.5C2 14 4.686 16 8 16m0-1c-1.657 0-3-1-3-2.75 0-.75.25-2 1.25-3C6.125 10 7 10.5 7 10.5c-.375-1.25.5-3.25 2-3.5-.179 1-.25 2 1 3 .625.5 1 1.364 1 2.25C11 14 9.657 15 8 15"/>
                        </svg>
                    </a>
            </ul>

            <!-- Botón de búsqueda y carrito -->
            <div id="search-box" class="position-relative d-flex me-4 ms-0" style="width: 20rem;">
              <form id="search-form" class="d-flex" role="search" autocomplete="off">
                <input id="search-input" class="form-control me-2 ms-0 ps-1 pe-0" type="search" placeholder="¿Que deseas?" aria-label="Search">
                  <i id="search-icon" role="button" tabindex="0" aria-label="Buscar" class="bi bi-search-heart"></i><!--Icono de Lupita-->
              </form>
              <!-- Caja de sugerencias -->
              <div id="search-suggest">
              <!-- Aquí se inyectan resultados -->
              </div>

              <button class="btn ms-4 me-5 ms-0 p-0" type="button" id="btn-carrito">
                  <i class="bi bi-handbag"></i><!--Icono de carrito-->
                  <span id="carrito-cantidad" class="carrito-burbuja">0</span>
              </button>             
            </div>
        </div>
    </nav>
</header>
<!-- sección Hero -->
<section>
    <!-- Carousel -->
     <div class="container-fluid p-0 carrusel">
        <div class="swiper mySwiper" data-aos="zoom-out">
        <div class="swiper-wrapper">

            <!-- Slide 1 -->
            <div class="swiper-slide" data-aos="zoom-out">
            <img src="./fotos/post-3.webp" class="d-block w-100" alt="slide 1">
            <div class="carousel-caption d-none d-sm-block">
                <h5 data-aos="fade-up">First</h5>
                <p data-aos="fade-up" data-aos-delay="150">Some</p>
            </div>
            </div>

            <!-- Slide 2 -->
            <div class="swiper-slide" data-aos="zoom-out">
            <img src="./fotos/sld3.webp" class="d-block w-100" alt="slide 2">
            <div class="carousel-caption d-none d-sm-block">
                <h5 data-aos="fade-up">Second</h5>
                <p data-aos="fade-up" data-aos-delay="150">Some</p>
            </div>
            </div>

            <!-- Slide 3 -->
            <div class="swiper-slide" data-aos="zoom-out">
            <img src="./fotos/Post-2.png" class="d-block w-100" alt="slide 3">
            <div class="carousel-caption d-none d-sm-block">
                <h5 data-aos="fade-up">Third</h5>
                <p data-aos="fade-up" data-aos-delay="150">Some</p>
            </div>
            </div>

        </div>

        <!-- Botones de navegación -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

        <!-- Paginación -->
        <!-- <div class="swiper-pagination"></div> -->
        </div>
    </div>
</section>
<!-- Sección de productos -->
<div class="container text-center m-auto mt-3" data-aos="fade-up">
    <span class=" display-4 p-3 new">NEW IN</span>
</div> 
<div class="btn-group d-flex m-auto mt-3 new-section" role="group" aria-label="Basic example" id="comenzar" data-aos="fade-up">
    <button type="button" class="btn bg-none " id="btn-hombre">HOMBRE</button>
    <button type="button" class="btn bg-none " id="btn-mujer">MUJER</button>
    <button type="button" class="btn bg-none " id="btn-set">SETS</button>
    <div class="underline"></div>
</div>

<!-- La consulta sql para New In y sus categorías -->
<?php include './drivers/conexion.php';

// Traemos todos los productos new_in de los últimos 30 días
$sql = "SELECT * FROM productos
WHERE destacado_newin = 1
  AND fecha_ingreso >= DATE_SUB(NOW(), INTERVAL 30 DAY)
ORDER BY fecha_ingreso DESC";

$result = $conn->query($sql);
if (!$result) {
    die("Error en la consulta SQL: " . $conn->error);
}

// Preparamos el array por género
$new_in_data = ['hombre'=>[], 'mujer'=>[], 'unisex'=>[]];

// Recorremos resultados y los metemos en su categoría
while ($row = $result->fetch_assoc()) {
    $genero = strtolower(trim($row['genero']));
    if (!isset($new_in_data[$genero])) {
        $genero = 'unisex';
    }

    // Solo añadimos si aún no hay 3 productos en esa categoría
    if (count($new_in_data[$genero]) < 3) {
        $new_in_data[$genero][] = $row;
    }
}
$result->close();
$conn->close();
?>
<!-- Secciones de New IN -->
<section class="container mt-4 text-center contenedor-secciones"  data-aos="fade-up" data-aos-delay="200">

  <!-- Hombres -->
  <div class="container-fluid row justify-content-center sect activa" id="hombre">
    <?php if (empty($new_in_data['hombre'])) { ?>
      <p class="aviso">Pronto habrán más novedades</p>
    <?php } else { ?>
      <?php foreach ($new_in_data['hombre'] as $p) { ?> 
        <!-- Producto -->
        <div class=" d-flex m-0 justify-content-center sect2">
          <div class="border-none flip-card"
            data-producto_id="<?= htmlspecialchars($p['producto_id']); ?>">
            
            <img src="<?= htmlspecialchars($p['imagen']); ?>" class="img-fluid" alt="<?= htmlspecialchars($p['nombre']); ?>">
            
            <div class="card-body mt-1">
                <p class="card-title mt-1"><?= htmlspecialchars($p['nombre']); ?></p>
                <p class="card-text mt-1">$<?= htmlspecialchars($p['precio']); ?></p>
                <button class="ver">VER MÁS </button>
            </div>
          </div>
        </div>
      <?php } ?>
    <?php } ?>
  </div>

  <!-- Mujeres -->
   <div class="container-fluid row justify-content-center sect" id="mujer">
    <?php if (empty($new_in_data['mujer'])) { ?>
      <p class="aviso">Pronto habrán más novedades</p>
    <?php } else { ?>
      <?php foreach ($new_in_data['mujer'] as $p) { ?> 
        <?php
            //  Adaptamos tallas si tuviste la misma lógica del catálogo
            $data_tallas = !empty($p['tallas']) ? json_encode($p['tallas']) : '[]';
        ?>
        <div class="d-flex m-0 justify-content-center sect2"> <!-- DIV PADRE DE PRODUCTO -->
            <div class="border-none flip-card" 
                data-producto_id="<?= htmlspecialchars($p['producto_id']); ?>"
                data-nombre="<?= htmlspecialchars($p['nombre']); ?>" 
                data-color="<?= htmlspecialchars($p['color']); ?>" 
                data-tipo_producto="<?= htmlspecialchars($p['tipo_producto']); ?>" 
                data-precio="<?= htmlspecialchars($p['precio']); ?>" 
                data-tallas='<?= $data_tallas; ?>'
                data-imagen="<?= htmlspecialchars($p['imagen']); ?>"
                data-imagen_back="<?= htmlspecialchars($p['imagen_back']); ?>"
            > <!-- DIV HIJO -->
              
                <img src="<?= $p['imagen']; ?>" class="img-fluid" alt="<?= htmlspecialchars($p['nombre']); ?>">
                <div class="card-body mt-1">
                    <p class="card-title mt-1"><?= htmlspecialchars($p['nombre']); ?></p>
                    <p class="card-text mt-1">$<?= $p['precio']; ?></p>
                    <button class="ver m-auto">VER MÁS </button>
                </div>
            </div>
        </div>
      <?php } ?>
    <?php } ?>
  </div>   

  <!-- ahora sets -->
  <div class="container-fluid row justify-content-center sect" id="set">
    <?php if (empty($new_in_data['unisex'])) { ?>
      <p class="aviso">Pronto habrán más novedades</p>
    <?php } else { ?>
    <?php foreach ($new_in_data['unisex'] as $p) { ?> 
      <?php
        // Adaptamos tallas si tuviste la misma lógica del catálogo
        $data_tallas = '';
        if (!empty($p['tallas'])) {
            $data_tallas = htmlspecialchars(implode(',', $p['tallas']));
        }
    ?>
    <div class="d-flex m-0 justify-content-center sect2"> <!-- DIV PADRE DE PRODUCTO -->
        <div class="border-none flip-card" 
            data-producto_id="<?= htmlspecialchars($p['producto_id']); ?>"
            data-nombre="<?= htmlspecialchars($p['nombre']); ?>" 
            data-color="<?= htmlspecialchars($p['color']); ?>" 
            data-tipo_producto="<?= htmlspecialchars($p['tipo_producto']); ?>" 
            data-precio="<?= htmlspecialchars($p['precio']); ?>" 
            data-tallas="<?= $data_tallas; ?>"
            data-imagen="<?= htmlspecialchars($p['imagen']); ?>"
            data-imagen_back="<?= htmlspecialchars($p['imagen_back']); ?>"
        > <!-- DIV HIJO -->
          
            <img src="<?= $p['imagen']; ?>" class="img-fluid" alt="<?= htmlspecialchars($p['nombre']); ?>">
            <div class="card-body mt-1">
              <p class="card-title mt-1"><?= htmlspecialchars($p['nombre']); ?></p>
              <p class="card-text mt-1">$<?= $p['precio']; ?></p>
              <button class="ver m-auto">VER MÁS </button>
            </div>
          </div>
        </div>
      <?php } ?>
    <?php } ?>
  </div>
</section>
<main>
<!-- Título "compra por categoría" -->
<div class="container text-center m-auto mt-5" data-aos="fade-up" >
  <span class="display-10 p-3 mt-3 mb-3 by">COMPRA POR CATEGORÍA</span>
</div>

<!-- ahora las tarjetas de las categorías -->
<section class="container-fluid mt-5 categorias" data-aos="fade-up" data-aos-offset="120">
  <div class="column d-flex m-auto categoria">

    <div class="card text-bg-dark m-auto border-0 col-lg-3 col-md-3">
      <a href="./mujeres.php" class="stretched-link ">
        <img src="./fotos/cat-w.png" class="card-img" alt="categoría-de-mujer">
      </a>
      <div class="card-img-overlay d-flex align-items-center justify-content-center">
        <a href="./mujeres.php">
          <h5 class="card-title">MUJERES</h5>
        </a>
      </div>
    </div>

    <div class="card text-bg-dark m-auto border-0 col-lg-3 col-md-3">
      <a href="./hombres.php" class="stretched-link ">
        <img src="./fotos/cat-m.png" class="card-img" alt="categoría-de-hombre">
      </a>
      <div class="card-img-overlay d-flex align-items-center justify-content-center">
        <a href="">
          <h5 class="card-title">HOMBRES</h5>
        </a>
      </div>
    </div>

    <div class="card text-bg-dark m-auto border-0 col-lg-3 col-md-3 blazer">
      <a href="" class="stretched-link ">
        <img src="./fotos/cat-b.png" class="card-img" alt="categoría-de-blazers">
      </a>
      <div class="card-img-overlay d-flex align-items-center justify-content-center">
        <a href="">
          <h5 class="card-title">OTROS</h5>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- ahora un msj bonito para la labia -->
    <!-- <div class="container-fluid mt-4 m-0 p-0 labia">
        <img class="banner" src="./img/sin.png" alt="">
    </div>   -->
</main>
<!-- Pie de página -->
<footer class="footer1 mt-5" data-aos="fade-up" data-aos-once="true">
  <div class="footer">
    <div class="ubicacion">
      <p>VENUS STORE</p>
      <span>Venus, siempre tu mejor elección para lucir bien</span>
    </div>
    <div class="contacto">
      <p>CONTÁCTANOS:</p>
      <span>317 182 1403</span><br>
      <span>venuz.store.colombia@gmail.com</span>
    </div>
    <br>
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
<!-- ************* ================================  ================================ ***********-->
                                        <!-- Ahora los Modales -->

<!-- ================================ -->
<!-- modal para información del producto -->
<!-- ================================ -->
 <?php include './admin/front/modal-productos-front.php'; ?>

<!-- ================================ -->
<!-- Modal para el carrito  -->
<!-- ================================ -->
 <!-- Fondo atenuado -->
<div id="overlay" class="overlay"></div>

<!-- Carrito flotante -->
<div id="carrito-modal" class="carrito-modal">
  <div class="carrito-header">
    <button class="btn ms-4 p-0" type="shopping" id="btn-carrito-fake" style="pointer-events: none;">
        <i class="bi bi-handbag cart"></i>
    </button>
    <h5 class="mt-2">CARRITO</h5>
    <button class="cerrar-carrito">&times;</button>
  </div>
  <div class="carrito-contenido">
    <!-- Aquí se inyecta el contenido del carrito desde js carrito-final -->
  </div>
    <div id="mensaje-vacio" style="display: flex; text-align:center; margin-bottom: 20rem;">
      <p>🛒 Ups, no has añadido nada aún</p>
      <button id="volver-catalogo" class="btn-volver ms-4 mt-4" onclick="location.href='./catalogo.php'">CONTINUAR COMPRANDO</button>
    </div>
  <div class="carrito-footer">
    <p>Total: $<span id="carrito-total">0</span></p>
    <a href="./carrito.php">
        <button class="ms-4 checkout">
        <i class="fa-solid fa-lock candado" style="color: #ffffff;"></i>
        PROCEDER AL PAGO
        </button>
    </a>
  </div>
</div>
<!-- URL global -->
<script>
  window.BASE_URL = "<?php echo rtrim(dirname($_SERVER['SCRIPT_NAME']), '/'); ?>";
</script>
 <!-- Mi js -->
<script type="module" src="<?= BASE_URL ?>/java/main.js"></script>
<!-- Swiper -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</body>
</html>