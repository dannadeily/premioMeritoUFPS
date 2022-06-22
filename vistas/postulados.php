<?php
session_start();
if (!isset($_SESSION['usuario'])||empty($_SESSION['usuario'])|| $_SESSION['rol']!="administrador") {
  header("location:iniciar.php");
}
require_once '../controladores/PostuladosControlador.php';
require_once '../controladores/ConvocatoriaCategoriaControlador.php';
$postulados=new PostuladosControlador();
$lista=$postulados->listar();
if (!empty($_GET["cc"])) {
  $convocatoriaCategoria=new ConvocatoriaCategoriaControlador();
  $convocatoria=$convocatoriaCategoria->buscar($_GET["cc"]);
}

 ?>
  <body>
    <header>
      <?php include 'HeaderLogin.php'; ?>
    </header>
    <aside>
      <?php include 'BarraLateralAdministrador.php'; ?>
    </aside>
    <main id="main" class="main">
    <section class="section">
      </div>
       <div class="row">
       <div class="col-lg-12">
         <div class="card">
           <div class="card-body">
             <h5 class="card-title">Seleccionar</h5>
             <!-- Table with stripped rows -->
             <table class="table datatable">
               <thead>
                 <tr>
                   <th scope="col">Codigo</th>
                   <th scope="col">Fecha de postulacion</th>
                   <th scope="col">Calificación</th>
                   <th scope="col">Documentos</th>
                   <th scope="col">Calificar</th>
                 </tr>
               </thead>
               <tbody>
                 <?php for ($i=0; $i <count($lista)-1 ; $i++) {
                   $ruta="../documentos/".$convocatoria->id_convocatoria."/".$convocatoria->id_categoria."/".$lista[$i]->codigo_usuario;
                   ?>
          <tr>
            <td> <?php echo $lista[$i]->codigo_usuario ?>  </td>
            <td> <?php echo $lista[$i]->fecha_postulacion ?>  </td>
            <td> <?php echo $lista[$i]->calificacion ?>  </td>
            <td> <button type="button" class="btn btn-primary bi bi-card-checklist" data-bs-toggle="modal" data-bs-target="#exampleModal">
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Documentos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">Documento</th>
                    <th scope="col">Visualizar</th>
                    <th scope="col">Descargar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if(file_exists($ruta)){

                    $carpeta=opendir($ruta);
                    while ($archivo=readdir($carpeta)) {

                      if(!is_dir($archivo)){
                        ?>
                        <tr>
                          <td> <?php  echo $archivo ?> </td>
                          <td> <a href="<?php echo "$ruta"."/".$archivo;?>" target="_blank"> <button class="bi bi-eye-fill btn-primary" type="button" name="button"></button> </a> </td>
                          <td> <a download href="<?php echo "$ruta"."/".$archivo;?>" > <button class="bi bi-download btn-primary" type="button" name="button"></button> </a> </td>
                        </tr>

                        <?php
                      }
                    }
                  } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div> </td>
<td>
  <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#calificar">
  Calificar
</button>

<!-- Modal -->
<div class="modal fade" id="calificar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="" action="../controladores/router.php?con=PostuladosControlador&fun=calificar" method="post">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Calificar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <input type="hidden" name="codigo" value="<?php echo $lista[$i]->codigo_usuario ?>"></p>
        <p id="notamodal">  <input required type="number" name="nota" placeholder="Inserte la nota" min="0"  max="5.0" step="any"> </p>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>

      </div>
    </div>
      </form>
  </div>
</div>
</td>
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
