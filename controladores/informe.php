<?php
session_start();
if (!isset($_SESSION['usuario'])||empty($_SESSION['usuario'])|| $_SESSION['rol']!="administrador") {
  header("location:../vistas/iniciar.php");
}
if (empty($_GET["conv"])) {
  header("location:../vistas/historial.php");
}

require_once 'ConvocatoriaControlador.php';
$convocatoria= new ConvocatoriaControlador();
$lista=$convocatoria->informe($_GET["conv"]);
date_default_timezone_set('America/Bogota');
$fecha=date("Y-m-d H:i:s");
ob_start();
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> reporte de inscritos</title>
  </head>
  <body>
    <section>

      <table style="width:100%;padding-bottom:20px;">
        <tr>
          <!-- <td style="width:auto"> <img  src="http://<?php echo $_SERVER['HTTP_HOST'] ?>/vistas/img/logo.png" alt="" style="width:150px;float:left;"> </td> -->

          <td ><?php echo "$fecha"; ?></td>
        </tr>
      </table >
      <h1 style="text-align:center;">Reporte de inscritos</h1>
      <table>
        <?php
        $categoria="";
      for ($i=0; $i <count($lista)-1 ; $i++) {
        if ($lista[$i]->nombre!=$categoria) {
    $categoria=$lista[$i]->nombre;
    ?>  <tr>
        <td colspan="7"> <?php echo $lista[$i]->nombre; ?>    </td>
    </tr> <?php
    ?>
    <tr>
      <td>Nombres</td>
      <td>Apellidos</td>
      <td>Codigo</td>
      <td>Email</td>
      <td>Usuario</td>
      <td>Fecha</td>
      <td>Nota</td>
    </tr>
    <?php
  }
  ?>
  <tr>
    <td> <?php echo $lista[$i]->nombres ?> </td>
    <td> <?php echo $lista[$i]->apellidos; ?>  </td>
    <td> <?php echo $lista[$i]->codigo_usuario; ?> </td>
    <td> <?php echo $lista[$i]->email ?>  </td>
    <td> <?php echo $lista[$i]->rol ?>  </td>
    <td> <?php echo $lista[$i]->fecha_postulacion ?> </td>
    <td> <?php echo $lista[$i]->calificacion ?>  </td>
  </tr>
  <?php
} ?>
</table>
    </section>
  </body>
</html>
<?php
$html=ob_get_clean();
require_once '../dompdf/autoload.inc.php';

use Dompdf\Dompdf;
$dompdf=new Dompdf();

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled'=> true));
$dompdf->setOptions($options);

$dompdf->loadHtml($html);

//$dompdf->setPaper('letter');

$dompdf->setPaper('leeter');

$dompdf->render();
//cambiar false a true para descragar
$dompdf->stream("reporte.pdf",array('Attachment'=>false));

 ?>
