<?php
// Conexión a la base de datos
$mysqli = new mysqli('localhost', 'root', '', 'inventariodb');

// Verifica la conexión
if ($mysqli->connect_error) {
    die('Error de conexión: ' . $mysqli->connect_error);
}

// Verificar si los datos están en $_POST
if (isset($_POST['nombre'], $_POST['correo'], $_POST['password'], $_POST['rol'])) {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $rol = $_POST['rol'];

    // Encriptar la contraseña
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Insertar el nuevo usuario en la tabla `usuarios`
    $query = "INSERT INTO usuarios (nombre, correo, password_hash, rol) 
              VALUES (?, ?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('ssss', $nombre, $correo, $password_hash, $rol);

    if ($stmt->execute()) {
        echo "Registro exitoso. Ahora puedes iniciar sesión.";
    } else {
        echo "Error al registrar: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Todos los campos son obligatorios.";
}

$mysqli->close();
?>


<!DOCTYPE html>
<html lang="es">
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
<body>


<section>
    
<form action="registro.php" method="POST">
    <h2>Registro de Usuario</h2>
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required>
    
    <label for="correo">correo:</label>
    <input type="email" id="correo" name="correo" required>
    
    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required>
    
    <label for="rol">Rol:</label>
    <select id="rol" name="rol" required>
        <option value="cliente">Cliente</option>
        <option value="administrador">Administrador</option>
    </select>
    
    <button type="submit">Registrarse</button>
</form>

</section>
<br><br><br><br><br><br>


<div class="container">
  <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top bg-dark">
    <div class="col-md-4 d-flex align-items-center">
      <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
        <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"/></svg>
      </a>
      <span class="mb-3 mb-md-0 text-body-secondary" >&copy; 2024 Company, Inc</span>
    </div>

    <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
      <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"/></svg></a></li>
      <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"/></svg></a></li>
      <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"/></svg></a></li>
    </ul>
  </footer>
</div>


    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>


</html>