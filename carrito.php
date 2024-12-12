<?php
// Conectar a la base de datos
include("conexion.php");
session_start();

// Verificar si el usuario está logueado y tiene rol de cliente
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'cliente') {
    echo "Solo los clientes pueden ver el carrito.";
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

// Obtener los productos en el carrito del usuario
$query = "SELECT p.nombre, c.cantidad, p.precio, (c.cantidad * p.precio) AS total
          FROM carrito c
          JOIN producto p ON c.producto_id = p.producto_id
          WHERE c.usuario_id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();

$total = 0;
?>

<h1>Mi Carrito</h1>
<table>
    <thead>
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['nombre']; ?></td>
                <td><?php echo $row['cantidad']; ?></td>
                <td><?php echo $row['precio']; ?></td>
                <td><?php echo $row['total']; ?></td>
            </tr>
            <?php $total += $row['total']; ?>
        <?php } ?>
    </tbody>
</table>

<h2>Total: <?php echo $total; ?></h2>

<!-- Formulario para realizar el pago -->
<form action="realizar_pago.php" method="POST">
    <button type="submit">Pagar</button>
</form>
