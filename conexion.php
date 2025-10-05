<?php
$host = getenv('MYSQL_HOST') ?: 'db'; // Servidor de la base de datos
$user = getenv('MYSQL_USER') ?: 'root'; // Usuario predeterminado de XAMPP
$pass = getenv('MYSQL_PASSWORD') ?: 'root'; // Contraseña predeterminada (vacía en XAMPP)
$db   = getenv('MYSQL_DATABASE') ?: 'inventariodb';

// Crear conexión
$conn = new mysqli($host, $usuario, $password, $base_de_datos);



// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
 echo "Conexión exitosa"; // Descomenta para verificar
?>

