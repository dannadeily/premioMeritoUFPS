<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/modelos/Conexion.php';


/**
 *
 */
class CategoriaModelo extends Conexion
{

  function __construct()
  {
  }
  public function listar($id="")
  {
    if ($id=="") {
        $sql="select * from categoria" ;
    }else {

        $sql="select * from categoria where id_categoria=:id" ;
    }
    $datos=$this->conectar()->prepare($sql);
    //CORREGIR
    if ($id!='') {
      $datos->bindValue(':id', $id);
    }

    $datos->execute();

    while ($filas[]=$datos->fetch(PDO::FETCH_OBJ)) { }
    $datos->closeCursor();
    $datos=null;
    return $filas;
  }
public function estado($id,$estado)
{
    $sql="update categoria set estado=:estado where id_categoria=:id";
    $datos=$this->conectar()->prepare($sql);
    $datos->execute(array(
      ":estado"=>$estado,
      ":id"=>$id
    ));
    $datos=null;
}
public function crearCategoria($categoria=array())
{
  foreach ($categoria as $key=>$datos) {
    $$key=$datos;
    }
    $sql="insert into categoria
    (nombre,descripcion,estado,rol)values
    (:nombre,:descripcion,1,:rol)";
    $datos=$this->conectar();
    $resultado=$datos->prepare($sql);
    $resultado->execute(array(":nombre"=>$nombre,
    ":descripcion"=>$descripcion,
    ":rol"=>$rol
  ));
  $id=$datos->lastInsertId();
  $datos=null;
  return $id;
}

public function editar($categoria=array())
{
  foreach ($categoria as $key=>$datos) {
  $$key=$datos;
  }
  $sql="update categoria set nombre=:nombre, descripcion=:descripcion where id_categoria=:id";
  $datos=$this->conectar();
  $resultado=$datos->prepare($sql);
  $resultado->execute(array(
  ":id"=>$id,
  ":nombre"=>$nombre,
  ":descripcion"=>$descripcion
));
  $afectadas=$resultado->rowCount();
  $datos=null;
  return $afectadas;
}

}
