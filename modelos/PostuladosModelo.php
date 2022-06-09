<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/modelos/Conexion.php';


/**
 *
 */
class PostuladosModelo extends Conexion
{

  function __construct()
  {
  }

  public function inscribir($postulado = array())
  {
    foreach ($postulado as $key=>$datos) {
      $$key=$datos;
      }

      $sql="insert into postulacion
      (fecha_postulacion,id_convocatoria_categoria,codigo_usuario) SELECT
      :fecha_postulacion,:id_convocatoria_categoria,:codigo_usuario
      FROM dual
      WHERE NOT EXISTS (select * from postulacion
      where id_convocatoria_categoria=:id_convocatoria_categoria && codigo_usuario=:codigo_usuario)
      LIMIT 1
      ";
      $datos=$this->conectar()->prepare($sql);
      $datos->execute(array(":id_convocatoria_categoria"=>$id_convocatoria_categoria,
      ":fecha_postulacion"=>$fecha_postulacion,
      ":codigo_usuario"=>$codigo_usuario));
      $count= $datos->rowcount();
      $datos=null;
      return $count;
  }
  public function listar($id='')
  {
    if ($id=='') {
      $sql="select * from postulacion";
    }else {
      $sql="select DISTINCT p.*,  cc.nombre,c.titulo from postulacion AS p join categoria_convocatoria as cc join convocatoria as c
      WHERE p.id_convocatoria_categoria=cc.id and cc.id_convocatoria=c.id_convocatoria  AND p.codigo_usuario=:id";
    }
    $datos=$this->conectar()->prepare($sql);
    if ($id!='') {
    $datos->bindValue(':id', $id);
    }
    $datos->execute();

    while ($filas[]=$datos->fetch(PDO::FETCH_OBJ)) { }
    $datos->closeCursor();
    $datos=null;
    return $filas;
  }
  public function calificar($nota,$codigo)
  {
    $sql="update postulacion set calificacion=:nota WHERE codigo_usuario=:codigo";
    $datos=$this->conectar()->prepare($sql);
    $datos->bindValue(':nota', $nota);
    $datos->bindValue(':codigo', $codigo);
    $datos->execute();
    $datos=null;
  }
  }
?>
