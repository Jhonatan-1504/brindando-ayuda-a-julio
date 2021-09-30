<?php

class Database
{
  private $host;
  private $driver;
  private $db;
  private $user;
  private $password;
  private $charset;

  public function __construct()
  {
    $this->host = constant('HOST');
    $this->driver = constant('DRIVER');
    $this->db = constant('DATABASE');
    $this->user = constant('USERNAME');
    $this->password = constant('PASSWORD');
    $this->charset = constant('CHARSET');
  }

  function connect()
  {
    try {
      $connection = "$this->driver:host=$this->host;dbname=$this->db;charset=$this->charset";
      $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
      ];
      $pdo = new PDO($connection,$this->user,$this->password,$options);
      return $pdo;
    } catch (PDOException $e) {
      print_r('Error: '.$e->getMessage());
    }
  }
}
