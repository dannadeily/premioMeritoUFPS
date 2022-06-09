<?php
class Conexion
{

  public  static  function conectar()
  {
    try {


      $base=new PDO('mysql:host=localhost;dbname=id16390081_premio','id16390081_dga','*ohj{bk4a*y\3rIN');
        $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
     $base->exec("SET CHARACTER SET UTF8");

    } catch (Exception $e) {
    echo ($e->getLine());
   echo(  die($e->getMessage()));

    }
  return $base;
  }
}




 ?>
