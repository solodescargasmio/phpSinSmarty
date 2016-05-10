<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


    $carpeta="./"; 
      
          foreach(glob($carpeta."/*") as $archivos_carpeta)
    {             
        if (is_dir($archivos_carpeta))
        {
        }
        else
        {
            $exten=  explode(".", $archivos_carpeta);
            
            $ex=end($exten);
            if(strcmp("gz",$ex)==0){
                unlink($archivos_carpeta);
                $mensage="El respaldo se realizo con exito.";
                header("Location: principal.php?mensage=".$mensage);
        }}}
