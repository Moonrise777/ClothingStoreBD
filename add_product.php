<?php
include('conexion.php'); // Incluir la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $tamano_id = $_POST['tamano_id'];
    $categoria_id = $_POST['categoria_id'];

    // Preparar la consulta SQL para insertar el producto
    $query = "INSERT INTO producto (nombre, precio, stock, tamano_id, categoria_id) 
              VALUES ('$nombre', '$precio', '$stock', '$tamano_id', '$categoria_id')";

    // Ejecutar la consulta
    if ($conn->query($query) === TRUE) {
        echo "Producto agregado exitosamente.";
    } else {
        echo "Error: " . $query . "<br>" . $mysqli->error;
    }

    try {
        // Ejemplo de insertar un producto con un precio no válido (ej. precio <= 0)
        $sql = "INSERT INTO producto (nombre, precio, stock, tamano_id, categoria_id) 
                VALUES ('Producto de prueba', -10.0, 5, 1, 1)";
        
        // Intentar ejecutar la consulta
        if ($conn->query($sql) === TRUE) {
            echo "Producto insertado exitosamente";
        } else {
            // Si ocurre un error, capturamos el mensaje de error
            throw new Exception("Error al insertar el producto: " . $mysqli->error);
        }
    } catch (Exception $e) {
        // Mostrar el mensaje de error (que será el generado por el trigger)
        echo "Error: " . $e->getMessage();
    }
}
?>
