<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/modelos/ConvocatoriaModelo.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controladores/ConvocatoriaCategoriaControlador.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controladores/CategoriaControlador.php';


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
          header("location:../vistas/modulo/crearConvocatoria.php?msg=errorimagen");
        } else {
          $permitidos = array("image/png", "image/jpg", "image/jpeg", "image/gif");
          $limite_kb = 5000;
          if (in_array($_FILES["imagen"]["type"], $permitidos) && $_FILES["imagen"]["size"] < $limite_kb * 1024) {
            $id = $this->model->crearConvocatoria($convocatoria);
            if ($id < 1) {
              header("location:../vistas/modulo/crearConvocatoria.php?msg=incompletos");
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
            header("location:../vistas/modulo/crearConvocatoria.php?msg=tamañomayor");
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
            header("location:../vistas/modulo/historial.php?msg=registrado");
          }
        }
      } else {
        header("location:../vistas/modulo/crearConvocatoria.php?msg=fechamenor");
      }
    } else {
      header("location:../vistas/modulo/crearConvocatoria.php?msg=incompletos");
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
          header("location:../vistas/modulo/historial.php?msg=actualizado");
          return;
        }
        if ($_FILES["imagen"]["error"]) {
          header("location:../vistas/modulo/editarConvocatoria.php?id=" . $_POST['id'] . "&&msg=errorimagen");
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
                header("location:../vistas/modulo/editarConvocatoria.php?id=" . $_POST['id'] . "&&msg=errorimagen");
              }
            } else {
              $resultado = @move_uploaded_file($_FILES["imagen"]["tmp_name"], $archivo);
            }
          } else {
            header("location:../vistas/modulo/editarConvocatoria.php?id=" . $_POST['id'] . "&&msg=tamañomayor");
          }
          header("location:../vistas/modulo/convocatoriaVigente.php?msg=actualizado");
        }
      } else {
        header("location:../vistas/modulo/editarConvocatoria.php?id=" . $_POST['id'] . "&&msg=fechamenor");
      }
    } else {
      header("location:../vistas/modulo/editarConvocatoria.php?id=" . $_POST['id'] . "&&msg=incompletos");
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
