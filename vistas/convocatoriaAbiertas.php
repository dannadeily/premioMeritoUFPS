<?php
require_once '../controladores/ConvocatoriaControlador.php';
$convocatoria=new ConvocatoriaControlador();
$historial=$convocatoria->convocatoriasAbiertas();
$count=count($historial);
session_start();
if (!isset($_SESSION['usuario'])||empty($_SESSION['usuario'])|| ($_SESSION['rol']!="Estudiante"&&$_SESSION['rol']!="Egresado")) {
  header("location:iniciar.php");
}
 ?>

 <!DOCTYPE html>
 <html lang="es" dir="ltr">
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" href="../css/convocatoriaAbiertas.css">
     <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
     <title>convocatorias</title>
   </head>
   <body>
     <main id="main" class="main">
     <header>
       <?php include 'HeaderLogin.php'; ?>
     </header>
       <aside class="">
         <?php include 'barraLateralUsuario.php'; ?>

       </aside>

       <section id="container-abierta">
         <legend>Convocatorias:</legend>
         <hr>

       <table id="customers-abierta">
         <tr>
           <th>Categoria</th>
           <th>Descripcion</th>
           <th>Fecha de cierre</th>
           <th>Incribir</th>

         </tr>

       <?php for ($i=0; $i <$count-1 ; $i++) {?>
         <tr>
            <td>    <?php echo $historial[$i]->titulo ?>  </td>
            <td> <?php echo $historial[$i]->descripcion ?>  </td>
            <td> <?php echo $historial[$i]->fecha_fin ?>  </td>
            <td>  <abbr title="Seleccionar"><a href="categoriasActivas.php?id=<?php echo $historial[$i]->id_convocatoria ?> "> <i class="fas fa-check-square"></i> </a> </abbr>  </td>
          </tr>
      <?php } ?>
       </table>

        </section>
      </main>
     <footer>
         <?php include 'footer.php'; ?>
       </footer>
   </body>
 </html>
