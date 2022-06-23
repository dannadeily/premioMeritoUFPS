<body>

  <header>
    <?php include 'Header.php' ?>
  </header>
  <section>

    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <?php if (isset($_COOKIE['error'])) { ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            datos incorrectos
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          
        <?php }  ?>

        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">iniciar sesion</h5>
                    <p class="text-center small">ingresa codigo y contraseña</p>
                  </div>

                  <form action="../controladores/router.php?con=UsuarioControlador&fun=iniciarSesion" method="post" class="row g-3 needs-validation">

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Código</label>
                      <div class="input-group has-validation">
                        <input type="text" name="codigo" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Contraseña</label>
                      <input type="password" name="contrasena" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0"> ¿No tienes una cuenta? <a href="registrar.php">Registrate</a></p>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0"> <a href="recuperar.php">Recuperar contraseña</a></p>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </section>

    </div>

  </section>
  <footer>
    <?php include 'footer.php'
    ?>
  </footer>
</body>


</html>
<?php
@session_start();
@session_destroy();
?>