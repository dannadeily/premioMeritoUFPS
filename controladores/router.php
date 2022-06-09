<?php
if (isset($_GET["con"])) {
  $controlador = $_GET["con"];
  require_once $controlador . ".php";
  if (class_exists($controlador)) {
    $clase_contr = new $controlador();
    if (isset($_GET["fun"]) && method_exists($clase_contr, $_GET["fun"])) {
      $action = $_GET["fun"];
      $clase_contr->$action();
    } else {
?> <script type="text/javascript">
        window.location = "../index.php";
      </script>
    <?php
    }
  } else {
    ?> <script type="text/javascript">
      window.location = "../index.php";
    </script>
  <?php
  }
} else {
  ?> <script type="text/javascript">
    window.location = "../index.php";
  </script>
<?php

}

?>