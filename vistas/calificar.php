<?php
session_start();
if (!isset($_SESSION['usuario'])||empty($_SESSION['usuario'])|| $_SESSION['rol']!="administrador") {
  header("location:iniciar.php");
}else {
  require_once '../controladores/ConvocatoriaControlador.php';
  $convocatoria=new ConvocatoriaControlador();
  $listaConvocatorias=$convocatoria->historial();

}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/tabla.css">
    <link rel="stylesheet" href="css/main.css">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <title></title>
    <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- dataTable -->
  <link rel="stylesheet" href="datatables/dataTables.min.css">
  <link rel="stylesheet" href="dataTables/dataTables-1.12.1/css/dataTables.bootstrap4.min.css">
  </head>
  <body>

    <main id="main" class="main">
    <header>
      <?php include 'HeaderLogin.php'; ?>
    </header>

    <aside class="">
      <?php include 'BarraLateralAdministrador.php' ?>
    </aside>


    <section class="section">
      <div class="row">
            <div class="card">
            <div class="card-body">
              <h5 class="card-title">Listado de convocatorias</h5>

    <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
      <div class="dataTable-top">
        <div class="dataTable-dropdown">
          <label>
            <select class="dataTable-selector">
            <option value="5">5</option>
            <option value="10" selected="">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
            <option value="25">25</option>
          </select> entries per page</label>
        </div>
        <div class="dataTable-search">
          <input class="dataTable-input" placeholder="Search..." type="text">
        </div>
      </div>
      <div class="dataTable-container">
        <table class="table datatable dataTable-table">
          <thead>
            <tr>
              <th scope="col">Titulo Convocatoria</th>
              <th scope="col">descripcion</th>
              <th scope="col">Fecha de cierre</th>
              <th scope="col">Dias restantes</th>
              <th scope="col">Seleccionar</th>
            </tr>
          </thead>
          <tbody>
            <?php for ($i=0; $i <count($listaConvocatorias)-1 ; $i++) {
              if (date('Y-m-d',strtotime($listaConvocatorias[$i]->fecha_fin.'+ 1 month'))>=date("Y-m-d")) {
              ?>
              <tr>
                <th scope="row"></th>
                <td> <?php echo $listaConvocatorias[$i]->titulo ;?> </td>
                <td> <?php echo $listaConvocatorias[$i]->descripcion ;?> </td>
                <td> <?php echo $listaConvocatorias[$i]->fecha_fin;?> </td>
                <td> <?php echo $convocatoria->diasRestantes($listaConvocatorias[$i]->fecha_fin);?> </td>
                <td> <abbr title="Calificar"> <a href="calificarCategoria.php?conv=<?php echo $listaConvocatorias[$i]->id_convocatoria; ?>"> <i style="font-size:25px;" class="fas fa-clipboard-check"></i> </a></abbr></td>
              </tr>

            <?php  }
           } ?>
          </tbody>
             </table>
           </div>
           <div class="dataTable-bottom">
             <div class="dataTable-info">Showing 1 to 5 of 5 entries
             </div>
             <nav class="dataTable-pagination">
               <ul class="dataTable-pagination-list">
               </ul>
             </nav>
           </div>
         </div>


</section>

</main>


</script>
  </body>
</html>
