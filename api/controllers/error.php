<?php

class Errors extends Controller
{
  function __construct()
  {
    parent::__construct('');
    echo json_encode(["msg" => "no existe el controlador"]);
  }
}
