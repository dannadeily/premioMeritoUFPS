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
  <body>
    <header>
      <?php include 'HeaderLogin.php'; ?>
    </header>

    <aside class="">
      <?php include 'BarraLateralAdministrador.php' ?>
    </aside>
    <main id="main" class="main">
      
</main>
<?php include 'footer.php' ?>

</script>
  </body>
</html>
