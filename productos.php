<?php
// Conectar a la base de datos
include("conexion.php");
session_start();

// Verificar si el usuario está logueado y tiene rol de cliente
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'cliente') {
    echo "Solo los clientes pueden acceder a esta página.";
    exit();
}

// Obtener los productos disponibles
$query = "SELECT * FROM producto";
$result = $mysqli->query($query);
?>

<h1>Productos Disponibles</h1>
<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Agregar al carrito</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($producto = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $producto['nombre']; ?></td>
                <td><?php echo $producto['precio']; ?></td>
                <td><?php echo $producto['stock']; ?></td>
                <td>
                    <form action="agregar_carrito.php" method="POST">
                        <input type="hidden" name="producto_id" value="<?php echo $producto['producto_id']; ?>">
                        <input type="number" name="cantidad" value="1" min="1" max="<?php echo $producto['stock']; ?>">
                        <button type="submit">Agregar al carrito</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
