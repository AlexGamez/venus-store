<?php
session_start();
require __DIR__ . '/../../drivers/conexion.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require __DIR__ . '/../../vendor/autoload.php';

// =============================
// 1. Recibir y validar el JSON del fetch
// =============================
$input = file_get_contents("php://input");
$data = json_decode($input, true);
if (!is_array($data)) {
    exit("Formato inválido de datos.");
}

if (!$data || !isset($data['carrito']) || empty($data['carrito'])) {
    exit("No hay productos en el carrito.");
}

$carrito = $data['carrito'];

// =============================
// 2. Datos del cliente
// =============================
$nombre     = trim($data['nombre'] ?? '');
$apellido   = trim($data['apellido'] ?? '');
$direccion  = trim($data['direccion'] ?? '');
$direccion2 = trim($data['direccion_adicional'] ?? null);
$ciudad     = trim($data['ciudad'] ?? '');
$telefono   = trim($data['telefono'] ?? '');
$correo     = trim($data['correo'] ?? '');

if (empty($nombre) || empty($apellido) || empty($direccion) || empty($ciudad) || empty($telefono) || empty($correo)) {
    exit("Datos de cliente incompletos.");
}

// =============================
// 3. Calcular total en servidor
// =============================
$total = 0;
foreach ($carrito as $item) {
    $total += $item['precio'] * $item['cantidad'];
}

try {
    $conn->begin_transaction();

    // 4. Insertar cliente
    $stmtCliente = $conn->prepare("
        INSERT INTO cliente (nombre, apellido, direccion, direccion_adicional, ciudad, telefono, correo) 
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");
    $stmtCliente->bind_param("sssssss", $nombre, $apellido, $direccion, $direccion2, $ciudad, $telefono, $correo);
    $stmtCliente->execute();
    $cliente_id = $conn->insert_id;
    $stmtCliente->close();

    // 5. Insertar pedido
    $estado = "pendiente";
    $stmtPedido = $conn->prepare("
        INSERT INTO pedido (cliente_id, fecha, total, estado) 
        VALUES (?, NOW(), ?, ?)
    ");
    $stmtPedido->bind_param("ids", $cliente_id, $total, $estado);
    $stmtPedido->execute();
    $venta_id = $conn->insert_id;
    $stmtPedido->close();

    // 6. Generar token
    $token = bin2hex(random_bytes(16)); // 32 caracteres hexadecimales
    $stmtToken = $conn->prepare("UPDATE pedido SET token = ? WHERE venta_id = ?");
    $stmtToken->bind_param("si", $token, $venta_id);
    $stmtToken->execute();
    $stmtToken->close();

    // 7. Insertar detalle + actualizar stock
    $stmtDetalle = $conn->prepare("
        INSERT INTO detalle_pedido (venta_id, producto_id, cantidad, precio_unitario) 
        VALUES (?, ?, ?, ?)
    ");

    $stmtStock = $conn->prepare("
        UPDATE tallas_productos 
        SET stock = stock - ? 
        WHERE producto_id = ? AND talla = ? AND stock >= ?
    ");

    foreach ($carrito as $item) {
        $producto_id = (int) $item['producto_id'];
        $cantidad    = (int) $item['cantidad'];
        $precio      = (float) $item['precio'];
        $talla       = strtoupper(trim($item['talla'] ?? ''));

        $stmtDetalle->bind_param("iiid", $venta_id, $producto_id, $cantidad, $precio);
        $stmtDetalle->execute();

        $stmtStock->bind_param("iisi", $cantidad, $producto_id, $talla, $cantidad);
        $stmtStock->execute();

        if ($stmtStock->affected_rows === 0) {
            throw new Exception("Stock insuficiente para producto ID $producto_id (talla $talla)");
        }
    }

    $stmtDetalle->close();
    $stmtStock->close();
    $conn->commit();

    //8. Se inserta el código que me notificará al correo cada que se haga una venta
    
    $mail = new PHPMailer(true);
    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host       = 'mail.venuzstore.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'notificaciones@venuzstore.com'; 
        $mail->Password   = 'Alex-Games30'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
        $mail->Port       = 587; // usualmente 587, si no funciona prueba 465 con ENCRYPTION_SMTPS

        // Remitente y destinatario
        $mail->setFrom('notificaciones@venuzstore.com', 'Venus Store');
        $mail->addAddress('venuz.store.colombia@gmail.com', 'Admin Venus Store');

        // Contenido
        $mail->isHTML(true);
        $mail->Subject = 'Nueva venta en tu tienda';
        $mail->Body    = "
            <h3>Se ha realizado una nueva venta en tu tienda online.</h3>
            <p><strong>Cliente:</strong> {$nombre} {$apellido}</p>
            <p><strong>Total:</strong> $" . number_format($total, 2) . "</p>
            <p>Revisa el panel de administración para más detalles:</p>
            <p><a href='http://venuzstore.com/admin/login.php'>Acceder al panel</a></p>
            ";
        $mail->AltBody = 'Se ha realizado una nueva venta en tu tienda online.';

        $mail->send();
    } catch (Exception $e) {
        error_log("Error al enviar el correo:". $mail->ErrorInfo);
    }
    echo "OK|" . $token;
    exit;

} catch (Exception $e) {
    $conn->rollback();
    echo "ERROR|" . $e->getMessage();
    exit;
}

// ********************************************* 
//  Este archivo simula la pasarela de pago, reemplazar más adelante o complementar 
//  ********************************************* 