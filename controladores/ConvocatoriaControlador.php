<?php
require_once  '../modelos/ConvocatoriaModelo.php';
require_once  'ConvocatoriaCategoriaControlador.php';
require_once  'CategoriaControlador.php';


/**
 *
 */

class ConvocatoriaControlador
{
  private $model;
  function __construct()
  {
    $this->model = new ConvocatoriaModelo();
  }

  public function crearConvocatoria()
  {
    if (!empty($_POST["titulo"]) && !empty($_FILES["imagen"]) && !empty($_POST["descripcion"]) && !empty($_POST["fecha_inicio"]) && !empty($_POST["fecha_fin"])) {
      date_default_timezone_set('America/Bogota');
      $fecha = date("Y-m-d");
      if ($_POST["fecha_inicio"] < $_POST["fecha_fin"] && $fecha <= $_POST["fecha_inicio"]) {
        $convocatoria = array(
          'titulo' => $_POST["titulo"],
          'descripcion' => $_POST["descripcion"],
          'fecha_inicio' => $_POST["fecha_inicio"],
          'fecha_fin' => $_POST["fecha_fin"]
        );
        if ($_FILES["imagen"]["error"]) {
          setcookie('errorImagen', 'error', time() + 3, '/');
          header("location:../vistas/crearConvocatoria.php");
        } else {
          $permitidos = array("image/png", "image/jpg", "image/jpeg", "image/gif");
          $limite_kb = 5000;
          if (in_array($_FILES["imagen"]["type"], $permitidos) && $_FILES["imagen"]["size"] < $limite_kb * 1024) {
            $id = $this->model->crearConvocatoria($convocatoria);
            if ($id < 1) {
              setcookie('error', 'error', time() + 3, '/');
              header("location:../vistas/crearConvocatoria.php");
              return;
            }
            $ruta = "../vistas/imgConvocatorias/";
            $extencion = strtolower(pathinfo($_FILES["imagen"]["name"], PATHINFO_EXTENSION));
            $archivo = $ruta . $id . "." . $extencion;
            if (!file_exists($ruta)) {
              mkdir($ruta);
            }
            if (!file_exists($archivo)) {
              $resultado = @move_uploaded_file($_FILES["imagen"]["tmp_name"], $archivo);
            }
          } else {
            setcookie('tamaño', 'tamaño', time() + 3, '/');
            header("location:../vistas/crearConvocatoria.php");
          }
        }
        //crear convocatoria con las categorias activas
        $categorias = new CategoriaControlador();
        $lista = $categorias->listar();
        $listaCount = count($lista);

        $convocatoriacategoria = new ConvocatoriaCategoriaControlador();
        for ($i = 0; $i < $listaCount - 1; $i++) {
          if ($lista[$i]->estado == 1) {
            $convocatoriacategoria->agregar($lista[$i]->nombre, $id, $lista[$i]->id_categoria, $lista[$i]->rol);
          }

          if ($i == $listaCount - 2) {
            setcookie('exito', 'exito', time() + 3, '/');

            header("location:../vistas/historial.php");
          }
        }
      } else {
      setcookie('fecha', 'error', time() + 3, '/');
        header("location:../vistas/crearConvocatoria.php?msg=fechamenor");
      }
    } else {
      setcookie('error', 'error', time() + 3, '/');
      header("location:../vistas/crearConvocatoria.php");
    }
  }

  public function historial($id = "")
  {
    return $this->model->historial($id);
  }

  //terminar editar convocatorias
  public function editarConvocatoria()
  {
    if (!empty($_POST["titulo"]) && !empty($_POST["descripcion"]) && !empty($_POST["fecha_inicio"]) && !empty($_POST["fecha_fin"])) {
      date_default_timezone_set('America/Bogota');
      $fecha = date("Y-m-d");
      if ($_POST["fecha_inicio"] < $_POST["fecha_fin"] || $fecha >= $_POST["fecha_inicio"]) {
        $convocatoria = array(
          'id_convocatoria' => $_POST["id"],
          'titulo' => $_POST["titulo"],
          'descripcion' => $_POST["descripcion"],
          'fecha_inicio' => $_POST["fecha_inicio"],
          'fecha_fin' => $_POST["fecha_fin"]
        );

        $this->model->editar($convocatoria);

        if (($_FILES["imagen"]["name"] == "")) {
          setcookie('actualizada', 'exito', time() + 3, '/');
          header("location:../vistas/convocatoriaVigente.php");
          return;
        }
        if ($_FILES["imagen"]["error"]) {
          setcookie('errorImagen', 'error', time() + 3, '/');
          header("location:../vistas/convocatoriaVigente.php");
        } else {
          $permitidos = array("image/png", "image/jpg", "image/jpeg", "image/gif");
          $limite_kb = 5000;

          if (in_array($_FILES["imagen"]["type"], $permitidos) && $_FILES["imagen"]["size"] < $limite_kb * 1024) {
            $ruta = "../vistas/imgConvocatorias/";
            $extencion = strtolower(pathinfo($_FILES["imagen"]["name"], PATHINFO_EXTENSION));
            $archivo = $ruta . $_POST["id"] . "." . $extencion;
            if (!file_exists($ruta)) {
              mkdir($ruta);
            }
            if (!file_exists($archivo)) {
              $resultado = @move_uploaded_file($_FILES["imagen"]["tmp_name"], $archivo);
              if ($resultado) {
              } else {
                setcookie('errorImagen', 'error', time() + 3, '/');
                header("location:../vistas/convocatoriaVigente.php");
              }
            } else {
              $resultado = @move_uploaded_file($_FILES["imagen"]["tmp_name"], $archivo);
            }
          } else {
            setcookie('tamañoMayor', 'error', time() + 3, '/');
            header("location:../vistas/convocatoriaVigente.php");
          }
          setcookie('actualizada', 'exito', time() + 3, '/');
          header("location:../vistas/convocatoriaVigente.php");
        }
      } else {
        setcookie('fecha', 'error', time() + 3, '/');
        header("location:../vistas/convocatoriaVigente.php");
      }
    } else {
      setcookie('error', 'error', time() + 3, '/');
      header("location:../vistas/convocatoriaVigente.php");
    }
  }

  public function convocatoriasAbiertas()
  {
    date_default_timezone_set('America/Bogota');
    $hoy = date("Y-m-d");
    return ($this->model->convocatoriasAbiertas($hoy));
  }
  public function convocatoriaVigente()
  {
    date_default_timezone_set('America/Bogota');
    $hoy = date("Y-m-d");
    return ($this->model->convocatoriaVigente($hoy));
  }
  public function diasRestantes($cierre)
  {
    date_default_timezone_set('America/Bogota');
    $cierre = date('Y-m-d', strtotime($cierre . '+ 1 month'));
    $hoy = date("Y-m-d");
    $datetime1 = new DateTime("$cierre");
    $datetime2 = new DateTime("$hoy");
    $interval = $datetime1->diff($datetime2);
    return $interval->days . ' dias ';
  }
  public function informe($id)
  {
    return $this->model->informe($id);
  }
  public function ganadores($convocatoria)
  {
    return $this->model->ganadores($convocatoria);
  }
}
