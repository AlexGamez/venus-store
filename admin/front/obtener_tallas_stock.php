<?php
require __DIR__ . '/../../drivers/conexion.php';

header('Content-Type: application/json');

if (!isset($_GET['producto_id'])) {
    echo json_encode(['error' => 'No se recibi贸 producto_id']);
    exit;
}

$producto_id = $_GET['producto_id'];

// Preparar y ejecutar la consulta
$sql = "SELECT talla, stock FROM tallas_productos WHERE producto_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $producto_id);
$stmt->execute();
$resultado = $stmt->get_result();

$tallas_stock = [];

while ($row = $resultado->fetch_assoc()) {
    $tallas_stock[] = [
        'talla' => $row['talla'],
        'stock' => $row['stock']
    ];
}

echo json_encode($tallas_stock);
