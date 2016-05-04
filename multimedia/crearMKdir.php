<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('./conexion/configuracion.php');
function crearDir($id) {
   $ruta=Ruta.'/'.$id;
   //var_dump($ruta);exit();
            if (!file_exists($ruta)) {  
    mkdir($ruta, 0777,true)or die('Fallo al crear el directorio'); 
  
//    header('Location: index.php');
}
}
