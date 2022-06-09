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
    <link rel="stylesheet" href="../css/crearConvocatoria.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script src="../js/alertas.js"></script>
    <title>Crear convocatoria</title>
</head>
<body onload="mensaje('<?php echo  $_GET["msg"] ?>')">

  <header>
    <?php include '../HeaderLogin.php'; ?>
  </header>
    <aside class="">
      <?php include 'BarraLateralAdministrador.php'; ?>
    </aside>

    <section class="container">


      <form class="form_register" action="../../controladores/router.php?con=ConvocatoriaControlador&fun=crearConvocatoria"  method="post" enctype="multipart/form-data">
          <fieldset class="border p-2">
           <legend>Crear Convocatoria:</legend>
      <table id="tabla-convocatoria">
        <tr>
          <td>
            <label class="form-label" for="titulo">Titulo</label>
            <input type="text" id="titulo" name="titulo" required/>
          </td>

          <td>
            <label for="CargarImagen" class="form-label">Cargar Imagen</label>
            <input name="imagen" type="file" id="CargarImagen"  accept="image/*" required>
          </td>
        </tr>

        <tr colspan="2"  >
          <td >
            <label  class="form-label" for="form4Example3">Descripcion</label>
            <textarea style="resize: none" cols="50" width="auto" name="descripcion"  required id="form4Example3" rows="4"></textarea>
          </td>
          <td></td>

        </tr>

        <tr>
          <td>
            <label for="FechaInicio">Fecha de Inicio:</label>
            <p id="input-fecha"><input type="date" id="FechaInicio" name="fecha_inicio" class="form-control"></p>

         </td>

          <td>
            <label for="FechaCierre">Fecha de cierre:</label>
              <p id="input-fecha"><input type="date" id="FechaCierre" name="fecha_fin" class="form-control"></p>

        </td>
        </tr>
      </table>
                  <br>
            <p id="button-convocatoria"> <input type="submit" value="Enviar" name="enviar"></p>

            </fieldset>
           </form>

    </section>
    <footer>
      <?php include '../footer.php'; ?>
    </footer>
</body>
</html>
