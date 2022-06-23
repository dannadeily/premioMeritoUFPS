<?php
require_once '../modelos/DocumentoModelo.php';
require_once 'PostuladosControlador.php';

/**
 *
 */

class DocumentoControlador
{
  private $model;
  function __construct()
  {
    $this->model = new DocumentoModelo();
  }

  public function listar($id = '')
  {
    return $this->model->listar($id);
  }

  public function guardarDocumento()
  {
    if (!empty($_POST['nombre']) && !empty($_POST['descripcion'])) {
      $documentos = array(
        'id_categoria' => $_POST['id'],
        'nombre' => $_POST['nombre'],
        'descripcion' => $_POST['descripcion']
      );
      $this->model->guardarDocumento($documentos);
      setcookie('Documentoexito', 'exito', time() + 3, '/');
      header("location:../vistas/DocumentosCategoria.php?id=" . $_POST['id'] );
    } else {
      setcookie('error', 'error', time() + 3, '/');
      header("location:../vistas/DocumentosCategoria.php?id=" . $_POST['id'] );
    }
  }

  public function borrarDocumento()
  {

    if (!empty($_GET['idDoc']) && !empty($_GET['id'])) {
      $this->model->borrarDocumento($_GET['idDoc']);
      setcookie('borrado', 'borrado', time() + 3, '/');
      header("location:../vistas/DocumentosCategoria.php?id=" . $_GET['id'] );
    } else {
      setcookie('error', 'error', time() + 3, '/');
      header("location:../vistas/DocumentosCategoria.php?id=" . $_GET['id'] );
    }
  }
  public function guardarArchivo()
  {
    $postulado = new PostuladosControlador();
    session_start();
    $codigo = $_SESSION['usuario'];
    $permitidos = "application/pdf";
    $limite_kb = 5000;
    $i = 0;
    foreach ($_FILES as $archivo => $atributo) {
      if ($atributo["size"] > $limite_kb * 1024 || $atributo["type"] != $permitidos) {
        setcookie('error', 'error', time() + 3, '/');
        header("location:../vistas/inscripciones.php");
        return;
      }
    }
    foreach ($_FILES as $archivo => $atributo) {
      if ($atributo["type"] == $permitidos && $atributo["size"] < $limite_kb * 1024) {
        $ruta = "../documentos/" . $_GET["co"] . "/";
        if (!file_exists($ruta)) {
          mkdir($ruta);
        }
        $ruta .= $_GET["cat"] . "/";
        if (!file_exists($ruta)) {
          mkdir($ruta);
        }
        $ruta .= $codigo . "/";
        if (!file_exists($ruta)) {
          mkdir($ruta);
        }
        $extencion = strtolower(pathinfo($atributo["name"], PATHINFO_EXTENSION));
        $archivo = $ruta . $archivo . "." . $extencion;
        if (!file_exists($archivo)) {
          $resultado = move_uploaded_file($atributo["tmp_name"], $archivo);
        }
        $postulado->inscribir($_GET["cc"]);
        setcookie('exito', 'exito', time() + 3, '/');
        header("location:../vistas/inscripciones.php");
      }
    }
  }


  public function buscar($id)
  {
    return $this->model->buscar($id);
  }

  public function editar()
  {
    if (!empty($_POST["id"] && !empty($_POST["nombre"]) && !empty($_POST["descripcion"]))) {
      $documento = array(
        'nombre' => $_POST["nombre"],
        'descripcion' => $_POST["descripcion"],
        'id' => $_POST["id"]
      );
      $this->model->editar($documento);
      setcookie('documentoActualizado', 'exito', time() + 3, '/');
      header("location:../vistas/seleccionarCategoria.php");
    } else {
      setcookie('error', 'error', time() + 3, '/');
      header("location:../vistas/seleccionarCategoria.php?msg=incompletos");
    }
  }
}
