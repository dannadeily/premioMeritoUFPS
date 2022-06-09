<?php
class Conexion
{

  public  static  function conectar()
  {
    try {


      $base=new PDO('mysql:host=dbsys.caqahtaoxp6d.us-east-2.rds.amazonaws.com;dbname=premio','root','ADREANsharick13-');
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
