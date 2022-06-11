<?php
session_start();
if (!isset($_SESSION['usuario'])||empty($_SESSION['usuario'])|| $_SESSION['rol']!="administrador") {
  header("location:iniciar.php");
}else {
  require_once '../controladores/ConvocatoriaControlador.php';
  $convocatoria=new ConvocatoriaControlador();
  $listaConvocatorias=$convocatoria->historial();

}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/tabla.css">
    <link rel="stylesheet" href="css/main.css">
    <title></title>
    <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  </head>
  <body>

    <main id="main" class="main">
    <header>
      <?php include 'HeaderLogin.php'; ?>
    </header>

    <aside class="">
      <?php include 'BarraLateralAdministrador.php' ?>
    </aside>

    <section class="section">
      <div class="row">
            <div class="card">
            <div class="card-body">
              <h5 class="card-title">Listado de convocatorias</h5>

              <!-- Default Table -->
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Titulo Convocatoria</th>
                    <th scope="col">descripcion</th>
                    <th scope="col">Fecha de cierre</th>
                    <th scope="col">Dias restantes</th>
                    <th scope="col">Seleccionar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php for ($i=0; $i <count($listaConvocatorias)-1 ; $i++) {
                    if (date('Y-m-d',strtotime($listaConvocatorias[$i]->fecha_fin.'+ 1 month'))>=date("Y-m-d")) {
                    ?>
                    <tr>
                      <td> <?php echo $listaConvocatorias[$i]->titulo ;?> </td>
                      <td> <?php echo $listaConvocatorias[$i]->descripcion ;?> </td>
                      <td> <?php echo $listaConvocatorias[$i]->fecha_fin;?> </td>
                      <td> <?php echo $convocatoria->diasRestantes($listaConvocatorias[$i]->fecha_fin);?> </td>
                      <td> <abbr title="Calificar"> <a href="calificarCategoria.php?conv=<?php echo $listaConvocatorias[$i]->id_convocatoria; ?>"> <i style="font-size:25px;" class="fas fa-clipboard-check"></i> </a></abbr></td>
                    </tr>

                  <?php  }
                 } ?>
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
