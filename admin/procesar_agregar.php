<?php
include __DIR__ . "/../drivers/conexion.php";

if (!$conn) {
    echo json_encode(["status" => "error", "message" => "Error de conexi贸n"]);
    exit;
}

// Recibir otros datos
$nombre         = $_POST['nombre'];
$descripcion    = $_POST['descripcion'];
$precio         = $_POST['precio'];
$genero         = $_POST['genero'];
$tipo_producto  = $_POST['tipo_producto'] ?? '';
$color          = $_POST['color'] ?? '';
$imagen         = (trim($_POST['imagen'] ?? ''));
$imagen_back    = (trim($_POST['imagen_back'] ?? ''));
$imagenes_adicionales = $_POST['imagenes_adicionales'] ?? [];
$fecha          = trim($_POST['fecha_ingreso']);
$new_in         = isset($_POST['destacado_newin']) ? 1 : 0;

// Insertar en la base de datos
$sql = "INSERT INTO productos (nombre, descripcion, precio, imagen, imagen_back, genero, tipo_producto, color, fecha_ingreso, destacado_newin) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo json_encode(["status" => "error", "message" => "Error en prepare: " . $conn->error]);
    exit;
}
$stmt->bind_param("ssdssssssi", 
    $nombre, 
    $descripcion, 
    $precio, 
    $imagen, 
    $imagen_back, 
    $genero, 
    $tipo_producto, 
    $color,
    $fecha,
    $new_in
);

if ($stmt->execute()) {
    $producto_id = $stmt->insert_id;

    // Insertar tallas y stocks
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
                $stmtTalla->close();
            }
        }
    }

    // Insertar im谩genes adicionales
    $sqlImg = "INSERT INTO imagenes_adicionales (producto_id, url_imagen) VALUES (?, ?)";
    $stmtImg = $conn->prepare($sqlImg);

    if ($stmtImg) {
        foreach ($imagenes_adicionales as $url) {
            $url = trim($url);
            if (!empty($url)) {
                $stmtImg->bind_param("is", $producto_id, $url);
                $stmtImg->execute();
            }
        }
    }

    echo json_encode(["status" => "success", "message" => "Producto agregado correctamente"]);
} else {
    echo json_encode(["status" => "error", "message" => "Error al agregar el producto: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>