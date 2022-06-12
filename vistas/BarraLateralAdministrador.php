<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/barraLateral.css">

     <script
      src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
      data-auto-a11y="true"
    ></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Favicons -->
<link href="assets/img/favicon.png" rel="icon">
<link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

<!-- Google Fonts -->
<link href="https://fonts.gstatic.com" rel="preconnect">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

<!-- Vendor CSS Files -->
<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
<link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
<link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
<link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
<link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <title></title>
  </head>
  <body>

    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

          <li class="nav-item">

              <i class="bi bi-grid"></i>
              <span>NAVEGADOR PRINCIPAL</span>
          </li><!-- End Dashboard Nav -->

    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Convocatoria</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="crearConvocatoria.php">
              <i class="bi bi-circle"></i><span>Crear Convocatorias</span>
            </a>
          </li>
          <li>
            <a href="convocatoriaVigente.php">
              <i class="bi bi-circle"></i><span>Editar Convocatoria</span>
            </a>
          </li>
          <li>
            <a href="calificar.php">
              <i class="bi bi-circle"></i><span>Calificar</span>
            </a>
          </li>
          <li>
            <a href="historial.php">
              <i class="bi bi-circle"></i><span>Historial</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav  Categoria-->

      <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-stack"></i><span>Categoria</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="crearCategoria.php">
            <i class="bi bi-circle"></i><span>Crear Categoria</span>
          </a>
        </li>
        <li>
          <a href="seleccionarCategoria.php">
            <i class="bi bi-circle"></i><span>Editar Categoria</span>
          </a>
        </li>
    </li><!-- End Forms Nav -->
  </ul>
  <li class="nav-item">
    <a class="nav-link collapsed" href="informe.php">
      <i class="bi bi-journal-text"></i>
      <span>Generar Informe</span>
    </a>
  </li><!-- End generar informe Page Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="cambiarContrasenaAdmin.php">
      <i class="bi bi-key-fill"></i>
      <span>Cambiar contraseña</span>
    </a>
  </li><!-- End F.A.Q Page Nav -->

        </ul>


</aside><!-- End Sidebar-->

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
