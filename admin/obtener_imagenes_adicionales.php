<?php
require __DIR__ . '/../drivers/conexion.php';

$producto_id=isset($_GET['producto_id']) ? intval($_GET['producto_id']) : 0;

$sql = "SELECT url_imagen FROM imagenes_adicionales WHERE producto_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $producto_id);
$stmt->execute();
$result = $stmt->get_result();

$imagenes = [];
    while ($row = $result->fetch_assoc()) {
        $imagenes[] = $row['url_imagen'];
    }
echo json_encode($imagenes);