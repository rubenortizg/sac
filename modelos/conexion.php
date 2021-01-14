<?php

class Conexion {

  static public function conectar(){

    $link = new PDO("mysql:host=localhost;dbname=ruddorco_sac","ruddorco_sac","disturbio2006");

    $link->exec("set names utf8");

    return $link;
  }
}
