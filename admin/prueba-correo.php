<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; 

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
    $mail->Body    = '<h3>Se ha realizado una nueva venta en tu tienda online.</h3>
                      <p>Revisa el panel de administración para más detalles.</p>
                      <p>http://venuzstore.com/admin/login.php</p>';
    $mail->AltBody = 'Se ha realizado una nueva venta en tu tienda online.';

    $mail->send();
} catch (Exception $e) {
    error_log("Error al enviar el correo:". $mail->ErrorInfo);
}