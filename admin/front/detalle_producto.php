<?php
require __DIR__ . '/../../drivers/conexion.php';

header('Content-Type: application/json');

if (!isset($_GET['producto_id'])) {
    echo json_encode(['exito' => false, 'mensaje' => 'ID de producto no especificado']);
    exit;
}

$producto_id = intval($_GET['producto_id']);

// Consulta principal para el catálogo 
$sql = "SELECT producto_id, nombre, descripcion, precio, color, tipo_producto, imagen, imagen_back
        FROM productos
        WHERE producto_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $producto_id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $producto = $resultado->fetch_assoc();

    // Consulta secundaria para las imagenes adicionales
    $sqlImg = "SELECT url_imagen FROM imagenes_adicionales WHERE producto_id = ?";
    $stmtImg = $conn->prepare($sqlImg);
    $stmtImg->bind_param("i", $producto_id);
    $stmtImg->execute();
    $resultImg = $stmtImg->get_result();

    $imagenes_adicionales = [];
    while ($rowImg = $resultImg->fetch_assoc()) {
        $imagenes_adicionales[] = $rowImg['url_imagen'];
    }

    $producto['imagenes_adicionales'] = $imagenes_adicionales;

    echo json_encode(['exito' => true, 'producto' => $producto]);
} else {
    echo json_encode(['exito' => false, 'mensaje' => 'Producto no encontrado']);
}