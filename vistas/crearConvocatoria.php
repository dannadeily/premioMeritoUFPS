<?php

session_start();
if (!isset($_SESSION['usuario'])||empty($_SESSION['usuario'])|| $_SESSION['rol']!="administrador") {
  header("location:iniciar.php");
}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/crearConvocatoria.css">
    <link rel="stylesheet" href="css/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script src="../js/alertas.js"></script>
    <title>Crear convocatoria</title>
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

      <form class="form_register" action="../../controladores/router.php?con=ConvocatoriaControlador&fun=crearConvocatoria"  method="post" enctype="multipart/form-data">
          <fieldset class="border p-2">
             <h5 class="card-title">Crear convocatoria</h5>
            <div class="row mb-3">
              <label for="inputText" class="col-sm-2 col-form-label">Titulo</label>
              <div class="col-sm-10">
                <input type="text" class="form-control">
              </div>
            </div>

            <div class="row mb-3">
              <label for="inputText" class="col-sm-2 col-form-label">Cargar imagen</label>
              <div class="col-sm-10">
            <input name="imagen" type="file" id="CargarImagen"  accept="image/*" required>
              </div>

              </div>

            <div class="row mb-3">
              <label for="inputText" class="col-sm-2 col-form-label">Descripcion</label>
              <div class="col-sm-10">
            <textarea style="resize: none" cols="50" width="auto" name="descripcion"  required id="form4Example3" rows="4"></textarea>
     </div>
   </div>

            <div class="row mb-3">
              <label for="inputText" class="col-sm-2 col-form-label">Fecha de inicio: </label>
              <div class="col-sm-10">
                <p id="input-fecha"><input type="date" id="FechaInicio" name="fecha_inicio" class="form-control"></p>
              </div>
            </div>
         </td>

          <td>
            <div class="row mb-3">
              <label for="inputText" class="col-sm-2 col-form-label">Fecha de cierre: </label>
              <div class="col-sm-10">
                <p id="input-fecha"><input type="date" id="FechaInicio" name="fecha_inicio" class="form-control"></p>
              </div>
            </div>

                  <br>
                  <div class="row mb-3">

                  <div class="col-sm-10">
                    <p id="button-convocatoria"> <input type="submit" value="Enviar" name="enviar"></p>
                  </div>
                </div>
           </form>

</div>
</div>
    </section>


    </main>
    <?php include 'footer.php' ?>

</body>
</html>
