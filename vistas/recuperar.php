<?php
session_start();
session_destroy();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> Restablecer </title>
    <link rel="stylesheet" href="css/iniciar.css">

  </head>
  <body>


      <?php require 'Header.php'; ?>
    </header>
      <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                <div class="card mb-3">

                  <div class="card-body">

                    <div class="pt-4 pb-2">
                      <h5 class="card-title text-center pb-0 fs-4">Recuperar contraseña</h5>
                      <p class="text-center small">Ingresa tu código y correo electronico</p>
                    </div>

                    <form class="row g-3 needs-validation" novalidate>
                      <div class="col-12">
                        <label for="yourName" class="form-label">Código</label>
                        <input required type="text" name="name" class="form-control" id="yourName"  placeholder="codigo">
                      </div>
                      <div class="col-12">
                        <label for="yourUsername" class="form-label">Correo electronico</label>
                        <div class="input-group has-validation">
                          <span class="input-group-text" id="inputGroupPrepend">@</span>
                          <input required type="text" name="username" class="form-control" id="yourUsername" >
                        </div>
                      </div>

                      <div class="col-12">
                        <button class="btn btn-primary w-100" type="submit">Enviar</button>
                      </div>
                    </form>

                  </div>
                </div>

              </div>
            </div>
          </div>

        </section>

      </div>
  </body>
</html>
