<?php
date_default_timezone_set("America/Bogota");
session_start();
if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario']) || $_SESSION['rol'] != "administrador") {
  header("location:iniciar.php");
}
?>
<header>
  <?php include 'HeaderLogin.php'; ?>
</header>
<aside class="">
  <?php include 'BarraLateralAdministrador.php'; ?>
</aside>
<main id="main" class="main">


  <section class="section">


    <div class="card">
      <div class="card-body">
        <?php if (isset($_COOKIE['error'])) { ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            Datos incorrectos.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>

        <?php }  ?>

        <?php if (isset($_COOKIE['errorImagen'])) { ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            Imagen incorrecta. Intente con otra.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>

        <?php }  ?>

        <?php if (isset($_COOKIE['fecha'])) { ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            la fecha de inicio no puede ser mayor a la fecha de cierre.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>

        <?php }  ?>


        
        <h5 class="card-title">Crear convocatoria</h5>

        <!-- General Form Elements -->
        <form class="form_register" action="../controladores/router.php?con=ConvocatoriaControlador&fun=crearConvocatoria" method="post" enctype="multipart/form-data">
          <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Titulo</label>
            <div class="col-sm-10">
              <input required type="text" name="titulo" class="form-control">
            </div>
          </div>

          <div class="row mb-3">
            <label for="inputNumber" class="col-sm-2 col-form-label">Cargar imagen</label>
            <div class="col-sm-10">
              <input required accept="image/*" name="imagen" class="form-control" type="file" id="formFile">
            </div>
          </div>

          <div class="row mb-3">
            <label for="inputPassword" class="col-sm-2 col-form-label">Descripcion</label>
            <div class="col-sm-10">
              <textarea required class="form-control" name="descripcion" style="height: 100px"></textarea>
            </div>
          </div>

          <div class="row mb-3">
            <label for="inputDate" class="col-sm-2 col-form-label">Fecha inicio</label>
            <div class="col-sm-10">
              <input required name="fecha_inicio" min="<?php echo date('Y-m-d') ?>" type="date" class="form-control">
            </div>
          </div>

          <div class="row mb-3">
            <label for="inputDate" class="col-sm-2 col-form-label">Fecha fin</label>
            <div class="col-sm-10">
              <input name="fecha_fin" required min="<?php echo date('Y-m-d') ?>" type="date" class="form-control">
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">Crear</button>
            </div>
          </div>

        </form><!-- End General Form Elements -->

      </div>
    </div>
  </section>
</main>
<footer>
  <?php include 'footer.php' ?>
</footer>
</body>

</html>