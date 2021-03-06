<?php
require_once '../modelos/CategoriaModelo.php';


/**
 *
 */

class CategoriaControlador
{
  private $model;
  function __construct()
  {
    $this->model = new CategoriaModelo();
  }

  public function listar($id = "")
  {
    return $this->model->listar($id);
  }
  public function estado()
  {
    if ($_GET["estado"] == 0) {
      $this->model->estado($_GET["id"], 1);
    } else {
      $this->model->estado($_GET["id"], 0);
    }
    header("location:../vistas/seleccionarCategoria.php");
  }
  public function crearCategoria()
  {
    if (!empty($_POST["nombre"]) && !empty($_POST["rol"]) && !empty($_POST["descripcion"])) {
      $categoria = array(
        'nombre' => $_POST["nombre"],
        'descripcion' => $_POST["descripcion"],
        'rol' => $_POST['rol']
      );
      if ($this->model->crearCategoria($categoria) > 0) {
        setcookie('exito', 'exito', time() + 3, '/');
        header("location:../vistas/seleccionarCategoria.php");
      } else {
        setcookie('error', 'error', time() + 3, '/');
        header("location:../vistas/crearCategoria.php");
      }
    } else {
      setcookie('error', 'error', time() + 3, '/');
      header("location:../vistas/crearCategoria.php");
    }
  }

  public function editar()
  {
    if (!empty($_POST["nombre"]) && !empty($_POST["descripcion"])) {
      $categoria = array(
        'id' => $_POST["id"],
        'nombre' => $_POST["nombre"],
        'descripcion' => $_POST["descripcion"]
      );


      if ($this->model->editar($categoria) > 0) {
        setcookie('actualizada', 'exito', time() + 3, '/');
        header("location:../vistas/seleccionarCategoria.php");
      } else {
        setcookie('error', 'error', time() + 3, '/');
        header("location:../vistas/seleccionarCategoria.php");
      }
    } else {
      setcookie('error', 'error', time() + 3, '/');
      header("location:../vistas/seleccionarCategoria.php");
    }
  }
}
