<?php
session_start();
if (!isset($_SESSION['usuario'])||empty($_SESSION['usuario'])|| $_SESSION['rol']!="administrador") {
  header("location:iniciar.php");
}
require_once '../controladores/DocumentoControlador.php';
$documento=new DocumentoControlador();
$informacion=$documento->buscar($_GET['id']);
$count=count($informacion);


?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">

    <title>Editar documento</title>

    <link rel="stylesheet" href="css/editarCategoria.css">
    <title>Editar documento</title>


  </head>
  <body>
    <main id="main" class="main">
    <header>
      <?php include 'HeaderLogin.php'; ?>
    </header>
    <aside class="">
      <?php include 'BarraLateralAdministrador.php'; ?>
    </aside>

    <section id="container-editarC">
      <form class="" action="../controladores/router.php?con=DocumentoControlador&fun=editar" method="post">
        <p> Nombre </p>
        <input type="hidden" name="id" value="<?php echo $informacion[0]->id_documento; ?>">
        <input class="input-nombre" type="text" name="nombre" value="<?php echo $informacion[0]->nombre; ?>">
        <br>
        <p>Descripcion</p>
        <textarea style="resize: none" name="descripcion" rows="8" cols="80" name="descripcion"><?php echo $informacion[0]->descripcion; ?></textarea>
        <p id="button-categoria"><input type="submit" name="continuar" value="actualizar"></p>
      </form>
    </section>
  </main>
    <footer>
      <?php include 'footer.php'; ?>
    </footer>
  </body>
</html>
