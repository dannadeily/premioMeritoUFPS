<?php
require_once '../controladores/ConvocatoriaControlador.php';
session_start();
if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario']) || $_SESSION['rol'] != "administrador") {
  header("location:iniciar.php");
}
$convocatoria = new ConvocatoriaControlador();
$historial = $convocatoria->convocatoriaVigente();
$count = count($historial);
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

        <?php if (isset($_COOKIE['errorImagen'])) { ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            Imagen incorrecta. Intente con otra.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>

        <?php }  ?>

        <?php if (isset($_COOKIE['fecha'])) { ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            la fecha de inicio no puede ser mayor a la fecha de cierre.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>

        <?php }  ?>

        <?php if (isset($_COOKIE['actualizada'])) { ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            Convocatoria actualizada con exito.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>

        <?php }  ?>
              <h5 class="card-title">Editar Convocatoria</h5>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">Titulo</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Fecha apertura</th>
                    <th scope="col">Fecha cierre</th>
                    <th scope="col">Editar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php for ($i = 0; $i < $count - 1; $i++) {
                  ?>
                    <tr>
                      <td> <?php echo $historial[$i]->titulo; ?> </td>
                      <td> <?php echo $historial[$i]->descripcion; ?> </td>
                      <td> <?php echo $historial[$i]->fecha_inicio; ?> </td>
                      <td> <?php echo $historial[$i]->fecha_fin; ?> </td>
                      <td>

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-warning bi bi-pencil-square" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $i ?>">
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal<?php echo $i ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">

                            <div class="modal-content">
                              <form class="form_register" action="../controladores/router.php?con=ConvocatoriaControlador&fun=editarConvocatoria" method="post" enctype="multipart/form-data">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Editar convocatoria</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <input type="hidden" name="id" value="<?php echo $historial[$i]->id_convocatoria; ?>">
                                  <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Titulo</label>
                                    <div class="col-sm-10">
                                      <input required type="text" name="titulo" class="form-control" value="<?php echo $historial[$i]->titulo; ?>">
                                    </div>
                                  </div>

                                  <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">Cargar imagen</label>
                                    <div class="col-sm-10">
                                      <input accept="image/*" name="imagen" class="form-control" type="file" id="formFile">
                                    </div>
                                  </div>

                                  <div class="row mb-3">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Descripcion</label>
                                    <div class="col-sm-10">
                                      <textarea required class="form-control" name="descripcion" style="height: 100px"><?php echo $historial[$i]->descripcion; ?></textarea>
                                    </div>
                                  </div>

                                  <div class="row mb-3">
                                    <label for="inputDate" class="col-sm-2 col-form-label">Fecha inicio</label>
                                    <div class="col-sm-10">
                                      <input required name="fecha_inicio" value="<?php echo $historial[$i]->fecha_inicio; ?>" min="<?php echo  $historial[$i]->fecha_inicio ?>" type="date" class="form-control">
                                    </div>
                                  </div>

                                  <div class="row mb-3">
                                    <label for="inputDate" class="col-sm-2 col-form-label">Fecha fin</label>
                                    <div class="col-sm-10">
                                      <input name="fecha_fin" value="<?php echo $historial[$i]->fecha_fin; ?>" required min="<?php echo $historial[$i]->fecha_fin ?>" type="date" class="form-control">
                                    </div>
                                  </div>



                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
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