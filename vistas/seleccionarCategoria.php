<?php
require_once '../../controladores/CategoriaControlador.php';

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
    <link rel="stylesheet" href="../css/seleccionarCategoria.css">
      <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <title> Categorias </title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script src="../js/alertas.js"></script>
  </head>
  <body onload="mensaje('<?php echo  $_GET["msg"] ?>')">

    <header>
      <?php include '../HeaderLogin.php'; ?>
    </header>
      <aside class="">
        <?php include 'BarraLateralAdministrador.php'; ?>
      </aside>


      <section id="container-seleccionarC">
        <legend> Seleccionar categorias </legend>
        <table id="customers-seleccionarC">
          <tr>
            <th>nombre</th>
            <th>estado</th>
            <th> Tipo de usuario </th>
            <th>documentos requeridos</th>
            <th>editar</th>
          </tr>

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

        </table>
      </section>

      <footer>
          <?php include '../footer.php'; ?>
      </footer>


  </body>

</html>
