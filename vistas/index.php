<?php
require_once '../controladores/ConvocatoriaControlador.php';
$convocatoria = new ConvocatoriaControlador();
$historial = $convocatoria->convocatoriaVigente();
$count = count($historial);
$path = "imgConvocatorias";
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Inicio</title>
  <link rel="stylesheet" href="vistas/css/carrusel.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>
  <header>
    <?php require_once '../vistas/Header.php'; ?>
  </header>

  <main class="main" id="main">
    <section class="section">
      <div class="row">
        <div class="col-lg-8">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Premio al merito</h5>

              <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="imagenes/premio.jpeg" class="d-block w-100" alt="uno">
                  </div>
                  <?php

                  if (file_exists($path)) {
                    $carpeta = opendir($path);
                    while ($archivo = readdir($carpeta)) {
                      if (!is_dir($archivo)) {
                  ?>
                        <div class="carousel-item">
                        <img id="img-carrusel" src="<?php echo $path . "/" . $archivo ?>" class="d-block w-100" alt="tres">
                        </div>
                  <?php
                      }
                    }
                  }

                  ?>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>

              </div>

            </div>
          </div>

        </div>
      </div>
    </section>
  </main>

  <footer>
    <?php require_once 'footer.php'; ?>;
  </footer>
</body>

</html>