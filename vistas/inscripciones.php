<?php
session_start();
if (!isset($_SESSION['usuario'])||empty($_SESSION['usuario'])||($_SESSION['rol']!="Estudiante"&&$_SESSION['rol']!="Egresado")) {
  header("location:iniciar.php");
}
include '../controladores/PostuladosControlador.php';
$postulados=new PostuladosControlador();
$postulaciones=$postulados->listar($_SESSION['usuario']);
$count=count($postulaciones);
 ?>


  <main id="main" class="main">
  <body>
    <header>
      <?php include 'HeaderLogin.php'; ?>
    </header>
    <aside class="">
      <?php include 'barraLateralUsuario.php' ?>
    </aside>
    <section class="section">
      </div>
       <div class="row">
       <div class="col-lg-12">
         <div class="card">
           <div class="card-body">
             <h5 class="card-title">Convocatorias</h5>
             <!-- Table with stripped rows -->
             <table class="table datatable">
               <thead>
                 <tr>
                   <th scope="col">Convocatoria</th>
                   <th scope="col">Categoria</th>
                   <th scope="col">Calificacion</th>
                 </tr>
               </thead>
               <tbody>
                 <?php for ($i=0; $i <$count-1 ; $i++) {
                   ?>
          <tr>
            <td> <?php echo $postulaciones[$i]->titulo ?> </td>
            <td><?php echo $postulaciones[$i]->nombre ?></td>
            <td><?php echo $postulaciones[$i]->calificacion ?></td>
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
