<?php
include 'conexion.php'; // Incluir la conexión a la base de datos

$sql = "SELECT producto_id, nombre, precio, stock, tamano_id, categoria_id FROM producto";
$resultado = $conn->query($sql);


if ($resultado->num_rows > 0) {
    // Mostrar los productos
    while ($fila = $resultado->fetch_assoc()) {
        echo "<div>";
        echo "<h3>" . $fila['nombre'] . "</h3>";
        echo "<p>Precio: " . $fila['precio'] . "</p>";
        echo "<p>Stock: " . $fila['stock'] . "</p>";
        echo "<p>Tamano: " . $fila['tamano_id'] . "</p>";
        echo "<p>Categoria: " . $fila['categoria_id'] . "</p>";
        echo "</div>";
    }
} else {
    echo "No se encontraron productos.";
}


?>
