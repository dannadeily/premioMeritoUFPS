<?php
session_start();
if (!isset($_SESSION['usuario'])||empty($_SESSION['usuario'])|| $_SESSION['rol']!="administrador") {
  header("location:iniciar.php");
}
require_once '../controladores/PostuladosControlador.php';
require_once '../controladores/ConvocatoriaCategoriaControlador.php';
$postulados=new PostuladosControlador();
$lista=$postulados->listar();
if (!empty($_GET["cc"])) {
  $convocatoriaCategoria=new ConvocatoriaCategoriaControlador();
  $convocatoria=$convocatoriaCategoria->buscar($_GET["cc"]);
}
 ?>
  <body>
    <main id="main" class="main">
    <header>
      <?php include 'HeaderLogin.php'; ?>
    </header>
    <aside>
      <?php include 'BarraLateralAdministrador.php'; ?>
    </aside>
    <section id="container-historial">


    <legend>Seleccione Usuario</legend>
    <table  id="customers">


      <tr>
        <th>Codigo</th>
        <th>Fecha de postulacion</th>
        <th>calificacion </th>
        <th>documentos</th>
      </tr>
    <?php for ($i=0; $i < count($lista)-1 ; $i++) {
      if ($lista[$i]->id_convocatoria_categoria==$_GET["cc"]) {
        ?>
        <form class="" action="../controladores/?con=PostuladosControlador&fun=calificar" method="post">
        <tr>
          <td> <?php echo $lista[$i]->codigo_usuario ?>  </td>
          <td> <?php echo $lista[$i]->fecha_postulacion ?>  </td>
          <td> <?php echo $lista[$i]->calificacion ?>  </td>
          <td> <abbr title="Revisar"> <a href="documentosUsuario.php?conv=<?php echo $convocatoria->id_convocatoria ?>&&cat=<?php echo $convocatoria->id_categoria ?>&&usuario=<?php echo$lista[$i]->codigo_usuario ?>">  <i style="font-size:25px;" class="fas fa-search"></i> </a> </abbr></td>

        </tr>
        </form>
        <?php
      }
    } ?>
    </table>


    </section>
  </main>
    <footer>
      <?php include 'footer.php'; ?>
    </footer>
  </body>
</html>
