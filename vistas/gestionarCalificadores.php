<?php
session_start();
if (!isset($_SESSION['usuario'])||empty($_SESSION['usuario'])|| $_SESSION['rol']!="administrador") {
  header("location:../vistas/iniciar.php");
}
include '../controladores/UsuarioControlador.php';
$usuario = new UsuarioControlador();
$usuariosLista = $usuario->listarCalificador();
array_pop($usuariosLista);
?>

<header>
  <?php include 'HeaderLogin.php'; ?>
</header>
  <?php include 'BarraLateralAdministrador.php'; ?>
<aside>

</aside>

<main id="main" class="main">
  <?php if (isset($_COOKIE['eliminada'])) {
  ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="bi bi-check-circle me-1"></i>Usuario eliminado con exito
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php

  }

  ?>
  <?php if (isset($_COOKIE['actualizada'])) {
  ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="bi bi-check-circle me-1"></i>Usuario actualizado con exito
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php
  }

  ?>

  <?php if (isset($_COOKIE['datosincompletos'])) {
  ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <i class="bi bi-exclamation-octagon me-1"></i>Datos incorrectos
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php

  }

  ?>
  <?php if (isset($_COOKIE['creada'])) {
  ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="bi bi-check-circle me-1"></i>Usuario añadido con exito
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php

  }

  ?>


  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Gestionar calificadores</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
              Añadir
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Añadir Calificador</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form id="form-registrar" action="../controladores/router.php?con=UsuarioControlador&fun=agregarUsuario" method="post">
                    <div class="col-md-12">
                      <label for="inputName5" class="form-label">Codigo</label>
                      <input required type="number" name="codigo_usuario" class="form-control" id="inputName5">
                    </div>
                    <div class="col-md-12">
                      <label for="inputName5" class="form-label">Correo</label>
                      <input required type="email" name="email" class="form-control" id="inputName5">
                    </div>
                    <div class="col-md-12">
                      <label for="inputEmail5" class="form-label">nombre</label>
                      <input required type="text" name="nombre" class="form-control" id="inputEmail5">
                    </div>
                    <div class="col-md-12">
                      <label for="inputPassword5" class="form-label">apellido</label>
                      <input required type="text" name="apellidos" class="form-control" id="inputPassword5">
                    </div>
                    <div class="col-md-12">
                      <label for="inputState" class="form-label">Tipo Documento</label>
                      <select required id="inputState" name="tipoDocumento" class="form-select">
                        <option value="Cedula de ciudadania"> Cedula de ciudadania</option>
                                     <option value="Tarjeta de identidad"> Tarjeta de identidad</option>
                                     <option value="Cedula de extranjeria"> Cedula de extranjeria</option>
                      </select>
                    </div>

                    <div class="col-md-12">
                      <label for="inputAddress5" class="form-label">Número de documento</label>
                      <input required type="number" name="numero_documento" class="form-control" id="inputAddres5s">
                    </div>

                    <div class="col-md-12">
                      <label for="inputAddress2" class="form-label">contraseña</label>
                      <input required type="password" name="contrasena" class="form-control" id="inputAddress2">
                    </div>
                    <input type="hidden" name="rol" value="Calificador">
                    <div class="col-12">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Canceral</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col">Codigo</th>
                  <th scope="col">Cedula</th>
                  <th scope="col">nombres</th>
                  <th>email</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 0;
                foreach ($usuariosLista as $key) {
                  $i++;
                ?>
                  <tr>
                    <td><?php echo $key->codigo_usuario ?></td>
                    <td><?php echo $key->numero_documento ?></td>
                    <td><?php echo $key->nombre.' '.$key->apellidos ?></td>
                    <td><?php echo $key->email ?></td>
                    <td><?php echo $key->numero_documento ?></td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
            <!-- End Table with stripped rows -->

          </div>
        </div>

      </div>
    </div>
  </section>

</main>


<?php
include 'footer.php';
?>
