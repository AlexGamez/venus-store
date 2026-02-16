<?php
session_start();
include './drivers/conexion.php';

//Verificar si hay pedido válido
// if (!isset($_GET['pedido_id'])) {
//     header("Location: index.php");
//     exit;
// }
// Temporal
$token = $_GET['token'] ?? null;
if (!$token) {
    header("Location: index.php");
    exit;
}

// Consultar datos del pedido
$sql = "SELECT p.venta_id, p.fecha, p.total, p.estado, p.token, 
               c.nombre, c.apellido, c.direccion, c.direccion_adicional, c.ciudad, c.telefono, c.correo
        FROM pedido p
        INNER JOIN cliente c ON p.cliente_id = c.cliente_id
        WHERE p.token = ?";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Error en prepare: " . $conn->error);
}
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();
// Guardamos los datos en un array asociativo
$pedido = $result->fetch_assoc();
if (!$pedido) {
    die("Pedido no encontrado.");
}

// Consultar productos del pedido
$sqlProd = "SELECT d.cantidad, d.precio_unitario, pr.nombre, pr.imagen
            FROM detalle_pedido d
            INNER JOIN productos pr ON d.producto_id = pr.producto_id
            WHERE d.venta_id = ?";
$stmtProd = $conn->prepare($sqlProd);
$stmtProd->bind_param("i", $pedido['venta_id']);
$stmtProd->execute();
$resultProd = $stmtProd->get_result();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venus Store / Confirmación</title>
    <!-- icono de la página -->
    <link rel="icon" type="image/x-icon" href="./img/icono.png">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Iconos / Fuentes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Serif+Text&family=League+Spartan:wght@400;700&family=Libre+Franklin:wght@300;600&family=Merienda&family=Oswald:wght@400;700&family=Roboto:wght@400;700&family=Bebas+Neue&family=Jost:wght@300;600&family=Atkinson+Hyperlegible+Next:wght@400;700&family=Open+Sans:wght@300;800&display=swap"
        rel="stylesheet">

    <!-- CSS propio -->
    <link rel="stylesheet" href="./css/gracias.css">
    <!-- <link rel="stylesheet" href="/css/gracias.css?v=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . '/css/gracias.css') ?>"> -->
</head>

