<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('./clases/atributo.php');
require_once ('./clases/estudio_medico.php');
require_once ('./clases/formulario.php');  
require_once ('./clases/session.php');
require_once ('./conexion/configuracion.php');
function eliminarDirectorio($carpeta)
{    
    foreach(glob($carpeta."/*") as $archivos_carpeta)
    {  
        if (is_dir($archivos_carpeta))
        {
           
            eliminarDirectorio($archivos_carpeta);
        }
        else
        {
  
   unlink($archivos_carpeta);
        }
    }  
    rmdir($carpeta);
}

function eliminarFormulario($idf){
             Session::init();
    $id_user=Session::get('cedula');
    $id_estudio= Session::get("estudio");
    $carpeta="./multimedia/".$id_user."/".$id_estudio;
  $attr=new atributo();
    $attribu=$attr->traerAtributosFormFile($idf);
         foreach ($attribu as $key => $value) {
           $nombre=$value->getNombre();       
    foreach(glob($carpeta."/*") as $archivos_carpeta)
    { 
         
        if (is_dir($archivos_carpeta))
        { 
        }
        else
        {
     $exten=explode(".",$archivos_carpeta);
            $nom=  explode("/", $exten[1]);
            $nomb=end($nom);
            
            if(strcmp($nomb,$nombre)==0){ 
         unlink($archivos_carpeta);
            }
        }
    }exit();
 
}
}




function eliminarArchivo($idf){
             Session::init();
    $id_user=Session::get('cedula');
    $id_estudio= Session::get("estudio");
    $carpeta="./multimedia/".$id_user."/".$id_estudio;
  $attr=new atributo();
    $attribu=$attr->traerAtributosFormFile($idf);
  
         foreach ($attribu as $key => $value) {
           $nombre=$value->getNombre();   
       if(isset($_FILES[$nombre])){     
    foreach(glob($carpeta."/*") as $archivos_carpeta)
    { 
         
        if (is_dir($archivos_carpeta))
        { 
            eliminarA();
        }
        else
        {
     $exten=explode(".",$archivos_carpeta);
            $nom=  explode("/", $exten[1]);
            $nomb=end($nom);
            if(strcmp($nomb,$nombre)==0){  
         unlink($archivos_carpeta);
            }
        }
    }
 
}}
 
    $directorio = dirname(__FILE__).'/'.$id_user.'/'.$id_estudio;

$serv =dirname(__FILE__).'/'.$id_user.'/'.$id_estudio.'/';

  $exten=explode(".",$_FILES[$nombre]['name']);
        $ex=end($exten);
        $var=$nombre.'.'.$ex;
  //$ruta=$serv.$_FILES[$nombre]['name'][$i];
      
  	// Primero creamos un ID de conexión a nuestro servidor
	$cid = ftp_connect(FTP_HOST);
	// Luego creamos un login al mismo con nuestro usuario y contraseña
	$resultado = ftp_login($cid, FTP_USR,FTP_PASS);
	// Comprobamos que se creo el Id de conexión y se pudo hacer el login
	if ((!$cid) || (!$resultado)) {
		echo "Fallo en la conexión"; die;
	}
	// Cambiamos a modo pasivo, esto es importante porque, de esta manera le decimos al 
	//servidor que seremos nosotros quienes comenzaremos la transmisión de datos.
	ftp_pasv ($cid, true) ;
	// Nos cambiamos al directorio, donde queremos subir los archivos, si se van a subir a la raíz
	// esta por demás decir que este paso no es necesario. 
	ftp_chdir($cid, $id_user);
	// Tomamos el nombre del archivo a transmitir, pero en lugar de usar $_POST, usamos $_FILES que le indica a PHP
	// Que estamos transmitiendo un archivo, esto es en realidad un matriz, el segundo argumento de la matriz, indica
	// el nombre del archivo
	$local =$var;
        
	// Este es el nombre temporal del archivo mientras dura la transmisión
	$remoto = $_FILES[$nombre]["tmp_name"];
       
	// Juntamos la ruta del servidor con el nombre real del archivo
	$ruta = $serv.$local;
        
		// Verificamos si ya se subio el archivo temporal
		if (is_uploaded_file($remoto)){

                       //guardamos nombre en base de datos        
                  if(strcasecmp($ex, "jpeg")==0){
            $newpng =$value->getNombre().'.png'; 
             $png = imagepng(imagecreatefromjpeg($_FILES[$nombre]['tmp_name']), $newpng);
             $ruta = $serv.$newpng;
             copy($remoto, $ruta);
             $ex="png";
                  }else
                    if(strcasecmp($ex, "jpg")==0){
               $newpng =$value->getNombre().'.png'; 
             $png = imagepng(imagecreatefromjpeg($_FILES[$nombre]['tmp_name']), $newpng);
             $ruta = $serv.$newpng;
             copy($remoto, $ruta);
             $ex="png";
                  }else
                   if(strcasecmp($ex, "gif")==0){
             $newpng =$value->getNombre().'.png'; 
             $png = imagepng(imagecreatefromgif($_FILES[$nombre]['tmp_name']), $newpng);
             $ruta = $serv.$newpng;
             copy($remoto, $ruta);
             $ex="png";    
             }else
                         if(strcasecmp($ex, "bmp")==0){
             $newpng =$value->getNombre().'.png'; 
             $png = imagepng(imagecreatefromwbmp($_FILES[$nombre]['tmp_name']), $newpng);
             $ruta = $serv.$png;
             copy($remoto, $ruta);
             $ex="png";           
                         }else
      if(strcmp($ex,"avi")==0||strcmp($ex,"mp4")==0||strcmp($ex,"wmv")==0||strcmp($ex,"mkv")==0||strcmp($ex,"3gp")==0){
//var_dump("dentro del if");exit();            
 $newpng=$value->getNombre().".".$ex;
 
                                copy($remoto, $ruta);  
         $video=exec("ffmpeg -i ".$remoto." -ss 00:00:00 -t 00:01:00 -async 1 ./multimedia/$id_user/$id_estudio/".$value->getNombre().".webm");
                
 //  exec("ffmpeg -i ".$remoto." -vcodec copy -ss 1 -t 120 -acodec ".$varia.".webm 2>&1"); 
          $ruta = $serv.$video; 
         copy($remoto, $ruta);
         }else{
             $newpng=$var;
             copy($remoto, $ruta);
         }
         ////-vcodec copy -ss 1 -t 120 -acodec //corta los videos
                          //  exec("ffmpeg -i ".$remoto." ./multimedia/$id_user/".$varia.".webm 2>&1");
                // copiamos el archivo temporal, del directorio de temporales de nuestro servidor a la ruta que creamos	  
//                        $archivo->setId_usuario($id_user);
//                        $archivo->setNombre($varia);
//                        $archivo->setExtension($ex);
//                        //////////////////////////////////////////////////

                    ///////////////////////////////////////////////////////  
		}
		// Sino se pudo subir el temporal
		else {
			echo "no se pudo subir el archivo " . $local;
		}
	//}
	//cerramos la conexión FTP
	ftp_close($cid);
        
                }


