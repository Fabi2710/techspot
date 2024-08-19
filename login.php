<?php
// Datos de conexión
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TechSpot";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$email = $_POST['email'];
$password = $_POST['password'];

// Buscar el usuario en la base de datos
$sql = "SELECT id, nombre, password FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $nombre, $hashed_password);
    $stmt->fetch();
    
    // Verificar la contraseña
    if (password_verify($password, $hashed_password)) {
        echo "Inicio de sesión exitoso. Bienvenido, $nombre.";
        // Aquí puedes redirigir al usuario a otra página o iniciar sesión en la sesión PHP.
    } else {
        echo "Contraseña incorrecta.";
    }
} else {
    echo "No existe una cuenta con este correo electrónico.";
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
