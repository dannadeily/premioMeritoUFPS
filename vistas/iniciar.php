<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Entrar</title>
  <!-- <link rel="stylesheet" href="css/iniciar.css"> -->
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


</head>

<body>
  <header>
    <?php  include 'Header.php' ?>
  </header>
  <section>
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="img/logoufps.png" alt="">
                  <span class="d-none d-lg-block">UFPS</span>
                </a>
              </div><!-- End Logo -->
              <div class="card mb-3">
                <div class="card-body">
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">iniciar sesion</h5>
                    <p class="text-center small">ingresa codigo y contraseña</p>
                  </div>

                  <form action="../controladores/router.php?con=UsuarioControlador&fun=iniciarSesion" method="post" class="row g-3 needs-validation" novalidate>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <input type="text" name="username" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Don't have account? <a href="pages-register.html">Create an account</a></p>
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
    <?php //include 'footer.php'
    ?>
  </footer>
  <script src="../js/alertas.js"> </script>
</body>


</html>
<?php
@session_start();
@session_destroy();
?>
