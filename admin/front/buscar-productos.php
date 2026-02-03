<?php
require __DIR__ . '/../../drivers/conexion.php';

header('Content-Type: application/json; charset=utf-8');

$usePhp = true; 

$q = isset($_GET['q']) ? trim($_GET['q']) : '';

if ($q === ''){
    echo json_encode([]);
    exit;
}

$sql = "SELECT producto_id, nombre, precio, imagen, genero
        FROM productos
        WHERE nombre LIKE ?
        ORDER BY fecha_ingreso DESC
        LIMIT 5";

$stmt = $conn->prepare($sql);
$like = "%{$q}%";
$stmt->bind_param("s", $like);
$stmt->execute();
$res = $stmt->get_result();

$data = [];
while ($row = $res->fetch_assoc()) {
    // Mapeo opcional de género -> página
    $g = strtolower($row['genero'] ?? '');
    if ($g === 'hombre') $page = 'hombres';
    elseif ($g === 'mujer') $page = 'mujeres';
    else $page = 'catalogo'; // fallback, ajusta si quieres

     if ($usePhp) {
        $page .= '.php';
    }

    $data[] = [
        'producto_id' => (int)$row['producto_id'],
        'nombre'      => $row['nombre'],
        'precio'      => (float)$row['precio'],
        'imagen'      => $row['imagen'],
        'genero'      => $g,
        'page'        => $page
    ];
}
echo json_encode($data);
exit;