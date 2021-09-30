<?php

class Aulas extends Controller
{
  function __construct()
  {
    parent::__construct('aulas');
  }

  function Index()
  {
    echo json_encode($this->model->All());
  }

  function Crear()
  {
    $array = [
      "aula" => $this->request->aula,
      "seccion" => $this->request->seccion,
    ];

    echo json_encode($this->model->Created($array));
  }

  function Actualizar($params = null)
  {
    $id = $params[0];

    $array = [
      "aula" => $this->request->aula,
      "seccion" => $this->request->seccion,
    ];

    $this->model->Where('id', $id);
    echo json_encode($this->model->Updated($array));
  }

  function Borrar($params = null)
  {
    $id = $params[0];
    $this->model->Where('id', $id);
    echo json_encode($this->model->Delete());
  }
}
