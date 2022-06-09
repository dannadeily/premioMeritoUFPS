<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/modelos/PostuladosModelo.php';

class PostuladosControlador
{
  private $model;
  function __construct()
  {
    $this->model=new PostuladosModelo();
  }
  public function inscribir($cc)
  {

    $codigo=$_SESSION['usuario'];
    date_default_timezone_set('America/Bogota');
    $fecha=date("Y-m-d");
    $postulado = array('fecha_postulacion' =>$fecha,
    'id_convocatoria_categoria'=>$cc,
    'codigo_usuario'=>$codigo
   );
   return $this->model->inscribir($postulado);
  }
public function listar($id='')
{
  return $this->model->listar($id);
}
public function calificar()
{
  if (!empty($_POST["nota"])&&!empty($_POST["codigo"])) {
    $this->model->calificar($_POST["nota"],$_POST["codigo"]);
  }
  header("location:../vistas/modulo/calificar.php?msg=calificacion");
}

}
?>
