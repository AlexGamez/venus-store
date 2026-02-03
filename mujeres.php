<?php include './drivers/conexion.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venus Store/Hombres</title>
    <link rel="icon" type="image/x-icon" href="/img/icono.png">
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
    <link rel="stylesheet" href="/css/productos.css?v=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . '/css/productos.css') ?>">
    <link rel="stylesheet" href="/css/popup.css?v=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . '/css/popup.css') ?>">
    
    <!-- sweet alerts -->
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
</head>
<body>
<!--Botoncito de Whtsp -->
<a href="https://wa.me/1234567890" class="whatsapp_float" target="_blank">
<img src="/img/whatsapp.png" alt="WhatsApp" />
</a>
<!-- Header -->
<div class="container-fluid bg-black carousel-container ">
    <div class="carousel-text " id="text-carousel">💖  Bienvenido a nuestra tienda  💖</div>
</div>
<header class="container-fluid custom-header">
    <nav class="navbar navbar-expand-md responsive">
        <div class="container responsive">
            <a class="navbar-brand" href="/index.php">
                <span class="titulo ms-4">Venus Store</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse ms-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto me-auto mb-2 mb-md-0">
                <li class="nav-item p-2">
                <a class="nav-link active" aria-current="page" href="/catalogo.php">TIENDA</a>
                </li>
                <li class="nav-item p-2">
                <a class="nav-link active" href="/hombres.php">HOMBRES</a>
                </li>
                <li class="nav-item p-2">
                    <a class="nav-link active" href="/mujeres.php">MUJERES</a>
                </li>
                </li>
                <li class="nav-item p-2">
                    <a class="nav-link active" href="/hot.php" aria-disabled="true">HOT
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
            
            <button class="btn ms-4 p-0" type="button" id="btn-carrito">
                <i class="bi bi-handbag"></i><!--Icono de carrito-->
                <span id="carrito-cantidad" class="carrito-burbuja">0</span>
            </button>
            </form>
            </div>
        </div>
    </nav>
</header>
<!-- sección Hero -->
<div class="container text-center hero">
    <span class="msj-seccion">Sección Femenina</span>
</div> 

<!-- Sección de filtros -->
<div class="container filter-container mt-2">
    <div class="filter-dropdown">
        <button class="filtrar" id="btn">
            <div class="icono">
                <span class="material-symbols-outlined">tune</span>
            </div>
            <div class="text-filtrar">
                <span>Filtros</span>
            </div>
        </button>       
        <div class="filter-dropdown-menu">
            <!-- Tipo de producto -->
            <div class="filter-options">
                <button class="filter-header">Tipo de producto<span class="arrow"></span></button>
                <ul class="opciones" id="filtro-tipo">
                    <li><input type="checkbox" id="saco"> <label for="sacos">Sacos</label></li>
                    <li><input type="checkbox" id="blazer"> <label for="blazer">Otros</label></li>
                </ul>
            </div>
            <!-- Talla -->
            <div class="filter-options">
                <button class="filter-header">Talla<span class="arrow"></span></button>
                <ul class="opciones" id="filtro-tallas">
                    <div class="tallas-container">
                        <li><input type="checkbox" id="s"> <label for="s">S</label></li>
                        <li><input type="checkbox" id="m"> <label for="m">M</label></li>
                        <li><input type="checkbox" id="l"> <label for="l">L</label></li>
                        <li><input type="checkbox" id="xl"> <label for="xl">XL</label></li>
                    </div>
                </ul>
            </div>
            <!-- Colores -->
            <div class="filter-options">
                <button class="filter-header">Color<span class="arrow"></span></button>
                <ul class="opciones d-flex flex-wrap" id="filtro-color">
                    <li><button class="color-btn" id="azul" style="background-color: blue;"></button></li>
                    <li><button class="color-btn" id="negro" style="background-color: black;"></button></li>
                    <li><button class="color-btn" id="blanco" style="background-color: white;"></button></li>
                    <li><button class="color-btn" id="rojo" style="background-color: red;"></button></li>
                    <li><button class="color-btn" id="marron" style="background-color: brown;"></button></li>
                    <li><button class="color-btn" id="gris" style="background-color: gray;"></button></li>
                </ul>
            </div>
            <button id="aplicarFiltros" class="btn mt-4 aplicar">Aplicar</button><!-- Botón Aplicar Filtros-->
        </div>
    </div>
    <div class="borrar-filtros">
        <button id="borrarFiltros" class="ms-2 d-flex borrarFiltros"><!-- Botón Borrar Filtros-->
            <img src="img/remove-icon.svg" alt="remover-filtro">
            <div class="text-filtrar">
                <span>Borrar Filtros</span>
            </div>
        </button>
    </div>

<!-- Sección de Ordenar Por   -->
    <div class="sort-by">
        <button class="select-btn"> 
            <span class="label">Ordenar por:</span>
            <span id="opcionSeleccionada">Por defecto</span>
        </button>
        <ul class="select-options" id="ordenarPor">
        <li value="defecto" class="selected">Por defecto</li>
        <li value="masVendidos">Más vendidos</li>
        <li value="precioDesc">Precio menor a mayor</li>
        <li value="precioAsc">Precio mayor a menor</li>
        <li value="alfabetico">Alfabéticamente</li>
        </ul>
    </div>
