<?php
session_start();

// Verificar si el usuario está autenticado y tiene rol de administrador
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'administrador') {
    header("Location: index.php");
    exit;
}

include('conexion.php'); // Asegúrate de que este archivo contiene la conexión a la base de datos

// Consultar todos los productos para visualizarlos
$query = "SELECT * FROM producto";
$result = $conn->query($query);
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vogueish</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<header class="header">
    <nav class="navbar navbar-expand-lg bg-body-tertiary w-100">
        <div class="container-fluid">
            <a class="navbar-brand fs-3 logo" href="#">Vogueish</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 fs-5">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">CERRAR SESION</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<div class="container mt-5">
    <h1>Panel de Administración</h1>

    <!-- Formulario para agregar un producto -->
    <h2>Agregar Producto</h2>
    <form action="add_product.php" method="POST">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Producto</label>
            <input type="text" class="form-control" name="nombre" id="nombre" required>
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" step="0.01" class="form-control" name="precio" id="precio" required>
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control" name="stock" id="stock" required>
        </div>
        <div class="mb-3">
            <label for="tamano_id" class="form-label">Tamaño</label>
            <input type="number" class="form-control" name="tamano_id" id="tamano_id">
        </div>
        <div class="mb-3">
            <label for="categoria_id" class="form-label">Categoría</label>
            <input type="number" class="form-control" name="categoria_id" id="categoria_id">
        </div>
        <button type="submit" class="btn btn-primary">Agregar Producto</button>
    </form>

    <hr>

    <!-- Formulario para actualizar un producto -->
    <h2>Actualizar Producto</h2>
    <form action="update_product.php" method="POST">
        <div class="mb-3">
            <label for="producto_id" class="form-label">ID del Producto</label>
            <input type="number" class="form-control" name="producto_id" id="producto_id" required>
        </div>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nuevo Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre">
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Nuevo Precio</label>
            <input type="number" class="form-control" name="precio" id="precio">
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Nuevo Stock</label>
            <input type="number" class="form-control" name="stock" id="stock">
        </div>
        <div class="mb-3">
            <label for="tamano_id" class="form-label">Nuevo Tamaño</label>
            <input type="number" class="form-control" name="tamano_id" id="tamano_id">
        </div>
        <div class="mb-3">
            <label for="categoria_id" class="form-label">Nueva Categoría</label>
            <input type="number" class="form-control" name="categoria_id" id="categoria_id">
        </div>
        <button type="submit" class="btn btn-success">Actualizar Producto</button>
    </form>

    <hr>

    <!-- Formulario para eliminar un producto -->
    <h2>Eliminar Producto</h2>
    <form action="delete_product.php" method="POST">
        <div class="mb-3">
            <label for="producto_id" class="form-label">ID del Producto</label>
            <input type="number" class="form-control" name="producto_id" id="producto_id" required>
        </div>
        <button type="submit" class="btn btn-danger">Eliminar Producto</button>
    </form>

    <hr>

    <!-- Tabla de productos existentes -->
    <h2>Productos Existentes</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Tamaño</th>
                <th>Categoría</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($producto = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $producto['producto_id']; ?></td>
                    <td><?php echo $producto['nombre']; ?></td>
                    <td><?php echo $producto['precio']; ?></td>
                    <td><?php echo $producto['stock']; ?></td>
                    <td><?php echo $producto['tamano_id']; ?></td>
                    <td><?php echo $producto['categoria_id']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script src="script.js"></script>

<div class="container">
    <h2>Reportes del Administrador</h2>
    <div class="reportes">
        <br>
    <h2>Reportes de categorias</h2>
        <?php include 'reporte_categorias.php'; ?>
        <?php include 'reporte_categorias.php'; ?>
        <?php include 'reporte_categorias.php'; ?>
        <?php include 'reporte_categorias.php'; ?>
        <?php include 'reporte_categorias.php'; ?>
        <?php include 'reporte_categorias.php'; ?>
        <?php include 'reporte_categorias.php'; ?>
        <?php include 'reporte_categorias.php'; ?>
        <?php include 'reporte_categorias.php'; ?>
        <?php include 'reporte_categorias.php'; ?>
        
    </div>
</div>

</body>
</html>