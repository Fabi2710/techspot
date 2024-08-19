<?php
// Incluir conexión a la base de datos
include 'conexion.php';

// Supongamos que ya tienes los datos del usuario y el total de la compra
$usuario_id = $_SESSION['user_id']; // El ID del usuario que realiza la compra
$total = 5000; // Total de la compra
$correo_usuario = $_POST['email']; // Correo del usuario que compra

// Insertar la transacción en la base de datos
$sql = "INSERT INTO transacciones (usuario_id, total) VALUES ('$usuario_id', '$total')";

if ($conn->query($sql) === TRUE) {
    // Si la inserción fue exitosa, envía el correo

    // Enviar correo al administrador
    $to_admin = "tu_correo@example.com";
    $subject_admin = "Nueva compra realizada en TechSpot";
    $message_admin = "
    <html>
    <head>
    <title>Nueva compra realizada</title>
    </head>
    <body>
    <p>Se ha realizado una nueva compra en TechSpot.</p>
    <table>
    <tr>
    <th>Usuario ID</th><th>Total de la compra</th>
    </tr>
    <tr>
    <td>$usuario_id</td><td>$total</td>
    </tr>
    </table>
    </body>
    </html>
    ";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: TechSpot <no-reply@techspot.com>' . "\r\n";
    mail($to_admin, $subject_admin, $message_admin, $headers);

    // Enviar correo al usuario
    $to_user = $correo_usuario;
    $subject_user = "Confirmación de tu compra en TechSpot";
    $message_user = "
    <html>
    <head>
    <title>Gracias por tu compra</title>
    </head>
    <body>
    <p>Gracias por comprar en TechSpot, $nombre.</p>
    <p>El total de tu compra es: $total</p>
    <p>Pronto recibirás más detalles sobre tu pedido.</p>
    </body>
    </html>
    ";
    mail($to_user, $subject_user, $message_user, $headers);

    // Redireccionar a la página de confirmación
    header("Location: confirmacion_compra.html");
} else {
    echo "Error al realizar la compra: " . $conn->error;
}

$conn->close();
?>
