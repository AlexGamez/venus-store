<?php
header('Content-Type: application/json; charset=utf-8');
require __DIR__ . '/../drivers/conexion.php';

$tipo = $_GET['tipo'] ?? 'generales'; // por defecto trae todas

try {
    if ($tipo === 'recientes') {
        $sql = "SELECT
                    p.venta_id,
                    p.total,
                    p.fecha,
                    p.estado,
                    CONCAT_WS(' ', c.nombre, c.apellido) AS nombre
                FROM pedido p
                JOIN cliente c ON p.cliente_id = c.cliente_id
                -- WHERE p.estado = 'ok'
                ORDER BY p.fecha DESC
                LIMIT 5";
    } else {
        $sql = "SELECT
                    p.venta_id,
                    p.total,
                    p.fecha,
                    p.estado,
                    CONCAT_WS(' ', c.nombre, c.apellido) AS nombre
                FROM pedido p
                JOIN cliente c ON p.cliente_id = c.cliente_id
                ORDER BY p.fecha DESC";
    }

    $result = $conn->query($sql);

    $ventas = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $ventas[] = [
                "id"     => $row['venta_id'],
                "monto"  => $row['total'],
                "fecha"  => $row['fecha'],
                "estado" => $row['estado'],
                "nombre" => $row['nombre']
            ];
        }
    }

    echo json_encode([
        "status" => "success",
        "data"   => $ventas
    ]);

} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}

$conn->close();