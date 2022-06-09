<?php

require_once 'Conexion.php';


/**
 *
 */
class ConvocatoriaCategoriaModelo extends Conexion
{

  function __construct()
  {
  }

  public function agregar($nombre,$id_convocatoria,$id_categoria,$rol)
  {
      $sql="insert into categoria_convocatoria
      (nombre,id_convocatoria,id_categoria,rol)
      SELECT
      :nombre,:id_convocatoria,:id_categoria,:rol
      FROM dual
      WHERE NOT EXISTS (select * from categoria_convocatoria
      where id_categoria=:id_categoria and id_convocatoria=:id_convocatoria)
      LIMIT 1
      ";
      $datos=$this->conectar();
      $resultado=$datos->prepare($sql);
      $resultado->execute(array(":nombre"=>$nombre,
      ":id_convocatoria"=>$id_convocatoria,
      ":id_categoria"=>$id_categoria,
      ":rol"=>$rol
    ));
    $id=$datos->lastInsertId();
    $datos=null;
    return $id;
  }
  public function listar($id_convocatoria)
  {
 $sql="select * from categoria_convocatoria
      where id_convocatoria=:id_convocatoria" ;
    $datos=$this->conectar()->prepare($sql);
    $datos->execute(array(":id_convocatoria"=>$id_convocatoria));
    while ($filas[]=$datos->fetch(PDO::FETCH_OBJ)) {

      }
    $datos->closeCursor();
    $datos=null;
    return $filas;
  }
  public function buscar($id)
  {
    $sql="select * from categoria_convocatoria where id=:id";
    $datos=$this->conectar()->prepare($sql);
    $datos->execute(array(":id"=>$id));
    $informacion=$datos->fetch(PDO::FETCH_OBJ);
    $datos = null;
    return $informacion;
  }
}
