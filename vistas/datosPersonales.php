<?php
require_once'../controladores/UsuarioControlador.php';
$usuario=new UsuarioControlador();
session_start();
 if(!isset($_SESSION['usuario'])||($_SESSION['rol']!="Estudiante"&&$_SESSION['rol']!="Egresado")){
    header("location:iniciar.php");
  echo $_SESSION['usuario'];
  echo $_SESSION['rol'];
}

$datos=$usuario->listar($_SESSION['usuario']);
 ?>
    <title>datos personales</title>
    <link rel="stylesheet" href="css/datosPersonales.css">
  <header>
    <?php include 'HeaderLogin.php'?>
  </header>
  <body >

    <main id="main" class="main">

            <aside class="barra-menu">
            <?php include 'barraLateralUsuario.php'; ?>
          </aside>

    <section class="caja" id="container"  >
                  <h2>Datos Personales</h2>
                  <hr>
                        <table>
                              <tr>
                                  <td>
                                      <h4>Codigo usuario: </h4>
                                      <p class="datos"> <?php echo $datos[0]->codigo_usuario ?></p>
                                  </td>
                                  <td></td>
                             </tr>
                             <tr>
                                  <td>
                                      <h4>Nombres: </h4>
                                      <p class="datos"><?php echo $datos[0]->nombre ?></p>
                                </td>
                                 <td>
                                   <h4>Apellidos: </h4>
                                   <p class="datos"><?php echo $datos[0]->apellidos ?></p>
                                </td>
                           </tr>
                           <tr>
                               <td>
                                 <h4>Numero de documento: </h4>
                                 <p class="datos"> <?php echo $datos[0]->numero_documento ?>  </p>
                               </td>
                               <td>
                                 <h4>Tipo de documento: </h4>
                                 <p class="datos"> <?php echo $datos[0]->tipoDocumento ?> </p>
                               </td>
                             </tr>
                             <tr>
                                <td>
                                    <h4>Correo electronico: </h4>
                                    <p class="datos"> <?php echo $datos[0]->email ?> </p>
                                  </td>
                                  <td>
                                      <h4>Tipo de usuario: </h4>
                                      <p class="datos"> <?php echo $datos[0]->rol ?> </p>
                                    </td>

              </tr>


                </table>
                      <button type="button" class="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
 Editar
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form class="form_register-editar" action="../controladores/router.php?con=UsuarioControlador&fun=editarDatos" method="post">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Editar datos personales </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

                        <input type="hidden" name="codigo_usuario" value="<?php echo $datos[0]->codigo_usuario; ?>">
                        <div class="col-12">
                          <label for="yourUsername" class="form-label">Nombres</label>
                          <div class="input-group has-validation">
                            <input value="<?php echo $datos[0]->nombre; ?>" type="text" name="nombre" class="form-control" id="yourUsername" required>
                          </div>
                        </div>
                        <input type="hidden" name="codigo_usuario" value="<?php echo $datos[0]->codigo_usuario; ?>">
                        <div class="col-12">
                          <label for="yourUsername" class="form-label">Apellidos</label>
                          <div class="input-group has-validation">
                            <input  value="<?php echo $datos[0]->apellidos; ?>" type="text" name="apellidos" class="form-control" id="yourUsername" required>
                          </div>
                        </div>
                        <div class="col-12">
                          <label for="yourUsername" class="form-label">Número de documento</label>
                          <div class="input-group has-validation">
                            <input  value="<?php echo $datos[0]->numero_documento; ?>" type="number" name="numero_documento" class="form-control" id="yourUsername" required>
                          </div>
                        </div>

                        <div class="row mb-3">
  <label class="col-form-label">Tipo de documento</label>
  <div class="col-sm-12">
    <select name="tipoDocumento" class="form-select" aria-label="Default select example">
      <option value="Cedula de ciudadania"> Cedula de ciudadania</option>
      <option value="Tarjeta de identidad"> Tarjeta de identidad</option>
      <option value="Cedula de extranjeria"> Cedula de extranjeria</option>
    </select>
  </div>
</div>


                                          <div class="col-12">
                                            <label for="yourUsername" class="form-label">Correo electromico</label>
                                            <div class="input-group has-validation">
                                              <input  value="<?php echo $datos[0]->email; ?>" type="email" name="email" class="form-control" id="yourUsername" required>
                                            </div>
                                          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
      </div>
      </form>
    </div>
  </div>
</div>


    </section>
  </main>

  <footer>
    <?php include 'footer.php'
    ?>
  </footer>

  </body>
</html>
