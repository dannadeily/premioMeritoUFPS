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


  <body>
    <header>
      <?php include 'HeaderLogin.php'; ?>
    </header>
      <aside class="">
        <?php include 'BarraLateralAdministrador.php'; ?>
      </aside>
    <main id="main" class="main">
      <section class="section">
        <div class="row">
              <div class="card">
              <div class="card-body">
                <h5 class="card-title">Seleccionar categorias</h5>

      <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
        <div class="dataTable-top">
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
          <form class="" action="../controladores/router.php?con=CategoriaControlador&fun=estado&id=<?php echo $listar[$i]->id_categoria?>&estado=<?php echo $listar[$i]->estado?>" method="post">
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
