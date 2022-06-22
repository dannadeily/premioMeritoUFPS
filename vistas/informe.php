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
 <header>
   <?php include 'HeaderLogin.php'; ?>
 </header>
 <aside class="">
   <?php include 'BarraLateralAdministrador.php'; ?>
 </aside>


    <main id="main" class="main">



   <section class="section">
     <div class="row">
       <div class="col-lg-12">

         <div class="card">
           <div class="card-body">
             <h5 class="card-title">Informes</h5>
             <!-- Table with stripped rows -->
             <table class="table datatable">
               <thead>
                 <tr>
                   <th scope="col">Titulo</th>
                   <th scope="col">Descripcion</th>
                   <th scope="col">Fecha apertura</th>
                   <th scope="col">Fecha cierre</th>
                   <th scope="col">Informe</th>
                 </tr>
               </thead>
               <tbody>
                 <?php for ($i=0; $i < $count-1; $i++) {
                   ?>
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
             <!-- End Table with stripped rows -->

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
