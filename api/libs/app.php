<?php
class App
{

  function __construct()
  {
    $url = isset($_GET['url']) ? $_GET['url'] : null;
    $url = rtrim($url, '/');
    $url = explode('/', $url);

    if (empty($url[0])) {
      return false;
    }

    $fileController = 'controllers/' . $url[0] . '.php';

    if (file_exists($fileController)) {
      require_once $fileController;
      $controller = new $url[0];
      // solo si quieres usar load de forma manual
      
      $nparams = sizeof($url);

      if($nparams>1){
        if($nparams > 2){
          $param = [];
          for ($i=2; $i < $nparams; $i++) { 
            array_push($param,$url[$i]);
          }
          $controller->{$url[1]}($param);
        }else{
          //Metodo o Funcion
          $controller->{$url[1]}();
        }
      }else{
        $controller->Index();
      }

    } else {
      require_once "./controllers/error.php";
      $controller = new Errors();
    }
  }
}
