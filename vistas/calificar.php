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
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/calificar.css">
    <title>Convocatorias</title>
  </head>
  <body>

    <header>
      <?php include 'HeaderLogin.php'; ?>
    </header>
    <aside class="">
      <?php include 'BarraLateralAdministrador.php' ?>
    </aside>
<section id="container-calificar">
  <table id="customers-calificar">
    <tr>
      <th>Titulo</th>
      <th>descripcion</th>
      <th>Fecha de cierre</th>
      <th>Dias restantes</th>
      <th>Acciones</th>
    </tr>

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
  </table>
</section>
  </body>
</html>
