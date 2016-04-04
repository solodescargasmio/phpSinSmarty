<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function crearDir($id) {
   $ruta=dirname(__FILE__).'/'.$id;
   //var_dump($ruta);exit();
            if (!file_exists($ruta)) {  
    mkdir($ruta, 0777, true);   
//    header('Location: index.php');
}
}
