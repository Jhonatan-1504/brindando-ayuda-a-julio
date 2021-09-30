<?php

class Controller{
  function __construct($table)
  {
    $this->model = new Model($table);
    $this->request = json_decode(file_get_contents("php://input"));
  }
}