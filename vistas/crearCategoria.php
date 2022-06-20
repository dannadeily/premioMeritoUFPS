<?php
session_start();
if (!isset($_SESSION['usuario'])||empty($_SESSION['usuario'])|| $_SESSION['rol']!="administrador") {
  header("location:iniciar.php");
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Crear categoria</title>
    <link rel="stylesheet" href="css/crearCategoria.css">
    <link rel="stylesheet" href="css/main.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script src="js/alertas.js"></script>
  </head>
  <body  onload="mensaje('<?php echo  $_GET["msg"] ?>')">
    <main id="main" class="main">
    <header>
      <?php include 'HeaderLogin.php'; ?>
    </header>
      <aside class="">
        <?php include 'BarraLateralAdministrador.php'; ?>
      </aside>

      <section class="section">
        <div class="row">
          <div class="col-lg-6">

    <form class="" action="../../controladores/router.php?con=CategoriaControlador&fun=crearCategoria" method="post">
        <fieldset class="border p-2">
           <h5 class="card-title">Crear Categoria:</h5>
          <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Nombre:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control">
            </div>
          </div>

          <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Tipo de usuario:</label>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example">

                      <option value="1">Estudiante</option>
                      <option value="2">Egresado</option>
                      </select>
                  </div>
                </div>

          <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Descripcion</label>
            <div class="col-sm-10">
          <textarea style="resize: none" cols="50" width="auto" name="descripcion"  required id="form4Example3" rows="4"></textarea>
          </div>
          </div>


                <br>
                <div class="row mb-3">

                <div class="col-sm-10">
                  <p id="button-convocatoria"> <input type="submit" value="Enviar" name="enviar"></p>
                </div>
              </div>
            </fieldset>
         </form>

    </div>
    </div>
    </section>

</main>
  <footer>
        <?php include 'footer.php'; ?>
      </footer>
  </body>
</html>
