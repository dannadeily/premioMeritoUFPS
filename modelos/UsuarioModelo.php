<?php
require_once 'Conexion.php';

/**
 *
 */
class UsuarioModelo extends Conexion
{

  function __construct()
  {
  }

  public function agregarUsuario($usuario = array())
  {
    foreach ($usuario as $key=>$datos) {
      $$key=$datos;
      }

      $sql="insert into usuario
      (codigo_usuario,nombre,apellidos,email,contrasena,
      tipoDocumento,numero_documento,rol) SELECT
      :codigo_usuario,:nombre,:apellidos,:email,:contrasena,
      :tipoDocumento,:numero_documento,:rol
      FROM dual
      WHERE NOT EXISTS (select * from usuario
      where codigo_usuario=:codigo_usuario or email=:email or
      numero_documento=:numero_documento )
      LIMIT 1
      ";
      $datos=$this->conectar()->prepare($sql);
      $datos->execute(array(":codigo_usuario"=>$codigo_usuario,
      ":nombre"=>$nombre,
      ":apellidos"=>$apellidos,
      ":email"=>$email,
      ":contrasena"=>$contrasena,
      ":tipoDocumento"=>$tipoDocumento,
      ":numero_documento"=>$numero_documento,
      "rol"=>$rol));
      $datos->closeCursor();
      $count= $datos->rowcount();
      $datos=null;
      return $count;
  }

  public function listar($codigo_usuario='')
  {
    if ($codigo_usuario=='') {
      $sql="select * from usuario";
    }else {
      $sql="select * from usuario where codigo_usuario=:codigo_usuario" ;
   }
    $datos=$this->conectar()->prepare($sql);
    $datos->execute(array(":codigo_usuario"=>$codigo_usuario));
    while ($filas[]=$datos->fetch(PDO::FETCH_OBJ)) {

      }
    $datos->closeCursor();
    $datos=null;
    return $filas;
  }

  public function recuperarContrasena($codigo_usuario,$contrasena,$email)
  {

    $sql="update usuario set contrasena=:contrasena where codigo_usuario=:codigo_usuario and email=:email";
    $datos=$this->conectar()->prepare($sql);
    $datos->bindValue(':codigo_usuario', $codigo_usuario);
    $datos->bindValue(':contrasena' ,$contrasena);
    $datos->bindValue(':email' ,$email);
    $datos->execute();
    $afectadas=$datos->rowCount();
      $datos=null;
    return $afectadas;
  }
  public function editarDatos($usuario=array())
  {
    foreach ($usuario as $key=>$datos) {
      $$key=$datos;
      }
    $sql="update usuario set nombre=:nombre,
    apellidos=:apellidos,
    numero_documento=:numero_documento,
    tipoDocumento=:tipoDocumento,
    email=:email
    where codigo_usuario=:codigo_usuario";
      $datos=$this->conectar()->prepare($sql);
    $datos->execute(array(":email"=>$email,
    ":nombre"=>$nombre,
    ":apellidos"=>$apellidos,
    ":numero_documento"=>$numero_documento,
    ":tipoDocumento"=>$tipoDocumento,
    ":codigo_usuario"=>$codigo_usuario
    ));
    $datos=null;
  }
  public function cambiarContrasena($codigo,$contrasena)
  {
  $sql="update usuario set contrasena=:contrasena where codigo_usuario=:codigo_usuario";
  $datos=$this->conectar()->prepare($sql);
$datos->execute(array(":contrasena"=>$contrasena,
":codigo_usuario"=>$codigo));
$datos=null;
  }

}



 ?>
