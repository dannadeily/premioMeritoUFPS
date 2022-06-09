<?php
session_start();
session_destroy();
 ?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> Registro</title>
    <link rel="stylesheet" href="css/registrar.css">
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="../js/alertas.js"></script>
  </head>
  <body  onload="mensaje('<?php echo  $_GET["msg"] ?>')">
    <header>
    <?php   require 'Header.php';?>
    </header>

<section id="container"  >
            <div class="form_register">
              <h2>Registro usuario</h2>

              <hr>
               <form id="form-registrar" action="../../controladores/router.php?con=UsuarioControlador&fun=agregarUsuario" method="post">

                      <table>
                      <tr>
                        <td><label for="codigo_usuario">Codigo usuario</label>
                        <input type="number" name="codigo_usuario" id="codigo_usuario" placeholder="codigo usuario" required>
                       </td>
                        <td>
                          <label for="email">Correo electronico</label>
                          <input type="email" name="email" id="email" placeholder="Email" required>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <label for="nombre">Nombres</label>
                          <input type="text" name="nombre" id="nombre" placeholder="Nombre" required>
                        </td>
                        <td>
                          <label for="apellidos">Apellidos</label>
                          <input type="text" name="apellidos" id="apellidos" placeholder="Apellidos" required>
                        </td>
                      </tr>
                      <tr>
                        <td><label for="tipoDocumento">Tipo de documento</label>
                        <select name="tipoDocumento" id="tipoDocumento">
                                 <option value="Cedula de ciudadania"> Cedula de ciudadania</option>
                                 <option value="Tarjeta de identidad"> Tarjeta de identidad</option>
                                 <option value="Cedula de extranjeria"> Cedula de extranjeria</option>
                         </select>
                       </td>
                        <td>
                          <label for="numero_documento">Numero de documento</label>
                          <input type="number" name="numero_documento"  placeholder="numero documento" required>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <label for="contrasena">contraseña </label>
                          <input type="password" name="contrasena"  placeholder="contraseña" required>
                        </td>
                        <td>
                          <label for="rol">Tipo de usuario</label>
                          <select name="rol" id="tipoDocumento">
                                   <option value="Estudiante">estudiante</option>
                                   <option value="Egresado">Egresado</option>
                                 </select>
                         </td>

                      </tr>
                 </table>
                 <br>
                 <p id="button-registrar">  <input id="button-iniciar" type="submit" value="Registrar"></p>

               </form>

             </div>


              </section>

                <footer><?php   require 'footer.php';?></footer>


  </body>
</html>
