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
    <link rel="stylesheet" href="css/tabla.css">
    <link rel="stylesheet" href="css/main.css">
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <title>Historial</title>
  </head>
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
                <h5 class="card-title">Historial de convocatorias</h5>

                <!-- Default Table -->
                <table class="table">
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
                    <?php for ($i=0; $i < $count-1; $i++) { ?>
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
                <!-- End Default Table Example -->
              </div>
            </div>
          </div>
    </section>
  </main>
  </body>
</html>
