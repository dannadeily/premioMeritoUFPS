<?php
require_once '../modelos/PostuladosModelo.php';

class PostuladosControlador
{
  private $model;
  function __construct()
  {
    $this->model = new PostuladosModelo();
  }
  public function inscribir($cc)
  {

    $codigo = $_SESSION['usuario'];
    date_default_timezone_set('America/Bogota');
    $fecha = date("Y-m-d");
    $postulado = array(
      'fecha_postulacion' => $fecha,
      'id_convocatoria_categoria' => $cc,
      'codigo_usuario' => $codigo
    );
    return $this->model->inscribir($postulado);
  }
  public function listar($id = '')
  {
    return $this->model->listar($id);
  }
  public function calificar()
  {
    session_start();
    if (!empty($_POST["nota"]) && !empty($_POST["codigo"])) {

      $this->model->calificar($_POST["nota"], $_POST["codigo"]);
      setcookie('exito', 'exito', time() + 3, '/');
      if ($_SESSION['rol'] == 'administrador') {
        header("location:../vistas/calificar.php");
      } else {
        header("location:../vistas/Calificador.php");
      }
    }else{
      setcookie('error', 'error', time() + 3, '/');
      if ($_SESSION['rol'] == 'administrador') {
        header("location:../vistas/calificar.php");
      } else {
        header("location:../vistas/Calificador.php");
      }
    }
  }
}
