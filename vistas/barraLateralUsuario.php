

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/barraLateral.css">
     <script
      src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
      data-auto-a11y="true"
    ></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title></title>
  </head>
  <body>



    <input type="checkbox" class="checkbox" id="check">
    <label class="menu" for="check" ><i class="fas fa-bars"></i></label>
      <div class="left-panel">

                  <ul>
                    <br>
             <h6 id="h1-barra"  style="color:#FFFFFF">NAVEGADOR PRINCIPAL</h6>

                <li>
                  <a id="lista" href= <?php $_SERVER["DOCUMENT_ROOT"]?>"/vistas/modulo/datosPersonales.php">
                    Datos Personales
                  </a>
                </li>
            <li >
              <a id="lista" href=" <?php $_SERVER["DOCUMENT_ROOT"]?>/vistas/modulo/convocatoriaAbiertas.php">
                Convocatoria
              </a>
            </li>
            <li>
              <a id="lista" href=" <?php $_SERVER["DOCUMENT_ROOT"]?>/vistas/modulo/inscripciones.php">
                Inscripciones
              </a>
            </li>
            <li >
              <a id="lista" href= <?php $_SERVER["DOCUMENT_ROOT"]?>"/vistas/modulo/cambiarContrasena.php">
                Cambiar Contraseña
              </a>
                </li>

          </ul>
      </div>
  </body>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
  </script>
</html>
