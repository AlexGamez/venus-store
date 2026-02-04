<?php
require __DIR__ . '/../drivers/conexion.php';

//  lógica necesaria para el dashboard
$pagina = $_GET['page'] ?? 'home';

$paginas_adicionales = [
    'home',
    'ventas',
    'inventario',
    'mas-opciones'
];
if (!in_array($pagina, $paginas_adicionales)) {
    $pagina = 'home';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM</title>
    <link rel="icon" type="image/x-icon" href="../img/icono.png">

    <!-- Bootstrap CSS -->
     <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>

    <!-- fuentes de google  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible+Next:wght@400;700&family=Bebas+Neue&family=DM+Serif+Text&family=Jost:wght@300;600&family=League+Spartan:wght@400;700&family=Libre+Franklin:wght@300;600&family=Merienda&family=Oswald:wght@400;700&family=Roboto:wght@400;700&family=Markazi+Text:wght@400..700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Zalando+Sans+Expanded:ital,wght@0,200..900;1,200..900&family=Zalando+Sans+SemiExpanded:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">


    <!-- Iconos de google -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=shelves" />

    <!-- mi css -->
    <link rel="stylesheet" href="./assets/css/dashboard.css">
    <link rel="stylesheet" href="./assets/css/ventas.css">
    <link rel="stylesheet" href="./assets/css/inventario.css">
    <link rel="stylesheet" href="./assets/css/home.css">
</head>
<body>
    <div id="page-transition-reverse"></div>
    <div class="fondos">
        <div class="fondo-1 fondo-img" style="background-image: url('../img/fondo-crm-1.jfif');"></div>
        <div class="fondo-2 fondo-img" style="background-image: url('../img/fondo-crm-2.jpg');"></div>
        <div class="fondo-3 fondo-img" style="background-image: url('../img/fondo-crm-3.jfif');"></div>
        <div class="fondo-4 fondo-img" style="background-image: url('../img/fondo-crm-4.jfif');"></div>
    </div>

<!-- ============================================================================== -->
<!-- **  Seción para mostras las opciones | Sidebar | Menú Lateral Izquierdo ** -->
<!-- ============================================================================== -->
 <main>    
    <section id="dashboard-ui">
        <div class="layout-dashboard">
            <?php include 'partials/sidebar.php'; ?>
<!-- ============================================================================== -->
<!-- **             Contenido del dashboard | Menú Derecho ** -->
<!-- ============================================================================== -->
            <div class="contenido-opciones" id="contenido">
                <!-- Contenido de cada opción -->
                <?php
                switch ($pagina) {
                    case 'home':
                        include 'pages/home.php';
                        break;
                    case 'ventas':
                        include 'pages/ventas.php';
                        break;
                    case 'inventario':
                        include 'pages/inventario.php';
                        break;
                    case 'mas-opciones':
                        include 'pages/mas-opciones.php';
                        break;
                    default:
                        include 'pages/home.php';
                        // include 'pages/inventario.php';
                        break;
                }
                ?>
            </div>
        </div>
    </section>

    
    


<!-- ============================================================================== -->
    <!-- Sección para los Modales -->
<!-- ============================================================================== -->

 <!-- ================================== --> 
<!-- Modal para agregar productos -->
 <!-- ================================= -->
    <section id="modalAgregar">
    <div id="formularioAgregar" style="display: none;" class="container mt-4 mb-4">
        <h3>Agregar Producto</h3>
        <form id="formAgregarProducto" enctype="multipart/form-data">
        <label>Nombre:</label>
        <input type="text" name="nombre" class="form-control" required>

        <label>Descripción:</label>
        <textarea name="descripcion" class="form-control" required></textarea>

        <label>Precio:</label>
        <input type="number" name="precio" step="0.01" class="form-control" required>

        <label>Imagen Frontal (opcional):</label>
        <input type="text" name="imagen" class="form-control" placeholder="URL del archivo en mi tienda" >

        <label>Imagen Trasera (opcional):</label>
        <input type="text" name="imagen_back" class="form-control" placeholder="URL del archivo en mi tienda" >

        <label>Género:</label>
        <select name="genero" class="form-control" required>
            <option value="hombre">Hombre</option>
            <option value="mujer">Mujer</option>
        </select>

        <label>Tipo:</label>
        <select name="tipo_producto" class="form-control" required>
            <option value="saco">Saco</option>
            <option value="otro">Otro</option>
        </select>

        <label>Color:</label>
        <input type="text" name="color" class="form-control" style="text-transform: lowercase;" required>

        <label>Talla y Stock</label>
        <div id="contenedor-tallas-stock">
            <div class="fila-talla-stock">
                <select name="talla[]" class="form-select talla-select" require>
                    <option value="">Elige una talla</option>
                    <option value="XS">XS</option>
                    <option value="S">S</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                    <option value="XXL">XXL</option>
                </select>
                <input type="number" name="stock[]" class="form-control stock-input" placeholder="Cantidad" min="0" required>
                <button type="button" class="btn btn-danger btn-sm eliminar-fila" style="display: none;">X</button>
            </div>
        </div>

        <button type="button" class="btn btn-secondary mt-2" id="agregar-talla">+Agregar otra Talla y Stock</button><br>
        
        <label>Imagenes Adicionales:</label>
        <input type="text" name="imagenes_adicionales[]" class="form-control" placeholder="URL del archivo en mi tienda" >
        <input type="text" name="imagenes_adicionales[]" class="form-control" placeholder="URL del archivo en mi tienda" >
        <input type="text" name="imagenes_adicionales[]" class="form-control" placeholder="URL del archivo en mi tienda" >
        
        <div class="mt-2 mb-2" style="border: 1px solid #65dee5ff; padding: 10px; border-radius: 5px; width: 30%;">
        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha_ingreso" id="fecha_ingreso"></label>
        

        <label for="new-in" class="ms-5">New IN</label>
        <input type="checkbox" name="destacado_newin" id="destacado_newin"></label>
        </div>

        <button type="submit" class="btn btn-success mt-2">Guardar Producto</button>
        <button type="button" class="btn btn-secondary mt-2" onclick="ocultarFormulario()">Cancelar</button>
    </form>
    </div>
    </section>
    <!-- ============================================================= -->
    <!-- Ahora el Modal Editar-->
    <!-- ============================================================= --> 
    <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarLabel">Editar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formEditarProducto" method="POST" action="procesar_edicion.php">

                        <input type="hidden" name="producto_id" id="editar_producto_id">

                        <label>Nombre:</label>
                        <input type="text" name="nombre" id="editar_nombre" class="form-control" required>

                        <label>Descripción:</label>
                        <textarea name="descripcion" id="editar_descripcion" class="form-control" required></textarea>

                        <label>Precio:</label>
                        <input type="number" name="precio" id="editar_precio" step="0.01" class="form-control" required>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label>Imagen frontal actual:</label>
                                <img id="editar_imagen_preview" class="img-thumbnail mb-2" style="max-height: 101px; width= 100px; height= 100px;">
                                <label>URL imagen frontal:</label>
                                <input type="text" name="imagen" id="editar_imagen" class="form-control" placeholder="https://drive.google.com/uc?id=...">
                            </div>

                            <div class="col-md-6">
                                <label>Imagen trasera actual:</label>
                                <img id="editar_imagen_back_preview" class="img-thumbnail mb-2" style="max-height: 100px; width= 100px; height= 100px;">
                                <label>URL imagen trasera:</label>
                                <input type="text" name="imagen_back" id="editar_imagen_back" class="form-control" placeholder="https://drive.google.com/uc?id=...">
                            </div>
                        </div>

                        <label>Género:</label>
                        <select name="genero" id="editar_genero" class="form-control" required>
                            <option value="hombre">Hombre</option>
                            <option value="mujer">Mujer</option>
                        </select>

                        <label>Tipo de prenda:</label>
                        <select name="tipo_producto" id="editar_tipo_producto" class="form-control">
                            <option value="saco">Saco</option>
                            <option value="otro">Otro</option>
                        </select>

                        <label>Color:</label>
                        <input type="text" name="color" id="editar_color" class="form-control" style="text-transform: lowercase;">
                        
                        <div class="mt-3 mb-1">
                        <label for="fecha">Fecha:</label>
                        <input type="date" name="fecha_ingreso" id="fecha-editar"></label>
                        
                        <label for="new-in">New IN</label>
                        <input type="checkbox" name="destacado_newin" id="new-in-editar"></label>
                        </div>
                        
                        <label>Imagenes Adicionales:</label>
                        <input type="text" name="imagenes_adicionales[]" id="editar_imagenes_adicionales_1" class="form-control" placeholder="URL del archivo en mi tienda 1" >
                        <input type="text" name="imagenes_adicionales[]" id="editar_imagenes_adicionales_2" class="form-control" placeholder="URL del archivo en mi tienda 2" >
                        <input type="text" name="imagenes_adicionales[]" id="editar_imagenes_adicionales_3" class="form-control" placeholder="URL del archivo en mi tienda 3" >

                        <div class="modal-footer mt-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Guardar Cambios</button>
                        </div>
                        
                        <label class="mt-0">Talla y Stock</label>
                        <div id="contenedor-tallas-edit" class="mt-0">
                            <div class="fila-talla-stock-edit">
                        </div>
                        <button type="button" class="btn btn-sm btn-primary mt-2" onclick = "agregarFilaTallaEdit()">+Agregar Talla</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

<?php $conn->close(); ?>
    </main>

<script>
  window.BASE_URL = "<?php echo rtrim(dirname($_SERVER['SCRIPT_NAME']), ); ?>";
</script>
<!-- Ahora los scripts -->

<!-- CDN para Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

 <!-- SweetAlert (si lo quieres usar para alertas rápidas) -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="./assets/js/inventario.js"></script>
<script src="./assets/js/ventas.js"></script>
<script src="./assets/js/dashboard.js"></script>
<script src="./assets/js/ajax-sidebard.js"></script>
<script src="./assets/js/chart.js"></script>
<script src="./assets/js/home.js"></script>
</body>
</html>