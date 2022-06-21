<?php
session_start();
if (!isset($_SESSION['usuario'])||empty($_SESSION['usuario'])|| $_SESSION['rol']!="administrador") {
  header("location:iniciar.php");
}
require_once '../controladores/ConvocatoriaCategoriaControlador.php';
$convocatoriaCategoria=new ConvocatoriaCategoriaControlador();
$categoriasActivas=$convocatoriaCategoria->listar($_GET["conv"]);
$activas=count($categoriasActivas);
 ?>
 <header>
   <?php include 'HeaderLogin.php'; ?>
 </header>
 <aside class="">
   <?php include 'BarraLateralAdministrador.php' ?>
 </aside>
  <body>
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
              <th scope="col">Rol</th>
              <th scope="col">Seleccionar</th>
            </tr>
          </thead>
          <tbody>
            <?php for ($i=0; $i <$activas-1 ; $i++) {
              ?>
     <tr>
       <td> <?php echo $categoriasActivas[$i]->nombre ?> </td>
       <td> <?php echo $categoriasActivas[$i]->rol ?> </td>
       <td> <a href="postulados.php?cc=<?php echo $categoriasActivas[$i]->id ?>"> <button class="btn btn-success bi bi-bookmark-check" type="button" name="button"></button> </a></td>
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
      <?php include 'footer.php' ?>
    </footer>
