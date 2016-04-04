<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of conectar
 *
 * @author Yo
 */
require 'configuracion.php';
class conectar {
   public static function realizarConexion(){
        $localhost=DB_HOST;
        $root=DB_USR;
        $pass=DB_PASS;
        $db=DB_DB;
          $conexion =mysqli_connect($localhost,$root,$pass,$db)or die("Error al conectar");
          mysqli_set_charset($conexion,"utf8");
           return $conexion;
      }
     
}
