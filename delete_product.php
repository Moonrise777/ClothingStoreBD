<?php
include('conexion.php'); // Incluir la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener el ID del producto a eliminar
    $producto_id = $_POST['producto_id'];

    // Crear la consulta SQL para eliminar el producto
    $query = "DELETE FROM producto WHERE producto_id = '$producto_id'";

    // Ejecutar la consulta
    if ($conn->query($query) === TRUE) {
        echo "Producto eliminado exitosamente.";
    } else {
        echo "Error: " . $query . "<br>" . $mysqli->error;
    }
}
?>
