<?php
session_start();
if (!isset($_SESSION['usuario'])||empty($_SESSION['usuario'])|| $_SESSION['rol']!="administrador") {
  header("location:../vistas/modulo/iniciar.php");
}
if (empty($_GET["conv"])) {
  header("location:../vistas/modulo/historial.php");
}
require_once '../controladores/ConvocatoriaCategoriaControlador.php';
require '../controladores/ConvocatoriaControlador.php';
$convocatoria=new ConvocatoriaControlador();
$lista=$convocatoria->informe($_GET["conv"]);
$categoriascon=new ConvocatoriaCategoriaControlador();
$listar=$categoriascon->listar($_GET["conv"]);
$count=count($listar);
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/tabla.css">
    <link rel="stylesheet" href="css/participantes.css">
    <title>Participantes</title>
  </head>
  <body>
    <main id="main" class="main">
    <header>

      <?php include 'HeaderLogin.php'; ?>
    </header>
    <aside class="">
      <?php include 'BarraLateralAdministrador.php';  ?>
    </aside>
    <section id="container-historial">


      <nav id="nav">

      <table id="costumers-activar">
        <ul id="ul">


        <li id="li"> <a id="a" href="#">Seleccione categoria</a>
          <ul id="ul">
          <?php for ($i=0; $i <$count-1 ; $i++) { ?>


                <li id="li"> <a id="a" href="participantes.php?cc=<?php echo $listar[$i]->id; ?>&&conv=<?php echo $_GET["conv"]; ?>&&cat=<?php echo $listar[$i]->id_categoria ?>">
                  <?php  echo $listar[$i]->nombre." ".$listar[$i]->rol; ?> <i class="fas fa-angle-right">   </i>
                </a>
                </li>
              <?php    } ?>
        </ul>
        </li>
        </ul>
       </table>

     </nav>
     <?php if (!empty($_GET["cat"])): ?>


             <table id="customers">
                   <tr>
                   <th>Nombres</th>
                   <th>Apellidos</th>
                   <th>Codigo</th>
                   <th>Email</th>
                   <th>Rol</th>
                   <th>Postulacion</th>
                   <th>Nota</th>
                 </tr>
                 <?php for ($i=0; $i <count($lista)-1 ; $i++) {
                   if($lista[$i]->id_convocatoria_categoria==$_GET["cc"]){
                   ?>


                         <td><?php echo $lista[$i]->nombres ?> </td>
                         <td><?php echo $lista[$i]->apellidos ?> </td>
                         <td><?php echo $lista[$i]->codigo_usuario ?> </td>
                         <td><?php echo $lista[$i]->email ?> </td>
                         <td><?php echo $lista[$i]->rol ?> </td>
                         <td><?php echo $lista[$i]->fecha_postulacion ?> </td>
                         <td><?php echo $lista[$i]->calificacion ?> </td>
                       </tr>

                <?php } } ?>

     <?php endif; ?>


    </table>
    </section>
  </main>
    <footer>
      <?php include 'footer.php'; ?>
    </footer>
