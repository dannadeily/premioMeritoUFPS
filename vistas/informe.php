<?php
require_once '../controladores/ConvocatoriaControlador.php';
session_start();
if (!isset($_SESSION['usuario'])||empty($_SESSION['usuario'])|| $_SESSION['rol']!="administrador") {
  header("location:iniciar.php");
}
$convocatoria=new ConvocatoriaControlador();
$historial=$convocatoria->historial();
$count=count($historial);
 ?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/tabla.css">
    <title>Informes</title>
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
                <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Generar Informes</h5>

        <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
          <div class="dataTable-top">
            <div class="dataTable-dropdown">
              <label>
                <select class="dataTable-selector">
                <option value="5">5</option>
                <option value="10" selected="">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="25">25</option>
              </select> entries per page</label>
            </div>
            <div class="dataTable-search">
              <input class="dataTable-input" placeholder="Search..." type="text">
            </div>
          </div>
          <div class="dataTable-container">
            <table class="table datatable dataTable-table">
              <thead>
                <tr>
                  <th>Titulo</th>
                  <th>Descripcion</th>
                  <th>Fecha de apertura</th>
                  <th>Fecha de cierre</th>
                  <th>Informe</th>
                </tr>
              </thead>
              <tbody>
                <?php for ($i=0; $i < $count-1; $i++) { ?>
                  <tr>
                    <td> <?php echo $historial[$i]->titulo; ?> </td>
                    <td> <?php echo $historial[$i]->descripcion; ?> </td>
                    <td> <?php echo $historial[$i]->fecha_inicio; ?> </td>
                    <td> <?php echo $historial[$i]->fecha_fin; ?> </td>
                    <td> <a href="../controladores/informe.php?conv=<?php echo $historial[$i]->id_convocatoria;  ?>" target="_blank">Participantes  </a>
                        <br>
                         <a href="../controladores/informeGanadores.php?conv=<?php echo $historial[$i]->id_convocatoria;  ?>"  target="_blank">Ganadores</a></td>
                  </tr>
                <?php } ?>
              </tbody>
                 </table>
               </div>
               <div class="dataTable-bottom">
                 <div class="dataTable-info">Showing 1 to 5 of 5 entries
                 </div>
                 <nav class="dataTable-pagination">
                   <ul class="dataTable-pagination-list">
                   </ul>
                 </nav>
               </div>
             </div>
      </div>
      </div>
      </div>

      </section>

      </main>
      <footer>
          <?php include 'footer.php'; ?>
      </footer>
  </body>
</html>
