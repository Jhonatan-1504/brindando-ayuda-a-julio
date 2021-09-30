<?php

class Model
{
  private $db, $array, $where, $table;

  function __construct($table)
  {
    $conexion = new Database();
    $this->db = $conexion->connect();
    $this->table = $table;
  }

  /*--------------------------------------------*/
  /* HELPER */
  /*--------------------------------------------*/

  /* convertira cualquier resultado en array */
  public function convertArray($PDOResult)
  {
    while ($row = $PDOResult->fetch(PDO::FETCH_ASSOC)) {
      $this->array[] = $row;
    }
    return $this->array;
  }

  public function GenerateId($longitud = 12)
  {
    $pattern = '1234567890ABCDEFGHIJKLMNOPQRSTUSWXYZ';
    return substr(str_shuffle($pattern), 0, $longitud);
  }

  function Interogation($array){
    $sentencia = [];
    foreach($array as $value){
      array_push($sentencia,'?');
    }
    return implode(',',$sentencia);
  }


  /* es importante si quieres ser expecifico */

  public function Where($key, $value)
  {
    $this->where = "WHERE $key = '$value'";
  }

  /*--------------------------------------------*/
  /* SENTENCIAS */
  /*--------------------------------------------*/

  /* si quieres hacer en especifico */
  public function query($query)
  {
    $result = $this->db->query($query);
    $result->execute();
    return $result;
  }

  public function ResetIncrement()
  {
    $result = $this->query("ALTER TABLE $this->table AUTO_INCREMENT = 1");
    if ($result) return array(["msg" => 'Reiniciado']);
  }

  /* te devolvera todos tus datos de tu tabla */
  public function All()
  {
    $query = "SELECT * FROM $this->table";
    $result = $this->query($query);
    return $this->convertArray($result);
  }

  /* tendras q enviarle un array */
  public function Created($array)
  {
    if (!$array) return 'Importante un array';
    if (!is_array($array)) return 'No es un array';
    if (!count($array)) return 'No hay datos';

    $keys = implode(",", (array_keys($array)));
    $values = array_values($array);
    $question = $this->Interogation($array);
    $query = "INSERT INTO $this->table ($keys) VALUES ($question)";
    $result = $this->db->prepare($query);
    $result->execute($values);

    if ($result) return array(["msg" => 'agregado'], ["data" => $array]);
  }

  public function Updated($array)
  {
    if (!$array) return 'Importante un array';
    if (!is_array($array)) return 'No es un array';
    if (!count($array)) return 'No hay datos';
    if (!$this->where) return 'Usa el where para asignar tu condicion';

    $mykey = array();
    foreach ($array as $clave => $value) {
      array_push($mykey, "$clave = '$value'");
    }

    $query = "UPDATE $this->table SET " . implode(',', $mykey) . " $this->where";
    $result = $this->db->prepare($query);
    $result->execute();

    if ($result) return array(["msg" => 'actualizado'], ["data" => $array]);
  }

  public function Delete()
  {
    if (!$this->where) return 'Usa el where para asignar tu condicion';

    $query = "DELETE FROM $this->table $this->where";
    $result = $this->db->prepare($query);
    $result->execute();

    if ($result) return array(["msg" => "eliminado"]);
  }
}
