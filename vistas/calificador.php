<?php
session_start();
if (!isset($_SESSION['usuario'])||empty($_SESSION['usuario'])|| $_SESSION['rol']!="Calificador") {
  header("location:iniciar.php");
}else {
  require_once '../controladores/ConvocatoriaControlador.php';
  $convocatoria=new ConvocatoriaControlador();
  $listaConvocatorias=$convocatoria->historial();

}
 ?>
  <body>
    <header>
      <?php include 'HeaderLogin.php'; ?>
    </header>

    <aside class="">
      <?php include 'BarraLateralCalificador.php' ?>
    </aside>


    <main id="main" class="main">

  <section class="section">
    </div>
    <div class="row">
      <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
      <?php if (isset($_COOKIE['error'])) { ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  Datos incorrectos.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php }  ?>
              <?php if (isset($_COOKIE['exito'])) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  Nota agregada con exito.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

              <?php }  ?>
        <h5 class="card-title">Convocatorias</h5>
        <table class="table datatable">
          <thead>
            <tr>
              <th scope="col">Titulo</th>
              <th scope="col">Descripcion</th>
              <th scope="col">Fecha de cierre</th>
              <th scope="col">Dias restantes</th>
              <th scope="col">Seleccionar</th>
            </tr>
          </thead>
          <tbody>
            <?php for ($i=0; $i <count($listaConvocatorias)-1 ; $i++) {
              ?>
     <tr>
       <td> <?php echo $listaConvocatorias[$i]->titulo; ?> </td>
       <td> <?php echo $listaConvocatorias[$i]->descripcion; ?> </td>
       <td> <?php echo $listaConvocatorias[$i]->fecha_fin; ?> </td>
       <td><?php echo $convocatoria->diasRestantes($listaConvocatorias[$i]->fecha_fin);?> </td>
         <td><a href="calificarCategoriaCalificador.php?conv=<?php echo $listaConvocatorias[$i]->id_convocatoria; ?>"> <button class="bi bi-check btn btn-success" type="button" name="button"></button> </a></td>
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
<?php include 'footer.php' ?>

</script>
  </body>
</html>
