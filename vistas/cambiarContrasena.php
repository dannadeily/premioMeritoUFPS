<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/controladores/UsuarioControlador.php';
$usuario=new UsuarioControlador();
  session_start();
if (isset($_SESSION['usuario'])&& ($_SESSION['rol']=="Estudiante" ||$_SESSION['rol']=="Egresado"  )) {
  $datos=$usuario->listar($_SESSION['usuario']);
}
else {
  header("location:iniciar.php");
}
 ?>

<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> cambiar contraseña </title>
    <link rel="stylesheet" href="../css/iniciar.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script src="../js/alertas.js"></script>
  </head>
  <body onload="mensaje('<?php echo  $_GET["msg"] ?>')">

    <main id="main" class="main">

<header>
<?php include 'HeaderLogin.php'; ?>
</header>

  <aside class="">
      <?php include 'barraLateralUsuario.php'; ?>
  </aside>

  <section class="form-login" id="container">

    <form class="form" action="../../controladores/router.php?con=UsuarioControlador&fun=cambiarContrasena" method="post">

        <h2>Cambiar contraseña</h2>
    <p id="p-contraseña"> contraseña actual <br> <input  type="password" name="actual" placeholder="contraseña actual" required> </p>

    <p id="p-contraseña">  nueva contraseña <br><input  type="password" name="nueva1" placeholder="contraseña nueva" required>  </p>

    <p id="p-contraseña"> repetir nueva contraseña <br> <input  type="password" name="nueva2" placeholder="contraseña nueva" required> </p>

    <p id="ingresar"><input  type="submit" name="enviar" value="guardar"></p>
    </form>

  </section>
</main>
<footer>
<?php include '../footer.php'; ?>
</footer>
  </body>
</html>
