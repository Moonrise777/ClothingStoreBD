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



<section class="login container mt-5">
    <h2>Iniciar Sesión</h2>
    <form action="login.php" method="POST" class="form-group">
        <div class="mb-3">
            <label for="correo" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="correo" name="correo" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-success">Iniciar Sesión</button>
    </form>
</section>
 <br><br><br><br>
 <?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventariodb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verifica si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $correo = isset($_POST['correo']) ? $_POST['correo'] : '';  // Asegúrate de que el nombre del campo coincida
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Consulta SQL para verificar si el correo existe
    $sql = "SELECT id, nombre, password_hash, rol FROM usuarios WHERE correo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontró el correo
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verificar la contraseña con password_verify
        if (password_verify($password, $row['password_hash'])) {
            // Autenticación exitosa
            session_start();
            $_SESSION['usuario_id'] = $row['cliente_id'];
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['rol'] = $row['rol'];  // Almacenamos el rol en la sesión

            // Redirigir según el rol
            if ($row['rol'] == 'administrador') {
                header("Location: admin.php");  // Redirige a la página del administrador
                exit; // Asegúrate de usar exit después de redirigir
            } else {
                header("Location: index.php");  // Redirige al índice para clientes
                exit; // Asegúrate de usar exit después de redirigir
            }
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "No se encontró un usuario con ese correo.";
    }

    $stmt->close();
}

$conn->close();
?>



<br><br><br><br>


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
