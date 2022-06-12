<?php
require_once '../controladores/CategoriaControlador.php';

session_start();
if (!isset($_SESSION['usuario'])||empty($_SESSION['usuario'])||$_SESSION['rol']!="administrador") {
  header("location:iniciar.php");
}
$categoria=new CategoriaControlador();
$listar=$categoria->listar();
$count=count($listar);
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="seleccionarCategoria.css">
    <link rel="stylesheet" href="css/tabla.css">
    <link rel="stylesheet" href="css/main.css">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

      <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <title> Categorias </title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script src="../js/alertas.js"></script>
  </head>
  <body onload="mensaje('<?php echo  $_GET["msg"] ?>')">

    <main id="main" class="main">
    <header>
      <?php include 'HeaderLogin.php'; ?>
    </header>
      <aside class="">
        <?php include 'BarraLateralAdministrador.php'; ?>
      </aside>
      <section class="section">
        <div class="row">
              <div class="card">
              <div class="card-body">
                <h5 class="card-title">Seleccionar categorias</h5>

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
            <th>nombre</th>
            <th>estado</th>
            <th> Tipo de usuario </th>
            <th>documentos requeridos</th>
            <th>editar</th>
          </tr>
        </thead>
        <tbody>
        <?php for ($i=0; $i < $count-1; $i++) { ?>
          <tr>
            <td> <?php echo $listar[$i]->nombre; ?> </td>
          <form class="" action="../../controladores/router.php?con=CategoriaControlador&fun=estado&id=<?php echo $listar[$i]->id_categoria?>&estado=<?php echo $listar[$i]->estado?>" method="post">
          <?php if ($listar[$i]->estado>0){ ?>

            <td> <a href=> <abbr title="Desactivar"><input style="background-color:#51FF00" type="submit" name="estado"   value="A"></abbr> </a> </td>
          <?php } else{
            ?>
              <td> <a href=> <abbr title="Activar"><input class=" " style="background-color:#FF0000" type="submit" name="estado" value="D"> </abbr> </a> </td>
            <?php
          }  ?>
            <td><?php echo $listar[$i]->rol; ?></td>
            <td> <a href="DocumentosCategoria.php?id=<?php echo $listar[$i]->id_categoria ?>"> <abbr title="Visualizar"><i class="fas fa-eye"></i></abbr></a>     </td>
            <td> <a href="editarCategoria.php?id=<?php echo $listar[$i]->id_categoria ?>"> <abbr title="Editar"><i class="fas fa-edit"></i></abbr></a> </td>
          </tr>
          </form>
        <?php } ?>
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
      </div>
      </div>
      </div>

      </section>
    </main>
      <footer>
          <?php include 'footer.php'; ?>
      </footer>


  </body>
  <script src="js/main.js"></script>
</html>
