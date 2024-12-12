<?php
$host = "localhost"; // Servidor de la base de datos
$usuario = "root"; // Usuario predeterminado de XAMPP
$password = ""; // Contraseña predeterminada (vacía en XAMPP)
$base_de_datos = "inventariodb"; 

// Crear conexión
$conn = new mysqli($host, $usuario, $password, $base_de_datos);



// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
// echo "Conexión exitosa"; // Descomenta para verificar
?>
