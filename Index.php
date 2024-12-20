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
                    <a class="nav-link" href="#">Mujeres</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Hombres</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Kids</a>
                  </li>
                  <li class="nav-item">
  <a class="nav-link" href="registro.php">REGÍSTRATE AQUÍ</a>
</li>
<li class="nav-item">
  <a class="nav-link" href="login.php">INICIA SESION AQUÍ</a>
</li>

                </ul>
                <span class="navbar-text">
                    <i class="bi bi-bag-heart" style="font-size: 25px;"></i>
                </span>
              </div>
            </div>
          </nav>






        


        <div class="header-content container">
            <div class="header-img">
                <img src="Img/right.png" alt="">
            </div>
            <div class="header-txt">
                <h1>Ofertas especiales</h1>
                <p>Estrena las mejores prendas</p>
                <a href="#" class="btn-1">Más información</a>
            </div>
        </div>


    </header>


    <section class="sale container">
        <div class="sale-1">
            <div class="sale-img">
                <img src="Img/f1.png" alt="">
            </div>
            <div class="sale-txt">
                <h3>Deportiva</h3>
                <a href="#" class="btn-2">Más información</a>
            </div>
        </div>

        <div class="sale-1">
            <div class="sale-img">
                <img src="Img/f2.png" alt="">
            </div>
            <div class="sale-txt">
                <h3>Calzado</h3>
                <a href="#" class="btn-2">Más información</a>
            </div>
        </div>
        <div class="sale-1">
            <div class="sale-img">
                <img src="Img/f3.png" alt="">
            </div>
            <div class="sale-txt">
                <h3>Accesorios</h3>
                <a href="#" class="btn-2">Más información</a>
            </div>
        </div>

    </section>

<!-- Aqui agregar lo de la base de datos -->
    <main class="products container" id="list-1">
        <h2>Productos</h2>

        <div class="product-content">
        <?php include 'producto.php'; ?>
        </div>

    </main>




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