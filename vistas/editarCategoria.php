<?php
require_once '../controladores/CategoriaControlador.php';

session_start();

if (!isset($_SESSION['usuario'])||empty($_SESSION['usuario'])|| $_SESSION['rol']!="administrador") {
  header("location:iniciar.php");
}
$categoria=new CategoriaControlador();
$listar=$categoria->listar($_GET["id"]);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/editarCategoria.css">
    <link rel="stylesheet" href="css/main.css">
    <title>Editar categoria</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script src="../js/alertas.js"></script>
  </head>

  <body onload="mensaje('<?php echo  $_GET["msg"] ?>')">

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

        <form class="" action="../controladores/router.php?con=CategoriaControlador&fun=editar" method="post">
          <fieldset class="border p-2">
             <h5 class="card-title">Crear Categoria:</h5>
            <div class="row mb-3">
              <label for="inputText" class="col-sm-2 col-form-label">Nombre:</label>
              <div class="col-sm-10">
                <input  type="hidden" name="id" value="  <?php echo $listar[0]->id_categoria; ?> ">
               <input class="input-nombre" type="text" name="nombre" value=" <?php echo $listar[0]->nombre; ?> ">
              </div>
            </div>

            <div class="row mb-3">
              <label for="inputText" class="col-sm-2 col-form-label">descripcion:</label>
              <div class="col-sm-10">
          <textarea style="resize: none" name="descripcion" rows="8" cols="80"><?php echo $listar[0]->descripcion;?></textarea> <br>
            </div>
            </div>


        <div class="row mb-3">

        <div class="col-sm-10">
          <p id="button-categoria"><input type="submit" name="continuar" value="actualizar"></p>
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
