<?php
include('conexion.php'); // Incluir la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener el ID del producto y los datos a actualizar
    $producto_id = $_POST['producto_id'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $tamano_id = $_POST['tamano_id'];
    $categoria_id = $_POST['categoria_id'];

    // Crear la consulta SQL para actualizar el producto
    $query = "UPDATE producto SET
              nombre = '$nombre',
              precio = '$precio',
              stock = '$stock',
              tamano_id = '$tamano_id',
              categoria_id = '$categoria_id'
              WHERE producto_id = '$producto_id'";

    // Ejecutar la consulta
    if ($conn->query($query) === TRUE) {
        echo "Producto actualizado exitosamente.";
    } else {
        // Capturar el mensaje de error generado por el trigger
        echo "Error al actualizar el producto: " . $stmt->error;
    }
}
?>
