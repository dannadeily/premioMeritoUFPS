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
     <header>
       <?php include 'HeaderLogin.php'; ?>
     </header>
       <aside class="">
         <?php include 'barraLateralUsuario.php'; ?>

       </aside>
     <main id="main" class="main">
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
                      <th scope="col">Categoria</th>
                      <th scope="col">Descripcion</th>
                      <th scope="col">Fecha de cierre</th>
                      <th scope="col">Inscribir</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php for ($i=0; $i <$count-1 ; $i++) {
                      ?>
             <tr>
               <td>    <?php echo $historial[$i]->titulo ?>  </td>
               <td> <?php echo $historial[$i]->descripcion ?>  </td>
               <td> <?php echo $historial[$i]->fecha_fin ?>  </td>
               <td>  <a href="categoriasActivas.php?id=<?php echo $historial[$i]->id_convocatoria ?> "> <button class="btn btn-primary bi bi-clipboard-check" type="button" name="button"></button> </a> </td>
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
