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
    <?php require_once 'Header.php'; ?>
  </header>

  <section>
     <div id="tamano-carrusel">
      <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div  class="carousel-item active" data-bs-interval="3000">
                <img src="vistas/imagenes/premio.jpeg" class="d-block w-100" alt="uno">
              </div>

      <?php
      $path = "vistas/imgConvocatorias";
      if (file_exists($path)) {
        $carpeta = opendir($path);
        while ($archivo = readdir($carpeta)) {
          if (!is_dir($archivo)) {
      ?>
            <div class="carousel-item" data-bs-interval="3000">
              <img id="img-carrusel" src="<?php echo $path . "/" . $archivo ?>" class="d-block w-100" alt="tres">
            </div>
           '<?php echo $path . "/" . $archivo ?>' </div>
<?php
          }
        }
      }

?>
</div>


 <div  class="carousel-item active" data-bs-interval="3000">
        <img src="vistas/img/bancos_de_imagenes_gratis.jpg" class="d-block w-100" alt="uno">
      </div>
      <div class="carousel-item" data-bs-interval="3000">
        <img  src="vistas/img/images.jfif" class="d-block w-100" alt="dos">
      </div>
      <div class="carousel-item" data-bs-interval="3000">
        <img  src="vistas/img/tipos-de-archivos-de-imagen.png" class="d-block w-100" alt="tres">
      </div>
 <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
  <span class="visually-hidden">Previous</span>
</button>
<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
  <span class="carousel-control-next-icon" aria-hidden="true"></span>
  <span class="visually-hidden">Next</span>
</button>
</div>
</div>
  </section>
</body>

</html>
<?php
      require_once '../controladores/ConvocatoriaControlador.php';
      $convocatoria = new ConvocatoriaControlador();
      $historial = $convocatoria->convocatoriaVigente();
      $count = count($historial);
      ?>
