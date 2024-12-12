<?php
// Conectar a la base de datos
include("conexion.php");
session_start();

// Verificar si el usuario está logueado y tiene rol de cliente
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'cliente') {
    echo "Solo los clientes pueden agregar productos al carrito.";
    exit();
}

// Obtener los datos del formulario
$usuario_id = $_SESSION['usuario_id'];  // ID del usuario que está logueado
$producto_id = $_POST['producto_id'];
$cantidad = $_POST['cantidad'];

// Verificar si el producto ya está en el carrito del usuario
$query = "SELECT * FROM carrito WHERE usuario_id = ? AND producto_id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("ii", $usuario_id, $producto_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Si el producto ya está en el carrito, actualizar la cantidad
    $query_update = "UPDATE carrito SET cantidad = cantidad + ? WHERE usuario_id = ? AND producto_id = ?";
    $stmt_update = $mysqli->prepare($query_update);
    $stmt_update->bind_param("iii", $cantidad, $usuario_id, $producto_id);
    $stmt_update->execute();
} else {
    // Si el producto no está en el carrito, insertarlo
    $query_insert = "INSERT INTO carrito (usuario_id, producto_id, cantidad) VALUES (?, ?, ?)";
    $stmt_insert = $mysqli->prepare($query_insert);
    $stmt_insert->bind_param("iii", $usuario_id, $producto_id, $cantidad);
    $stmt_insert->execute();
}

echo "Producto agregado al carrito.";
?>
