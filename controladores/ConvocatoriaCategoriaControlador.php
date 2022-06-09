<?php
require_once '../modelos/ConvocatoriaCategoriaModelo.php';


/**
 *
 */

class ConvocatoriaCategoriaControlador
{
  private $model;
  function __construct()
  {
    $this->model=new ConvocatoriaCategoriaModelo();
  }

  public function agregar($nombre,$id_categoria,$id_convocatoria,$rol)
  {
      return $this->model->agregar($nombre,$id_categoria,$id_convocatoria,$rol);
    }
    public function listar($id)
    {
      return $this->model->listar($id);
    }
    public function buscar($id)
    {
      return $this->model->buscar($id);
    }
}