<body>

    <!-- Header -->
    <div class="container-fluid bg-black carousel-container ">
        <div class="carousel-text " id="text-carousel">💖 Bienvenido a nuestra tienda 💖</div>
    </div>
    <header class="container-fluid custom-header">
        <nav class="navbar navbar-expand-md responsive">
            <div class="container responsive">
                <a class="navbar-brand" href="./index.php">
                    <span class="titulo ms-4">Venus Store</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse ms-0" id="navbarNav">
                    <ul class="navbar-nav flex-row ms-auto me-auto mb-2 mb-md-0">
                        <li class="nav-item p-2">
                            <a class="nav-link active" aria-current="page" href="./catalogo.php">TIENDA</a>
                        </li>
                        <li class="nav-item p-2">
                            <a class="nav-link active" href="./hombres.php">HOMBRES</a>
                        </li>
                        <li class="nav-item p-2">
                            <a class="nav-link active" href="./mujeres.php">MUJERES</a>
                        </li>
                        </li>
                        <li class="nav-item p-2">
                            <a class="nav-link active" href="./hot.php" aria-disabled="true">HOT
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red"
                                    class="bi bi-fire mb-1" viewBox="0 0 16 16">
                                    <path
                                        d="M8 16c3.314 0 6-2 6-5.5 0-1.5-.5-4-2.5-6 .25 1.5-1.25 2-1.25 2C11 4 9 .5 6 0c.357 2 .5 4-2 6-1.25 1-2 2.729-2 4.5C2 14 4.686 16 8 16m0-1c-1.657 0-3-1-3-2.75 0-.75.25-2 1.25-3C6.125 10 7 10.5 7 10.5c-.375-1.25.5-3.25 2-3.5-.179 1-.25 2 1 3 .625.5 1 1.364 1 2.25C11 14 9.657 15 8 15" />
                                </svg>
                            </a>
                    </ul>
                    <!-- Botón de búsqueda y carrito -->
                    <div id="search-box" class="position-relative d-flex me-4" style="width: 20rem;">
                        <form id="search-form" class="d-flex" role="search" autocomplete="off">
                            <input id="search-input" class="form-control me-2 ps-1 pe-0" type="search"
                                placeholder="¿Que deseas?" aria-label="Search">
                            <i id="search-icon" role="button" tabindex="0" aria-label="Buscar"
                                class="bi bi-search-heart"></i><!--Icono de Lupita-->
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

    <div class="gracias-container">
        <h3>¡Gracias por tu compra, <?php echo htmlspecialchars($pedido['nombre']); ?>!</h3>
        <p>Tu pedido se ha procesado correctamente.</p><br>
        <p>Número de pedido: <strong><?php echo strtoupper(substr($pedido['token'], 0, 8)); ?>...</strong></p>
        <p>Productos:
            <?php if ($resultProd->num_rows > 0): ?>
                <?php while ($producto = $resultProd->fetch_assoc()): ?>
                    <img class="producto" src="<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>">
                <?php endwhile; ?>
            <?php else: ?>
                <!-- Imagen de prueba -->
                <img class="producto" src="https://venuzstore.com/fotos/default.png" alt="Producto de prueba">
            <?php endif; ?>


        </p>
        <p>Estado:<strong><?php echo $pedido['estado']; ?></strong></p><br>
        <p>Total: $<?php echo number_format($pedido['total'], 2); ?> </p><br>
        <p>Fecha y hora de compra: <?php echo date("d/m/Y H:i", strtotime($pedido['fecha'])); ?></p>
        <div class="nota mt-3">
            <strong>Aviso</strong> <br>
            <p>En breve recibiras vía <strong>WhatsApp y Correo</strong> toda la información de tu pedido tal como guía
                de envío, # de pedido, etc...</p>
        </div>
        <div class="acciones">
            <a href="./catalogo.php" class="boton">Seguir comprando</a>
            <a href="https://wa.me/+573171821403?text=Hola%20acabo%20de%20realizar%20una%20compra%20y%20quiero%20confirmar%20mi%20pedido"
                target="_blank" class="boton">
                <i class="fab fa-whatsapp" style="font-size:20px; color:green;"></i>
                WhatsApp
            </a>
        </div>
    </div>

    <div class="corazon"></div>
    <div class="corazon"></div>
    <div class="corazon"></div>
    <div class="corazon"></div>
    <div class="corazon"></div>

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
                            <svg viewBox="0 0 448 512" height="1.7em" xmlns="http://www.w3.org/2000/svg"
                                class="svgIcontwit" fill="white">
                                <path fill="#ffffff"
                                    d="M448 209.9a210.1 210.1 0 0 1 -122.8-39.3V349.4A162.6 162.6 0 1 1 185 188.3V278.2a74.6 74.6 0 1 0 52.2 71.2V0l88 0a121.2 121.2 0 0 0 1.9 22.2h0A122.2 122.2 0 0 0 381 102.4a121.4 121.4 0 0 0 67 20.1z">
                                </path>
                            </svg>
                        </div>
                        <div class="social-icon-1">
                            <svg viewBox="0 0 512 512" height="1.7em" xmlns="http://www.w3.org/2000/svg"
                                class="svgIcontwit" fill="white">
                                <path
                                    d="M448 209.9a210.1 210.1 0 0 1 -122.8-39.3V349.4A162.6 162.6 0 1 1 185 188.3V278.2a74.6 74.6 0 1 0 52.2 71.2V0l88 0a121.2 121.2 0 0 0 1.9 22.2h0A122.2 122.2 0 0 0 381 102.4a121.4 121.4 0 0 0 67 20.1z">
                                </path>
                            </svg>
                        </div>

                    </div>
                    <div class="socialcontainer"> <!-- Instagram -->
                        <div class="icon social-icon-2-2">
                            <svg fill="white" class="svgIcon" viewBox="0 0 448 512" height="1.5em"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill="#ffffff"
                                    d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z">
                                </path>
                            </svg>
                        </div>
                        <div class="social-icon-2">
                            <svg fill="white" class="svgIcon" viewBox="0 0 448 512" height="1.5em"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <a href="https://www.facebook.com/profile.php?id=61566389901912" target="_blank">
                        <div class="socialcontainer"> <!-- facebook -->
                            <div class="icon social-icon-3-3">
                                <svg viewBox="0 0 384 512" fill="white" height="1.6em"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill="#ffffff"
                                        d="M80 299.3V512H196V299.3h86.5l18-97.8H196V166.9c0-51.7 20.3-71.5 72.7-71.5c16.3 0 29.4 .4 37 1.2V7.9C291.4 4 256.4 0 236.2 0C129.3 0 80 50.5 80 159.4v42.1H14v97.8H80z">
                                    </path>
                                </svg>
                            </div>
                            <div class="social-icon-3">
                                <svg viewBox="0 0 384 512" fill="white" height="1.6em"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M80 299.3V512H196V299.3h86.5l18-97.8H196V166.9c0-51.7 20.3-71.5 72.7-71.5c16.3 0 29.4 .4 37 1.2V7.9C291.4 4 256.4 0 236.2 0C129.3 0 80 50.5 80 159.4v42.1H14v97.8H80z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </a>
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