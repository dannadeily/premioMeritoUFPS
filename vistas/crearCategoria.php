<?php
session_start();
if (!isset($_SESSION['usuario'])||empty($_SESSION['usuario'])|| $_SESSION['rol']!="administrador") {
  header("location:iniciar.php");
}
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


        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Crear categoria</h5>

            <!-- General Form Elements -->
            <form class="form_register" action="../controladores/router.php?con=CategoriaControlador&fun=crearCategoria"  method="post" >
              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Nombre</label>
                <div class="col-sm-10">
                  <input required type="text" name="nombre" class="form-control">
                </div>
              </div>


              <div class="row mb-3">
                <label for="inputState" class="col-sm-2 col-form-label">Tipo de usuario</label>
                <div class="col-sm-10">
                  <select name="rol" id="inputState" class="form-select">
                    <option value="1">Estudiante</option>
                    <option value="2">Egresado</option>
                  </select>
                </div>
              </div>



              <div class="row mb-3">
                <label for="inputPassword" class="col-sm-2 col-form-label">Descripcion</label>
                <div class="col-sm-10">
                  <textarea required class="form-control" name="descripcion" style="height: 100px"></textarea>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">Crear</button>
                </div>
              </div>

            </form><!-- End General Form Elements -->

          </div>
        </div>
  </section>

</main>
  <footer>
        <?php include 'footer.php'; ?>
      </footer>
  </body>
</html>
