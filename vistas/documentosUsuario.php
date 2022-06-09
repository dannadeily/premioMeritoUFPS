<?php
session_start();
if (!isset($_SESSION['usuario'])||empty($_SESSION['usuario'])|| $_SESSION['rol']!="administrador") {
  header("location:iniciar.php");
}
$ruta="../../documentos/".$_GET["conv"]."/".$_GET["cat"]."/".$_GET["usuario"];
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> Documentos cargados </title>

      <link rel="stylesheet" href="../css/modalNota.css">
      <link rel="stylesheet" href="../css/tabla.css">
  </head>
  <body>
    <header>
      <?php include '../HeaderLogin.php'; ?>
    </header>
    <aside>
      <?php include 'BarraLateralAdministrador.php'; ?>
    </aside>
    <section id="container-historial" >
      <legend>Documentos</legend>
      <hr>

        <input type="checkbox" id="button-editar">

        <label for="button-editar" class="lbl-editar">Calificar</label>
        <br>
        <br>

        <div class="modal">
          <div class="contenedor">
            <header>
              Agregar nota
            </header>
            <label for="button-editar">X</label>
              <div class="Contenido">
                <form class="" action="../../controladores/router.php?con=PostuladosControlador&fun=calificar" method="post">
                <input type="hidden" name="codigo" value="<?php echo $_GET["usuario"] ?>"></p>
                <p id="notamodal">  <input type="number" name="nota" placeholder="Inserte la nota"  max="5.0" step="any"> </p>
                <p id="inpmodal"> <input type="submit" name="calificar" value="calificar" id="inpmodal" ></p>

                </form>
              </div>
          </div>
        </div>

    <table id="customers">
      <tr>
        <th>Documento</th>
        <th>Visualizar</th>
        <th>Descargar</th>
      </tr>

      <?php
      if(file_exists($ruta)){

        $carpeta=opendir($ruta);
        while ($archivo=readdir($carpeta)) {

          if(!is_dir($archivo)){
            ?>
            <tr>
              <td> <?php  echo $archivo ?> </td>
              <td> <abbr title="Visualizar"><a href="<?php echo "$ruta"."/".$archivo;?>" target="_blank"> <i style="font-size:20px;"class="fas fa-eye"></i> </a> </abbr> </td>
              <td> <abbr title="Descargar"> <a download href="<?php echo "$ruta"."/".$archivo;?>" > <i style="font-size:25px;" class="fas fa-file-download"></i> </a></abbr>  </td>
            </tr>

            <?php
          }
        }
      } ?>
    </table>


    </section>

    <footer>
      <?php include '../footer.php'; ?>
    </footer>
    </body>
