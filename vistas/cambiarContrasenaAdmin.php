<?php
require_once '../controladores/UsuarioControlador.php';
$usuario=new UsuarioControlador();
  session_start();
if (isset($_SESSION['usuario'])&& $_SESSION['rol']=="administrador") {
  $datos=$usuario->listar($_SESSION['usuario']);
}
else {
  header("location:iniciar.php");
}
 ?>
  <body>
    <header>
    <?php include 'HeaderLogin.php'; ?>
    </header>
    <aside >
        <?php include 'BarraLateralAdministrador.php'; ?>
    </aside>
    <main>

  <div class="container">
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
            <div class="card mb-3">
              <div class="card-body">
                <div class="pt-4 pb-2">
                  <h5 class="card-title text-center pb-0 fs-4">Cambiar contraseña</h5>
                </div>

                <form action="../controladores/router.php?con=UsuarioControlador&fun=cambiarContrasena" method="post" class="row g-3 needs-validation" >

                  <div class="col-12">
                    <label for="yourUsername" class="form-label">Contraseña actual</label>
                    <div class="input-group has-validation">
                      <input type="password" name="actual" class="form-control" id="yourUsername" required>
                    </div>
                  </div>

                  <div class="col-12">
                    <label for="yourPassword" class="form-label">Contraseña nueva</label>
                    <input type="password" name="nueva1" class="form-control" id="yourPassword" required>
                  </div>
                  <div class="col-12">
                    <label for="yourPassword" class="form-label">Repetir contraseña nueva</label>
                    <input type="password" name="nueva2" class="form-control" id="yourPassword" required>
                  </div>
                  <div class="col-12">
                    <button class="btn btn-primary w-100" name="enviar" type="submit">Cambiar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  </main>
  <footer>
    <?php include 'footer.php'
    ?>
  </footer>
  <form class="form" action="../../controladores/router.php?con=UsuarioControlador&fun=cambiarContrasena" method="post">


</html>
