<?php
require __DIR__ . '/../drivers/conexion.php';

$producto_id    = isset($_POST['producto_id']) ? intval($_POST['producto_id']) : 0;
$nombre         = trim($_POST['nombre']);
$descripcion    = trim($_POST['descripcion']);
$precio         = floatval($_POST['precio']);
$genero         = trim($_POST['genero']);
$tipo_producto  = trim($_POST['tipo_producto']);
$color          = trim($_POST['color']);
$fecha          = isset($_POST['fecha_ingreso']) ? trim($_POST['fecha_ingreso']) : null;
$new_in         = isset($_POST['destacado_newin']) ? 1 : 0;
$imagenes_adicionales = $_POST['imagenes_adicionales'] ?? [];

// Nuevas rutas de imágenes
$nueva_imagen      = isset($_POST['imagen']) ? trim($_POST['imagen']) : '';
$nueva_imagen_back = isset($_POST['imagen_back']) ? trim($_POST['imagen_back']) : '';

// Obtener rutas actuales si no llegaron nuevas
$query_actual = $conn->prepare("SELECT imagen, imagen_back FROM productos WHERE producto_id = ?");
$query_actual->bind_param("i", $producto_id);
$query_actual->execute();
$resultado = $query_actual->get_result();

if ($row = $resultado->fetch_assoc()) {
    if (empty($nueva_imagen)) {
        $nueva_imagen = $row['imagen'];
    }
    if (empty($nueva_imagen_back)) {
        $nueva_imagen_back = $row['imagen_back'];
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Producto no encontrado.']);
    exit;
}
$query_actual->close();

// Construir UPDATE dinámico
$campos = [];
$params = [];
$tipos  = "";

// Campos obligatorios
$campos[] = "nombre=?";
$params[] = $nombre;
$tipos   .= "s";

$campos[] = "descripcion=?";
$params[] = $descripcion;
$tipos   .= "s";

$campos[] = "precio=?";
$params[] = $precio;
$tipos   .= "d";

$campos[] = "imagen=?";
$params[] = $nueva_imagen;
$tipos   .= "s";

$campos[] = "imagen_back=?";
$params[] = $nueva_imagen_back;
$tipos   .= "s";

$campos[] = "genero=?";
$params[] = $genero;
$tipos   .= "s";

$campos[] = "tipo_producto=?";
$params[] = $tipo_producto;
$tipos   .= "s";

$campos[] = "color=?";
$params[] = $color;
$tipos   .= "s";

// Solo actualizar fecha si vino
if (!empty($fecha)) {
    $campos[] = "fecha_ingreso=?";
    $params[] = $fecha;
    $tipos   .= "s";
}

// Solo actualizar new_in si vino
if (isset($_POST['destacado_newin'])) {
    $campos[] = "destacado_newin=?";
    $params[] = $new_in;
    $tipos   .= "i";
}

// WHERE
$sql = "UPDATE productos SET " . implode(", ", $campos) . " WHERE producto_id=?";
$params[] = $producto_id;
$tipos   .= "i";

// Ejecutar UPDATE
$stmt = $conn->prepare($sql);
$stmt->bind_param($tipos, ...$params);

if (!$stmt->execute()) {
    echo json_encode(['status' => 'error', 'message' => 'Error al actualizar el producto: ' . $stmt->error]);
    exit;
}

// Actualizar tallas
$conn->query("DELETE FROM tallas_productos WHERE producto_id = $producto_id");

    // Insertar nuevas tallas
    if (isset($_POST['talla']) && is_array($_POST['talla']) && isset($_POST['stock']) && is_array($_POST['stock'])) {
        $tallas = $_POST['talla'];
        $stocks = $_POST['stock'];

        for ($i = 0; $i < count($tallas); $i++) {
            $talla = $conn->real_escape_string($tallas[$i]);
            $stock = (int)$stocks[$i];

            $sqlTalla = "INSERT INTO tallas_productos (producto_id, talla, stock) VALUES (?, ?, ?)";
            $stmtTalla = $conn->prepare($sqlTalla);
            if ($stmtTalla) {
                $stmtTalla->bind_param("isi", $producto_id, $talla, $stock);
                $stmtTalla->execute();
            }
        }
    }

// Actualizar imágenes adicionales
$conn->query("DELETE FROM imagenes_adicionales WHERE producto_id = $producto_id");

if (!empty($imagenes_adicionales)) {
    $sqlImg = "INSERT INTO imagenes_adicionales (producto_id, url_imagen) VALUES (?, ?)";
    $stmtImg = $conn->prepare($sqlImg);

    foreach ($imagenes_adicionales as $url) {
        $url = trim($url);
        if (!empty($url)) {
            $stmtImg->bind_param("is", $producto_id, $url);
            $stmtImg->execute();
        }
    }
    $stmtImg->close();
}

echo json_encode(['status' => 'success', 'message' => 'Producto actualizado correctamente.']);
$stmt->close();
$conn->close();
