<?php
session_start();
if (!isset($_SESSION['usuario'])||empty($_SESSION['usuario'])|| $_SESSION['rol']!="administrador") {
  header("location:iniciar.php");
}
require_once '../../controladores/ConvocatoriaCategoriaControlador.php';
$convocatoriaCategoria=new ConvocatoriaCategoriaControlador();
$categoriasActivas=$convocatoriaCategoria->listar($_GET["conv"]);
$activas=count($categoriasActivas);
 ?>

<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/calificar.css">
    <title>Categorias</title>
  </head>
  
  <body>
    <header>
      <?php include '../HeaderLogin.php'; ?>
    </header>
    <aside class="">
      <?php include 'BarraLateralAdministrador.php' ?>
    </aside>
    <section id="container-calificar">
      <legend>Seleccione categoria: </legend>
      <table id="customers-calificar">
        <tr>
          <th>Categoria</th>
          <th>Rol</th>
          <th>Acciones</th>
        </tr>
        <?php for ($i=0; $i <$activas-1 ; $i++) { ?>
          <tr>
            <td> <?php echo $categoriasActivas[$i]->nombre ?> </td>
            <td> <?php echo $categoriasActivas[$i]->rol ?> </td>
            <td> <abbr title="Seleccionar"><a href="postulados.php?cc=<?php echo $categoriasActivas[$i]->id ?>"> <i style="font-size:25px;" class="fas fa-check-circle"></i> </a></abbr> </td>
          </tr>
      <?php  } ?>
      </table>

    </section>

    <footer>
      <?php include '../footer.php' ?>
    </footer>