</div>
<!-- ******************************************************************** -->
<!--SECCIÓN DE PRODUCTOS - CATÁLOGO -->
<!-- ******************************************************************** -->

<!-- Primero un div para cuando no hallan productos en los filtros -->
<div class="container" id="mensaje-sin-resultados">
    <div id="sin-productos">
        <p>Lo sentimos, no se encontraron resultados para los filtros seleccionados</p>
    </div>
</div>

<!-- Aquí iniciamos con la consulta a la base para añadir los productos -->
<?php
include './drivers/conexion.php';

$sql = "SELECT p.producto_id, p.nombre, p.descripcion, p.precio, 
           p.imagen, p.imagen_back, p.genero, p.tipo_producto, p.color,
           SUM(t.stock) AS stock_total
    FROM productos p
    INNER JOIN tallas_productos t ON p.producto_id = t.producto_id
    WHERE p.genero = 'mujer'
    GROUP BY p.producto_id
    HAVING stock_total > 0
";

$result = $conn->query($sql);
if (!$result) {
    die("Error en la consulta SQL: " . $conn->error);
}
?>

<section class="container-fluid d-flex justify-content-center mt-1">
    <div class="contenedor-productos d-flex flex-wrap justify-content-center">
    
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // segunda consulta para talla y stock
            $producto_id = (int) $row['producto_id'];
            $sql_tallas = "SELECT talla, stock FROM tallas_productos WHERE producto_id = $producto_id";
            $result_tallas = $conn->query($sql_tallas);

            $tallas = [];
            if ($result_tallas && $result_tallas->num_rows > 0) {
                while ($fila_talla = $result_tallas->fetch_assoc()) {
                    $tallas[] = $fila_talla;
                }
            }
            $data_tallas = htmlspecialchars(json_encode($tallas), ENT_QUOTES, 'UTF-8');
            $agotado = ($row['stock_total'] <= 0);
            // <!-- Producto generado dinamicamente -->
            ?>

            <div class="flip-card mb-4 <?= $agotado ? 'agotado' : '' ?>" 
                data-producto_id="<?= htmlspecialchars($row['producto_id']); ?>">

                <div class="flip-card-inner">
                    <div class="flip-card-front"
                        data-producto_id="<?= htmlspecialchars($row['producto_id']); ?>" 
                        data-nombre="<?= htmlspecialchars($row['nombre']); ?>" 
                        data-color="<?= htmlspecialchars($row['color']); ?>" 
                        data-tipo_producto="<?= htmlspecialchars($row['tipo_producto']); ?>" 
                        data-precio="<?= htmlspecialchars($row['precio']); ?>"
                        data-tallas="<?=$data_tallas; ?>">

                        <img class="foto" src="<?= htmlspecialchars($row['imagen']); ?>" alt="<?= htmlspecialchars($row['nombre']); ?>">

                        <?php if ($agotado): ?>
                            <span class="badge-agotado">Agotado</span>
                        <?php endif; ?>

                        <div class="info-produc"></div>
                        <div>
                            <button class="agregar mb-2" id="verMas" <?= $agotado ? 'disabled' : '' ?>>
                                <?= $agotado ? 'No disponible' : 'Ver más' ?>
                            </button>
                        </div>
                    </div>
                    <div class="flip-card-back">
                        <img class="foto" src="<?= htmlspecialchars($row['imagen_back'])?>" alt="<?= $row['nombre']; ?>">
                    </div>
                </div>

                <div class="info-produc">
                    <h5 class="title mt-2"><?= $row['nombre']; ?></h5>
                    <p class="valor mt-1">$<?= number_format($row['precio'], 0, ',', '.'); ?></p>   
                </div>
            </div>
            <?php
        }
    } else {
        echo "<p>No hay productos disponibles.</p>";
    }
    $conn->close();
    ?>
    
    </div>
</section>

<!-- Pie de página -->
<footer class="footer1 mt-5">
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
<span><a href="/cumplimiento.html">Aviso de Cumplimiento</a></span>
<span><a href="/terminos.html">Términos y Condiciones</a></span>
</div>
</footer>
<!-- ************* ================================  ================================ ***********-->
                                        <!-- Ahora los Modales -->

<!-- ================================ -->
<!-- modal para información del producto -->
<!-- ================================ -->
<?php include 'admin/front/modal-productos-front.php'; ?>

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
      <button id="volver-catalogo" class="btn-volver ms-4 mt-4" onclick="location.href='/catalogo.php'">CONTINUAR COMPRANDO</button>
    </div>
  <div class="carrito-footer">
    <p>Total: $<span id="carrito-total">0</span></p>
    <a href="/carrito.php" class="ms-4 checkout">
        <i class="fa-solid fa-lock candado" style="color: #ffffff;"></i>
        <span>PROCEDER AL PAGO</span>
    </a>
  </div>
</div>


<!-- Aquí los scripts de Java -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="/java/text-moving.js"></script>
<script src="/java/busqueda.js"></script>
<script src="/java/filtros.js"></script>
<script src="/java/mostrarDetalleProducto.js"></script>
 <script src="/java/carrito-final.js"></script>
<script src="/java/carrito-burbuja.js"></script>
</body>
</html>