<?php
require_once '../modelos/UsuarioModelo.php';
require '../vendor/autoload.php';

use \Mailjet\Resources;

/**
 *
 */

class UsuarioControlador
{
  private $model;
  function __construct()
  {
    $this->model = new UsuarioModelo();
  }

  public function agregarUsuario()
  {
    if (
      !empty($_POST["codigo_usuario"]) && !empty($_POST["nombre"]) && !empty($_POST["apellidos"])
      && !empty($_POST["email"]) && !empty($_POST["numero_documento"]) && !empty($_POST["contrasena"]) && !empty($_POST["rol"])
    ) {
      $contrasena = password_hash($_POST["contrasena"], PASSWORD_DEFAULT);
      $usuario = array(
        'codigo_usuario' => $_POST["codigo_usuario"],
        'nombre' => $_POST["nombre"],
        'apellidos' => $_POST["apellidos"],
        'email' => $_POST["email"],
        'tipoDocumento' => $_POST["tipoDocumento"],
        'numero_documento' => $_POST["numero_documento"],
        'contrasena' => $contrasena,
        'rol' => $_POST["rol"]
      );


      if ($this->model->agregarUsuario($usuario) > 0) {
        setcookie('exito', 'exito', time() + 3, '/');
        if ($_POST["rol"] == 'Calificador') {
          $asunto = "Ha sido registrado como calificador en premio al merito UFPS";
          $mensaje = "Su clave de acceso es " . $_POST["contrasena"];
          $destinatario = $_POST["email"];
          $this->enviarCorreo($asunto, $mensaje, $destinatario);
          header("location:../vistas/gestionarCalificadores.php");
        } else {
          header("location:../vistas/registrar.php");
        }
      } else {
        if ($_POST["rol"] == 'Calificador') {
          setcookie('error', 'error', time() + 3, '/');
          header("location:../vistas/gestionarCalificadores.php");
        } else {
          setcookie('error', 'error', time() + 3, '/');
          header("location:../vistas/registrar.php");
        }
      }
    } else {
      if ($_POST["rol"] == 'Calificador') {
        setcookie('error', 'error', time() + 3, '/');
        header("location:../vistas/gestionarCalificadores.php");
      } else {
        setcookie('error', 'error', time() + 3, '/');
        header("location:../vistas/registrar.php");
      }
    }
  }

  public function listarCalificador()
  {
    return $this->model->listarCalificador();
  }

  public function listar($codigo = '')
  {
    return $this->model->listar($codigo);
  }

  public function recuperarContrasena()
  {
    if (!empty($_POST['codigo']) || !empty($_POST['email'])) {
      $new_password = rand(99999, 999999);
      $password_encripted = password_hash($new_password, PASSWORD_DEFAULT);


      if ($this->model->recuperarContrasena($_POST['codigo'], $password_encripted, $_POST['email']) > 0) {
        $mensaje = "su nueva contraseña es: " . $new_password . " Se recomienda realizar el cambio al ingresar";
        $destinatario = $_POST["email"];
        $asunto = "contraseña ingreso premio al merito";
        $this->enviarCorreo($asunto, $mensaje, $destinatario);
        setcookie('exito', 'exito', time() + 3, '/');
        header("location:../vistas/recuperar.php");
      } else {
        setcookie('error', 'error', time() + 3, '/');
        header("location:../vistas/recuperar.php");
      }
    } else {
      setcookie('error', 'error', time() + 3, '/');
      header("location:../vistas/recuperar.php");
    }
  }


