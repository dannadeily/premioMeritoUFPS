<?php
require_once '../controladores/ConvocatoriaControlador.php';
session_start();
if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario']) || $_SESSION['rol'] != "administrador") {
  header("location:iniciar.php");
}
$convocatoria = new ConvocatoriaControlador();
$historial = $convocatoria->historial();
$count = count($historial);
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">

<body>

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
            <?php if (isset($_COOKIE['exito'])) { ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                Convocatoria creada con exito.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>

            <?php }  ?>
            <h5 class="card-title">Historial de convocatorias</h5>

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
                      <th>Participantes</th>
                      <th>Ganadores</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php for ($i = 0; $i < $count - 1; $i++) { ?>
                      <tr>
                        <td> <?php echo $historial[$i]->titulo; ?> </td>
                        <td> <?php echo $historial[$i]->descripcion; ?> </td>
                        <td> <?php echo $historial[$i]->fecha_inicio; ?> </td>
                        <td> <?php echo $historial[$i]->fecha_fin; ?> </td>
                        <td> <a href="participantes.php?conv=<?php echo $historial[$i]->id_convocatoria;  ?>">Participantes</a></td>
                        <td> <a href="ganadores.php?conv=<?php echo $historial[$i]->id_convocatoria;  ?>">Ganadores</a></td>
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
  <?php include 'footer.php' ?>
</body>

</html>