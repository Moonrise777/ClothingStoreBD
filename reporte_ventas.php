<?php
include 'conexion.php'; // Incluir la conexión a la base de datos

// Reporte 1: Productos más vendidos
$sql1 = "SELECT producto_id, SUM(cantidad) AS total_vendido 
          FROM ventas 
          GROUP BY producto_id 
          ORDER BY total_vendido DESC 
          LIMIT 5";
$result1 = $conn->query($sql1);
$productos1 = [];
$ventas1 = [];
if ($result1 && $result1->num_rows > 0) {
    while ($row = $result1->fetch_assoc()) {
        $productos1[] = "Producto " . $row['producto_id'];
        $ventas1[] = $row['total_vendido'];
    }
} else {
    echo "No se encontraron datos en la consulta 1.";
    exit;
}

// Reporte 2: Ingresos totales por mes
$sql2 = "SELECT MONTH(fecha) AS mes, SUM(total) AS ingresos_totales 
          FROM ventas 
          GROUP BY mes 
          ORDER BY mes";
$result2 = $mysqli->query($sql2);
$meses2 = [];
$ingresos2 = [];
if ($result2 && $result2->num_rows > 0) {
    while ($row = $result2->fetch_assoc()) {
        $meses2[] = "Mes " . $row['mes'];
        $ingresos2[] = $row['ingresos_totales'];
    }
} else {
    echo "No se encontraron datos en la consulta 2.";
    exit;
}

// Reporte 3: Productos con mayor stock
$sql3 = "SELECT nombre, stock 
          FROM producto 
          ORDER BY stock DESC 
          LIMIT 5";
$result3 = $mysqli->query($sql3);
$nombres3 = [];
$stocks3 = [];
if ($result3 && $result3->num_rows > 0) {
    while ($row = $result3->fetch_assoc()) {
        $nombres3[] = $row['nombre'];
        $stocks3[] = $row['stock'];
    }
} else {
    echo "No se encontraron datos en la consulta 3.";
    exit;
}

// Reporte 4: Categorías con más productos
$sql4 = "SELECT categoria_id, COUNT(*) AS total_productos 
          FROM producto 
          GROUP BY categoria_id 
          ORDER BY total_productos DESC";
$result4 = $mysqli->query($sql4);
$categorias4 = [];
$totales4 = [];
if ($result4 && $result4->num_rows > 0) {
    while ($row = $result4->fetch_assoc()) {
        $categorias4[] = "Categoría " . $row['categoria_id'];
        $totales4[] = $row['total_productos'];
    }
} else {
    echo "No se encontraron datos en la consulta 4.";
    exit;
}

// Reporte 5: Ingreso promedio por venta
$sql5 = "SELECT AVG(total) AS ingreso_promedio 
          FROM ventas";
$result5 = $mysqli->query($sql5);
$ingreso_promedio5 = $result5->fetch_assoc()['ingreso_promedio'] ?? 0;

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reportes</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Reportes</h1>

    <!-- Reporte 1: Productos más vendidos -->
    <h2>Productos más vendidos</h2>
    <canvas id="graficoProductosVendidos"></canvas>

    <script>
        const ctx1 = document.getElementById('graficoProductosVendidos').getContext('2d');
        const productos1 = <?php echo json_encode($productos1); ?>;
        const ventas1 = <?php echo json_encode($ventas1); ?>;

        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: productos1,
                datasets: [{
                    label: 'Cantidad vendida',
                    data: ventas1,
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

    <!-- Reporte 2: Ingresos totales por mes -->
    <h2>Ingresos totales por mes</h2>
    <canvas id="graficoIngresosMes"></canvas>

    <script>
        const ctx2 = document.getElementById('graficoIngresosMes').getContext('2d');
        const meses2 = <?php echo json_encode($meses2); ?>;
        const ingresos2 = <?php echo json_encode($ingresos2); ?>;

        new Chart(ctx2, {
            type: 'line',
            data: {
                labels: meses2,
                datasets: [{
                    label: 'Ingresos totales',
                    data: ingresos2,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
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

    <!-- Agregar aquí código de gráficas para los demás reportes usando el patrón mostrado arriba -->

</body>
</html>
