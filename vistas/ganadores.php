<?php
session_start();
if (!isset($_SESSION['usuario'])||empty($_SESSION['usuario'])|| $_SESSION['rol']!="administrador") {
  header("location:iniciar.php");
}
require_once '../controladores/ConvocatoriaControlador.php';
$convocatoria= new ConvocatoriaControlador();
$ganadores=$convocatoria->ganadores($_GET["conv"]);
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/tabla.css">
    <title>Ganadores</title>
  </head>
  <body>

    <main id="main" class="main">
    <header>
      <?php include 'HeaderLogin.php'; ?>
    </header>
    <aside class="">
      <?php include 'BarraLateralAdministrador.php';  ?>
    </aside>
    <section class="section">
      </div>
       <div class="row">
       <div class="col-lg-12">
         <div class="card">
           <div class="card-body">
             <h5 class="card-title">Ganadores</h5>
             <!-- Table with stripped rows -->
             <table class="table datatable">
               <thead>
                 <tr>
                   <th>Codigo</th>
                   <th>Nombre</th>
                   <th>Apellidos</th>
                   <th>Categoria</th>
                   <th>rol</th>
                   <th>Calificacion</th>
                 </tr>
               </thead>
               <tbody>
                 <?php for ($i=0; $i <count($ganadores)-1 ; $i++) {
                   ?>
          <tr>
            <td> <?php echo $ganadores[$i]->codigo_usuario; ?> </td>
            <td> <?php echo $ganadores[$i]->nombres; ?> </td>
            <td> <?php echo $ganadores[$i]->apellidos; ?> </td>
            <td> <?php echo $ganadores[$i]->nombre; ?> </td>
            <td> <?php echo $ganadores[$i]->rol; ?> </td>
            <td> <?php echo $ganadores[$i]->calificacion; ?> </td>
          </tr>
        <?php } ?>
               </tbody>
             </table>
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
