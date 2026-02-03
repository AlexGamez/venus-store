<?php
require __DIR__ . '/../drivers/conexion.php';

$conn->query("SET lc_time_names = 'es_ES'");

// =========================================
// 1. VENTAS POR MES (ÚLTIMOS 12)
// =========================================
$sql = "
    SELECT 
        YEAR(fecha) AS anio,
        MONTH(fecha) AS mes_num,
        DATE_FORMAT(fecha, '%b') AS mes,
        SUM(total) AS total
    FROM pedido
    GROUP BY anio, mes_num
    ORDER BY anio DESC, mes_num DESC
    LIMIT 12
";

$res = $conn->query($sql);

$meses = [];
$totales = [];

while ($row = $res->fetch_assoc()) {
    // Capitalizamos bien el mes (Ej: ene, feb, mar)
    $meses[] = ucfirst(mb_strtolower($row['mes'], 'UTF-8'));
    $totales[] = (float)$row['total'];
}

// =========================================
// 2. TOTAL HISTÓRICO
// =========================================
$sql = "SELECT SUM(total) AS total_historico FROM pedido";
$res = $conn->query($sql);
$totalHistorico = (float)$res->fetch_assoc()['total_historico'];

// =========================================
// 3. TOTAL MES ACTUAL
// =========================================
$sql = "
    SELECT SUM(total) AS total_actual
    FROM pedido
    WHERE YEAR(fecha) = YEAR(CURDATE())
      AND MONTH(fecha) = MONTH(CURDATE())
";
$res = $conn->query($sql);
$totalActual = (float)$res->fetch_assoc()['total_actual'];

// =========================================
// 4. TOTAL MISMO MES AÑO PASADO
// =========================================
$sql = "
    SELECT SUM(total) AS total_anterior
    FROM pedido
    WHERE YEAR(fecha) = YEAR(CURDATE()) - 1
      AND MONTH(fecha) = MONTH(CURDATE())
";
$res = $conn->query($sql);
$totalAnterior = (float)$res->fetch_assoc()['total_anterior'];

// =========================================
// RESPUESTA FINAL
// =========================================
echo json_encode([
    "meses" => array_reverse($meses),     // para que quede cronológico
    "totales" => array_reverse($totales),
    "ventas_totales" => $totalHistorico,
    "total_mes_actual" => $totalActual,
    "total_mes_anterior" => $totalAnterior
]);

$conn->close();