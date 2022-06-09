<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/modelos/Conexion.php';


/**
 *
 */
class ConvocatoriaModelo extends Conexion
{

  function __construct()
  {
  }

  public function crearConvocatoria($convocatoria=array())
  {
    foreach ($convocatoria as $key=>$datos) {
      $$key=$datos;
      }
      $sql="insert into convocatoria
      (titulo,descripcion,fecha_inicio,fecha_fin)values
      (:titulo,:descripcion,:fecha_inicio,:fecha_fin)";
      $datos=$this->conectar();
      $resultado=$datos->prepare($sql);
      $resultado->execute(array(":titulo"=>$titulo,
      ":descripcion"=>$descripcion,
      ":fecha_inicio"=>$fecha_inicio,
      ":fecha_fin"=>$fecha_fin
    ));
    $id=$datos->lastInsertId();
    $datos=null;
    return $id;
  }

  public function historial($id="")
  {
    if($id==""){
    $sql="select * from convocatoria order by id_convocatoria desc";
  }else {
    $sql="select * from convocatoria where id_convocatoria=$id";
  }
    $datos=$this->conectar()->prepare($sql);
    $datos->execute();
    while ($filas[]=$datos->fetch(PDO::FETCH_OBJ)) {
    }
    $datos->closeCursor();
    $datos=null;
    return $filas;
  }

  public function editar($convocatoria=array())
  {
    foreach ($convocatoria as $key=>$datos) {
      $$key=$datos;
      }
    $sql="update convocatoria set titulo=:titulo,descripcion=:descripcion,fecha_inicio=:fecha_inicio,fecha_fin=:fecha_fin
    where  id_convocatoria=:id_convocatoria";
    $datos=$this->conectar()->prepare($sql);
    $datos->execute(array(
      ":id_convocatoria"=>$id_convocatoria,
      ":titulo"=>$titulo,
      ":descripcion"=>$descripcion,
      ":fecha_inicio"=>$fecha_inicio,
      ":fecha_fin"=>$fecha_fin
      ));
      $count=$datos->rowCount();
      $datos=null;
      return $count;
  }

  public function convocatoriaVigente($fecha)
  {

    $sql="SELECT * FROM convocatoria WHERE '$fecha' <= fecha_fin";
    $datos=$this->conectar()->prepare($sql);
    $datos->execute();
    while ($filas[]=$datos->fetch(PDO::FETCH_OBJ)) {
    }
    $datos->closeCursor();
    $datos=null;
    return $filas;
  }
  public function convocatoriasAbiertas($fecha)
  {

    $sql="SELECT * FROM convocatoria WHERE '$fecha' between fecha_inicio and fecha_fin";
    $datos=$this->conectar()->prepare($sql);
    $datos->execute();
    while ($filas[]=$datos->fetch(PDO::FETCH_OBJ)) {
    }
    $datos->closeCursor();
    $datos=null;
    return $filas;
  }
  public function informe($id)
  {
    $sql="select  p.*, u.nombre AS nombres, u.* , cc.nombre,c.titulo from postulacion AS p join categoria_convocatoria as cc join convocatoria as c join usuario as u
    WHERE p.id_convocatoria_categoria=cc.id and cc.id_convocatoria=c.id_convocatoria  AND p.codigo_usuario=u.codigo_usuario and c.id_convocatoria=:id
    ORDER BY `cc`.`nombre` ASC,u.nombre ASC, u.rol asc";
    $datos=$this->conectar()->prepare($sql);
    $datos->bindValue(":id",$id);
    $datos->execute();
    while ($filas[]=$datos->fetch(PDO::FETCH_OBJ)) {
    }
    $datos->closeCursor();
    $datos=null;
    return $filas;
  }
  public function ganadores($convocatoria)
  {
    $sql="select  MAX(p.calificacion),p.*, u.nombre AS nombres, u.* , cc.nombre,c.titulo from postulacion AS p join categoria_convocatoria as cc join convocatoria as c join usuario as u
    WHERE p.id_convocatoria_categoria=cc.id and cc.id_convocatoria=c.id_convocatoria  AND p.codigo_usuario=u.codigo_usuario and c.id_convocatoria=:id_convocatoria

    GROUP BY p.id_convocatoria_categoria
     ORDER BY `cc`.`id` ASC,u.nombre ASC, u.rol asc";
     $datos=$this->conectar()->prepare($sql);
     $datos->bindValue(":id_convocatoria",$convocatoria);
     $datos->execute();
     while ($filas[]=$datos->fetch(PDO::FETCH_OBJ)) {
     }
     $datos->closeCursor();
     $datos=null;
     return $filas;
  }
}

 ?>
