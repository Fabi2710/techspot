<?php
// Datos de conexión
$servername = "localhost";
$username = "root";
$password = ""; // Si tu MySQL tiene contraseña, colócala aquí
$dbname = "TechSpot"; // Nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm-password'];

// Verificar si las contraseñas coinciden
if ($password !== $confirm_password) {
    echo "Las contraseñas no coinciden.";
    exit();
}

// Encriptar la contraseña
$password_hash = password_hash($password, PASSWORD_BCRYPT);

// Preparar y ejecutar la consulta SQL para insertar el usuario
$sql = "INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nombre, $email, $password_hash);

if ($stmt->execute()) {
    echo "Registro exitoso. <a href='login.html'>Inicia sesión aquí</a>.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