  public function iniciarSesion()
  {
    if (!empty($_POST['codigo']) || !empty($_POST['contrasena'])) {
      $usuario = $this->listar($_POST['codigo']);
      if (count($usuario) > 1 &&  password_verify($_POST["contrasena"], $usuario[0]->contrasena)) {
        session_start();
        $_SESSION['usuario'] = $_POST['codigo'];
        $_SESSION['rol'] = $usuario[0]->rol;
        $_SESSION['nombre'] = $usuario[0]->nombre . ' ' . $usuario[0]->apellidos;
        if ($_SESSION['rol'] == "Estudiante" || $_SESSION['rol'] == "Egresado") {
          header("location:../vistas/datosPersonales.php");
        } else {
          if ($_SESSION['rol'] == "administrador") {
            header("location:../vistas/historial.php");
          } else {
            if ($_SESSION['rol'] == "Calificador") {
              header("location:../vistas/calificador.php");
            }
          }
        }
      } else {
        setcookie('error', 'error', time() + 3, '/');
        header("location:../vistas/iniciar.php");
      }
    } else {
      setcookie('error', 'error', time() + 3, '/');
      header("location:../vistas/iniciar.php");
    }
  }
  public function cerrarSesion()
  {
    session_start();
    if (isset($_SESSION['usuario'])) {
      session_destroy();
    }
    header("location:../index.php");
  }
  public function editarDatos()
  {
    if (!empty($_POST['codigo_usuario']) && !empty($_POST['nombre']) && !empty($_POST['apellidos']) && !empty($_POST['email']) && !empty($_POST['numero_documento']) && !empty($_POST['tipoDocumento'])) {
      $editar = array(
        'codigo_usuario' => $_POST['codigo_usuario'],
        'nombre' => $_POST['nombre'],
        'apellidos' => $_POST['apellidos'],
        'email' => $_POST['email'],
        'numero_documento' => $_POST['numero_documento'],
        'tipoDocumento' => $_POST['tipoDocumento']
      );
      $this->model->editarDatos($editar);
      setcookie('exito', 'exito', time() + 3, '/');
    } else {
      setcookie('error', 'error', time() + 3, '/');
    }
    header("location:../vistas/datosPersonales.php");
  }
  public function cambiarContrasena()
  {
    session_start();
    $usuario = $this->listar($_SESSION["usuario"]);
    if (password_verify($_POST['actual'], $usuario[0]->contrasena) && $_POST['nueva1'] == $_POST['nueva2']) {
      $this->model->cambiarContrasena($_SESSION['usuario'], password_hash($_POST['nueva1'], PASSWORD_DEFAULT));
      setcookie('exito', 'exito', time() + 3, '/');
      if ($_SESSION['rol'] != "administrador" && $_SESSION['rol'] != "Calificador") {
        header("location:../vistas/cambiarContrasena.php?");
      } else if ($_SESSION['rol'] == "Calificador") {
        header("location:../vistas/cambiarContrasenaCalificador.php");
      } else {
        header("location:../vistas/cambiarContrasenaAdmin.php");
      }
    } else {
      setcookie('error', 'error', time() + 3, '/');
      if ($_SESSION['rol'] != "administrador") {
        header("location:../vistas/cambiarContrasena.php");
      } else {
        header("location:../vistas/cambiarContrasenaAdmin.php");
      }
    }
  }
  public function eliminar()
  {
    $this->model->eliminar($_POST['codigo']);
    setcookie('eliminada', 'eliminada', time() + 3, '/');
    header("location:../vistas/gestionarCalificadores.php");
  }

  public function enviarCorreo($asunto, $mensaje, $destinatario)
  {

    $mj = new \Mailjet\Client('9588160c4d1af70c3a75c656a83b1aeb', '437347bdb9015fb8198f0edbbb2d2376', true, ['version' => 'v3.1']);
    $body = [
      'Messages' => [
        [
          'From' => [
            'Email' => "premiomeritoufps@outlook.com",
          ],
          'To' => [
            [
              'Email' => $destinatario,
            ]
          ],
          'Subject' => $asunto,
          'TextPart' => 'Premio merito UFPS',
          'HTMLPart' => $mensaje,
          'CustomID' => "AppGettingStartedTest"
        ]
      ]
    ];
    $response = $mj->post(Resources::$Email, ['body' => $body]);
    $response->success() && var_dump($response->getData());
  }
}
