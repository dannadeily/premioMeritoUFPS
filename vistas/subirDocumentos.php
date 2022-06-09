<?php
require_once '../../controladores/DocumentoControlador.php';
session_start();
if (!isset($_SESSION['usuario'])||empty($_SESSION['usuario'])||($_SESSION['rol']!="Estudiante"&&$_SESSION['rol']!="Egresado")) {
  header("location:iniciar.php");
}
$documento=new DocumentoControlador();
$documentos=$documento->listar();
$contarDocumentos=count($documentos);
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/subirDocumento.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script src="../js/alertas.js"></script>
      <title>subir documentos</title>
  </head>

  <body onload="mensaje('<?php echo  $_GET["msg"] ?>')">
    <header>
        
        <?php include '../HeaderLogin.php'; ?>
    </header>
      

    <aside >
      <?php include 'barraLateralUsuario.php'; ?>
    </aside>
    <section id="container-subir">
      <br>
    <h2> Cargar documentos </h2>
    <hr>
    <p>  Descargue el formulario de inscripcion del siguiente enlace:   <a href="../../documentos/formulario de inscripcion.pdf" target="_blank">Formulario de inscripcion</a></p>
    <form class="" action="../../controladores/router.php?con=DocumentoControlador&fun=guardarArchivo&cc=<?php echo $_GET["cc"]; ?>&co=<?php echo $_GET["con"]; ?>&cat=<?php echo $_GET["id"]; ?>" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo $_GET["cc"]; ?>">
      <?php for ($i=0; $i <$contarDocumentos-1 ; $i++) {?>
        <?php if ($documentos[$i]->id_categoria==$_GET["id"]): ?>
          <h4>  <?php echo $documentos[$i]->nombre ?> :  </h4>
        <input type="file" name="<?php echo $documentos[$i]->nombre ?>"  accept="application/pdf" required><br><br>
      <?php endif; ?>
    <?php  } ?>

      <br>

    <h6>los archivos deben estar en formato pdf y no superar los 5mb de tamaño</h6>
    <p class="button-subir">  <input type="submit" name="guardar" value="guardar"></p>
    </form>

    </section>
    <footer>
      <?php include '../footer.php'; ?>
    </footer>
  </body>
</html>
