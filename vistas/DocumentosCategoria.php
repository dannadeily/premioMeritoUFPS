<?php
require_once '../controladores/DocumentoControlador.php';

session_start();

if (!isset($_SESSION['usuario'])||empty($_SESSION['usuario'])|| $_SESSION['rol']!="administrador") {
  header("location:iniciar.php");
}
$documento=new DocumentoControlador();
$informacion=$documento->listar($_GET['id']);
$count=count($informacion);
 ?>

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
        <h5 class="card-title">Documentos</h5>
        <table class="table datatable">
          <thead>
            <tr>
              <th>Documento</th>
              <th>Requisito</th>
              <th>Accion</th>
            </tr>
          </thead>
          <tbody>
            <?php for ($i=0; $i <$count-1 ; $i++) {
              ?>
              <tr>
                <td><?php echo $informacion[$i]->nombre ?></td>
                <td><?php echo $informacion[$i]->descripcion ?></td>
                <!-- <td> <abbr title="Editar"> <a href="editarDocumento.php?id=<?php echo $informacion[$i]->id_documento; ?>">  <i style="font-size:25px;color:black" class="fas fa-edit"></i> </a> </abbr>

                <abbr title="Borrar"> <a href="../controladores/router.php?con=DocumentoControlador&fun=borrarDocumento&id=<?php echo $_GET['id']?>&idDoc=<?php echo $informacion[$i]->id_documento ?>" > <i style="font-size:25px; color:red" class="fas fa-trash-alt"></i> </a></abbr>
              </td> -->
                <td>

                  <!-- Button trigger modal -->
<button type="button" class="btn btn-warning bi bi-pencil-square" data-bs-toggle="modal" data-bs-target="#editar<?php echo $i ?>">
</button>

<!-- Modal -->
<div class="modal fade" id="editar<?php echo $i ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <form class="" action="../controladores/router.php?con=DocumentoControlador&fun=editar" method="post">

  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Editar documento</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      <div class="row mb-3">
        <label for="inputText" class="col-sm-3 col-form-label">Nombre</label>
        <div class="col-sm-9">
          <input required value="<?php echo trim($informacion[$i]->nombre); ?>" type="text" name="nombre" class="form-control">
        </div>
      </div>

      <input  type="hidden" name="id" value="  <?php echo $informacion[$i]->id_documento; ?> ">
      <div class="row mb-3">
        <label for="inputPassword" class="col-sm-3 col-form-label">Descripcion</label>
        <div class="col-sm-9">
          <textarea required class="form-control" name="descripcion" style="height: 100px"><?php echo trim($informacion[$i]->descripcion); ?></textarea>
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





<!-- Button trigger modal -->
<button type="button" class="btn btn-danger bi bi-trash" data-bs-toggle="modal" data-bs-target="#eliminar<?php echo $i ?>">

</button>

<!-- Modal -->
<div class="modal fade" id="eliminar<?php echo $i ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Realmente desea eliminar el documento <?php echo trim($informacion[$i]->nombre); ?>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a href="../controladores/router.php?con=DocumentoControlador&fun=borrarDocumento&id=<?php echo $_GET['id']?>&idDoc=<?php echo $informacion[$i]->id_documento ?>" >  <button type="button" class="btn btn-danger">Elimiar</button>  </a>

      </div>
    </div>
  </div>
</div>

                </td>
              </tr>

              <?php
            } ?>
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
