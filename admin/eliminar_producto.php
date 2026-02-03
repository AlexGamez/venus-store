<?php 
include __DIR__ . "/../drivers/conexion.php";

header("Content-Type: application/json");

// Validamos que se reciba el producto_id correcto desde el AJAX al "eliminar", y asegura la conexi贸n a la base de datos antes de continuar
$producto_id = isset($_GET['producto_id']) ? (int) $_GET['producto_id'] : null;

if (!$producto_id || $producto_id <= 0) {
    echo json_encode(["status" => "error", "message" => "ID no v谩lido"]);
    exit;
}

if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Error de conexi贸n: " . $conn->connect_error]);
    exit;
}

// Verificar si el producto existe antes de eliminarlo
$sql_check = "SELECT * FROM productos WHERE producto_id = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("i", $producto_id);
$stmt_check->execute();
$result = $stmt_check->get_result();

if ($result->num_rows === 0) {
    echo json_encode(["status" => "error", "message" => "El producto no existe"]);
    exit;
}

$stmt_check->close();

// Eliminar producto
$sql = "DELETE FROM productos WHERE producto_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $producto_id);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo json_encode(["status" => "success", "message" => "Producto eliminado correctamente"]);
    } else {
        echo json_encode(["status" => "error", "message" => "El producto no se pudo eliminar"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Error en la consulta SQL: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
