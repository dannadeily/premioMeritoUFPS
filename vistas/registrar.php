<?php
session_start();
session_destroy();
 ?>

<body>

  <header>
    <?php include 'Header.php' ?>
  </header>
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>REGISTRAR</h1>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-body">
              <!-- Multi Columns Form -->
                <form class="row g-3" id="form-registrar" action="../controladores/router.php?con=UsuarioControlador&fun=agregarUsuario" method="post">
                <div class="col-md-6">
                  <label for="inputName5" class="form-label">Codigo</label>
                  <input required type="number" name="codigo_usuario" class="form-control" id="inputName5">
                </div>
                <div class="col-md-6">
                  <label for="inputName5" class="form-label">Correo</label>
                  <input required type="email" name="email" class="form-control" id="inputName5">
                </div>
                <div class="col-md-6">
                  <label for="inputEmail5" class="form-label">nombre</label>
                  <input required type="text" name="nombre" class="form-control" id="inputEmail5">
                </div>
                <div class="col-md-6">
                  <label for="inputPassword5" class="form-label">apellido</label>
                  <input required type="text" name="apellidos" class="form-control" id="inputPassword5">
                </div>
                <div class="col-md-6">
                  <label for="inputState" class="form-label">Tipo Documento</label>
                  <select required id="inputState" name="tipoDocumento" class="form-select">
                    <option value="Cedula de ciudadania"> Cedula de ciudadania</option>
                                 <option value="Tarjeta de identidad"> Tarjeta de identidad</option>
                                 <option value="Cedula de extranjeria"> Cedula de extranjeria</option>
                  </select>
                </div>

                <div class="col-6">
                  <label for="inputAddress5" class="form-label">Número de documento</label>
                  <input required type="number" name="numero_documento" class="form-control" id="inputAddres5s">
                </div>

                <div class="col-6">
                  <label for="inputAddress2" class="form-label">contraseña</label>
                  <input required type="password" name="contrasena" class="form-control" id="inputAddress2">
                </div>
                <div class="col-md-6">
                  <label for="inputState" class="form-label">Tipo de usuario</label>
                  <select required name="rol" id="inputState" class="form-select">
                    <option value="Estudiante">estudiante</option>
                                  <option value="Egresado">Egresado</option>
                  </select>
                </div>
                <div class="col-12">
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Guardar</button>
                  <button type="reset" class="btn btn-secondary">Borrar</button>
                </div>
              </form>

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->
  <footer>
    <?php include 'footer.php'
    ?>
  </footer>
</body>
