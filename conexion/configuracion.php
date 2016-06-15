<?php
// configuracion de la Base de Datos en phpmyadmin
	define("DB_HOST", "localhost");//servidor
	define("DB_USR", "root");//usuario del server
	define("DB_PASS", "");//pass: yo no uso
	define("DB_DB", "phpfinal");//nombre BD
  
 //a continuacion configuracion de Servidor FTP : es obligatoria.         
        define("FTP_HOST", "localhost");//servidor
	define("FTP_USR", "pico");//usuario del server
	define("FTP_PASS", "");//pass: yo no uso
        
        
 //correo para el olvido de contraseña (correo que se usa para enviar, debe ser gmail)
        define("Email_HOST",'smtp.gmail.com');
        define("Email",'Aca su mail');
        define("Epass", 'Aca la pass de su mail');
        
//rutas para las carpetas (Aca se generan las carpetas que guardan los videos, imagenes, ect.)       
define("Ruta","./multimedia");      


?>