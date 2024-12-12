<?php
include 'conexion.php'; // Incluir la conexión a la base de datos

// Consulta SQL
$sql = "SELECT categoria_id, COUNT(*) AS total_productos 
        FROM producto 
        GROUP BY categoria_id";

$result = $conn->query($sql);

// Inicializar arrays para datos
$categorias = [];
$totales = [];

// Procesar resultados
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categorias[] = "Categoría " . $row['categoria_id'];
        $totales[] = $row['total_productos'];
    }
} else {
    echo "No se encontraron datos en la consulta.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Categorías</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="graficoCategorias"></canvas>
    <script>
        const ctx = document.getElementById('graficoCategorias').getContext('2d');
        const categorias = <?php echo json_encode($categorias); ?>;
        const totales = <?php echo json_encode($totales); ?>;

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: categorias,
                datasets: [{
                    label: 'Total de productos',
                    data: totales,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
