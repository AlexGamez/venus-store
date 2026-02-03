<?php
require __DIR__ . '/../drivers/conexion.php';

// Validar ID
$venta_id = isset($_GET['venta_id']) ? intval($_GET['venta_id']) : 0;
if ($venta_id <= 0) {
    echo json_encode(["status" => "error", "message" => "ID de venta inválido"]);
    exit;
}

// =======================
// 1. Datos del pedido + cliente
// =======================
$sqlPedido = "
    SELECT 
        p.venta_id, p.fecha, p.total, p.estado, p.token,
        c.nombre, c.apellido, c.direccion, c.direccion_adicional, c.ciudad, c.telefono, c.correo
    FROM pedido p
    INNER JOIN cliente c ON p.cliente_id = c.cliente_id
    WHERE p.venta_id = ?
";

$stmt = $conn->prepare($sqlPedido);
$stmt->bind_param("i", $venta_id);
$stmt->execute();
$result = $stmt->get_result();
$pedido = $result->fetch_assoc();
$stmt->close();

if (!$pedido) {
    echo json_encode(["status" => "error", "message" => "Venta no encontrada"]);
    exit;
}

// =======================
// 2. Detalle de productos
// =======================
$sqlDetalle = "
    SELECT 
        d.producto_id, d.cantidad, d.precio_unitario,
        pr.nombre AS producto_nombre,
        pr.imagen
    FROM detalle_pedido d
    INNER JOIN productos pr ON d.producto_id = pr.producto_id
    WHERE d.venta_id = ?
";

$stmt = $conn->prepare($sqlDetalle);
$stmt->bind_param("i", $venta_id);
$stmt->execute();
$result = $stmt->get_result();

$detalles = [];
while ($row = $result->fetch_assoc()) {
    $row['subtotal'] = $row['cantidad'] * $row['precio_unitario']; // cálculo en PHP
    $detalles[] = $row;
}
$stmt->close();

// =======================
// 3. Respuesta JSON
// =======================
echo json_encode([
    "status"  => "success",
    "pedido"  => $pedido,
    "detalles" => $detalles
]);
?>
