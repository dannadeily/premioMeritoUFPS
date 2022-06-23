<?php
require_once '../controladores/CategoriaControlador.php';

session_start();
if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario']) || $_SESSION['rol'] != "administrador") {
  header("location:iniciar.php");
}
$categoria = new CategoriaControlador();
$listar = $categoria->listar();
$count = count($listar);
?>


<body>
  <header>
    <?php include 'HeaderLogin.php'; ?>
  </header>
  <aside class="">
    <?php include 'BarraLateralAdministrador.php'; ?>
  </aside>
  <main id="main" class="main">
    <section class="section">
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <?php if (isset($_COOKIE['error'])) { ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  Datos incorrectos.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php }  ?>
              <?php if (isset($_COOKIE['exito'])) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  Categoria creada con exito.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php }  ?>
              <?php if (isset($_COOKIE['actualizada'])) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  Categoria actualizada con exito.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php }  ?>
              <?php if (isset($_COOKIE['documentoActualizado'])) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  Documento actualizado con exito.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php }  ?>
              <h5 class="card-title">Categorias</h5>
              <!-- Button trigger modal -->
              
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>nombre</th>
                    <th>estado</th>
                    <th> Tipo de usuario </th>
                    <th>documentos requeridos</th>
                    <th>editar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php for ($i = 0; $i < $count - 1; $i++) { ?>
                    <tr>
                      <td> <?php echo $listar[$i]->nombre; ?> </td>

                      <?php if ($listar[$i]->estado > 0) { ?>

                        <td>
                          <form class="" action="../controladores/router.php?con=CategoriaControlador&fun=estado&id=<?php echo $listar[$i]->id_categoria ?>&estado=<?php echo $listar[$i]->estado ?>" method="post">
                            <a href=> <abbr title="Desactivar"><input style="background-color:#51FF00" type="submit" name="estado" value="A"></abbr> </a>
                          </form>
                        </td>
                      <?php } else {
                      ?>
                        <td>
                          <form class="" action="../controladores/router.php?con=CategoriaControlador&fun=estado&id=<?php echo $listar[$i]->id_categoria ?>&estado=<?php echo $listar[$i]->estado ?>" method="post">
                            <a href=> <abbr title="Activar"><input class=" " style="background-color:#FF0000" type="submit" name="estado" value="D"> </abbr> </a>
                          </form>
                        </td>
                      <?php
                      }  ?>
                      <td><?php echo $listar[$i]->rol; ?></td>

                      <td> <a href="DocumentosCategoria.php?id=<?php echo $listar[$i]->id_categoria ?>"> <button class="btn btn-primary bi bi-eye" type="button" name="button"></button> </a> </td>
                      <!-- <td> <a href="editarCategoria.php?id=<?php echo $listar[$i]->id_categoria ?>"> <abbr title="Editar"><i class="fas fa-edit"></i></abbr></a> </td> -->
                      <td>
                        <!-- Button trigger modal -->
                        <button type="button" class=" bi bi-pencil-square btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $i ?>">
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal<?php echo $i ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <form class="" action="../controladores/router.php?con=CategoriaControlador&fun=editar" method="post">

                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Editar categoria</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <div class="row mb-3">
                                    <label for="inputText" class="col-sm-3 col-form-label">Nombre</label>
                                    <div class="col-sm-9">
                                      <input required value="<?php echo trim($listar[$i]->nombre); ?>" type="text" name="nombre" class="form-control">
                                    </div>
                                  </div>

                                  <input type="hidden" name="id" value="  <?php echo $listar[$i]->id_categoria; ?> ">
                                  <div class="row mb-3">
                                    <label for="inputState" class="col-sm-3 col-form-label">Tipo de usuario</label>
                                    <div class="col-sm-9">
                                      <select name="rol" id="inputState" class="form-select">
                                        <option value="1">Estudiante</option>
                                        <option value="2">Egresado</option>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="row mb-3">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">Descripcion</label>
                                    <div class="col-sm-9">
                                      <textarea required class="form-control" name="descripcion" style="height: 100px"><?php echo trim($listar[$i]->descripcion); ?></textarea>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </td>
                    </tr>

                  <?php } ?>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <footer>
    <?php include 'footer.php'; ?>
  </footer>


</body>

</html>