<?php
session_start();
include('conexion.php'); // Asegúrate de que este archivo contiene la conexión a la base de datos

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario_id'])) {
    echo "Debes estar logueado para eliminar productos del carrito.";
    exit;
}

// Obtener el ID del carrito que se va a eliminar
$carrito_id = $_POST['carrito_id'];

// Verificar si el carrito pertenece al usuario logueado
$usuario_id = $_SESSION['usuario_id'];
$query = "SELECT * FROM carrito WHERE carrito_id = ? AND usuario_id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("ii", $carrito_id, $usuario_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Si el producto está en el carrito del usuario, eliminarlo
    $delete_query = "DELETE FROM carrito WHERE carrito_id = ?";
    $delete_stmt = $mysqli->prepare($delete_query);
    $delete_stmt->bind_param("i", $carrito_id);
    $delete_stmt->execute();
    
    header("Location: index.php"); // Redirigir a la página principal después de eliminar
    exit;
} else {
    echo "Este producto no está en tu carrito.";
    exit;
}
?>
