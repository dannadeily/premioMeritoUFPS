<?php
session_start();
session_destroy();
 ?>
  <body>
    <header>
       <?php require 'Header.php'; ?>
    </header>
    <section>
      <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
              <?php if (isset($_COOKIE['error'])) { ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              datos incorrectos.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

          <?php }  ?>

          <?php if (isset($_COOKIE['exito'])) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              Se ha enviado un correo con su nueva contraseña.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

          <?php }  ?>
                <div class="card mb-3">
                  <div class="card-body">
                    <div class="pt-4 pb-2">
                      <h5 class="card-title text-center pb-0 fs-4">Recuperar contraseña</h5>
                      <p class="text-center small">ingresa codigo y correo electronico</p>
                    </div>

                    <form action="../controladores/router.php?con=UsuarioControlador&fun=recuperarContrasena" method="post" class="row g-3 needs-validation" >

                      <div class="col-12">
                        <label for="yourUsername" class="form-label">Código</label>
                        <div class="input-group has-validation">
                          <input type="text" name="codigo" class="form-control" id="yourUsername" required>
                        </div>
                      </div>

                      <div class="col-12">
                        <label for="yourPassword" class="form-label">Correo electronico</label>
                        <input type="email" name="email" class="form-control" id="yourPassword" required>
                      </div>
                      <div class="col-12">
                        <button class="btn btn-primary w-100" type="submit">Recuperar</button>
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
