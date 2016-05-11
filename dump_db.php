<?php
/*
Copyright 2005 � insidephp@gmail.com

Se otorga el permiso para copiar, distribuir, y/o modificar este programa bajo los t�rminos 
de la Licencia GNU de Documentaci�n Libre (GFDL, GNU Free Documentation License) versi�n 2 
o posteriores publicadas por la Fundaci�n Software Libre (FSF, Free Software Foundation).

Seg�n esta licencia, cualquier trabajo derivado de esta documentaci�n deber� ser notificado 
al autor, aunque la voluntad del mismo es otorgar la m�xima libertad posible. 

Este programa se distribuye con la intenci�n de ser �til, pero SIN NINGUNA GARANT�A; incluso 
sin la garant�a impl�cita de USABILIDAD o UTILIDAD PARA UN FIN PARTICULAR. Vea la Licencia 
P�blica General GNU para m�s detalles.

Soporte y Updaters: http://insidephp.sytes.net
email: insidephp@gmail.com
*/
//------------------------------------------------------------------------------------------
//  Definiciones
header('Content-Type: text/html; charset=iso-8859-1');

	//  Conexi�n con la Base de Datos.
	require_once ('./conexion/configuracion.php');
	$db_server= DB_HOST; 
	$db_name= DB_DB; 
	$db_username= DB_USR; 
	$db_password= DB_PASS; 


	//  Acceso al script.
	
	$auth_user= DB_USR;
	$auth_password	= DB_PASS;


	//  Nombre del archivo.
         $fecha=date('Y-m-d');
	$filename= $fecha."_".DB_DB.".sql";


//------------------------------------------------------------------------------------------
//  No tocar
	error_reporting( E_ALL & ~E_NOTICE );
	define( 'Str_VERS', "1.1.1" );
	define( 'Str_DATE', "18 de Marzo de 2005" );
//------------------------------------------------------------------------------------------

///////  El �rea protegida empieza DESPU�S de la SIGUIENTE l�nea  /////
?>
<?php
//------------------------------------------------------------------------------------------
//  Funciones

	error_reporting( E_ALL & ~E_NOTICE );

	function fetch_table_dump_sql($table, $fp = 0) {
		$tabledump = "--\n";
		if( !$hay_Zlib ) 
			fwrite($fp, $tabledump);
		else
			gzwrite($fp, $tabledump);	
		$tabledump = "-- Table structure for table `$table`\n";
		if( !$hay_Zlib ) 
			fwrite($fp, $tabledump);
		else
			gzwrite($fp, $tabledump);	
		$tabledump = "--\n\n";
		if( !$hay_Zlib ) 
			fwrite($fp, $tabledump);
		else
			gzwrite($fp, $tabledump);	

		$tabledump = query_first("SHOW CREATE TABLE $table");
		strip_backticks($tabledump['Create Table']);
		$tabledump = "DROP TABLE IF EXISTS $table;\n" . $tabledump['Create Table'] . ";\n\n";
		if( !$hay_Zlib ) 
			fwrite($fp, $tabledump);
		else
			gzwrite($fp, $tabledump);	

		$tabledump = "--\n";
		if( !$hay_Zlib ) 
			fwrite($fp, $tabledump);
		else
			gzwrite($fp, $tabledump);	
		$tabledump = "-- Dumping data for table `$table`\n";
		if( !$hay_Zlib ) 
			fwrite($fp, $tabledump);
		else
			gzwrite($fp, $tabledump);	
		$tabledump = "--\n\n";
		if( !$hay_Zlib ) 
			fwrite($fp, $tabledump);
		else
			gzwrite($fp, $tabledump);	

		$tabledump = "LOCK TABLES $table WRITE;\n";
		if( !$hay_Zlib ) 
			fwrite($fp, $tabledump);
		else
			gzwrite($fp, $tabledump);	

		$rows = query("SELECT * FROM $table");
		$numfields=mysql_num_fields($rows);
		while ($row = fetch_array($rows, DBARRAY_NUM)) {
			$tabledump = "INSERT INTO $table VALUES(";
			$fieldcounter = -1;
			$firstfield = 1;
			// campos
			while (++$fieldcounter < $numfields) {
				if( !$firstfield) {
					$tabledump .= ', ';
				}
				else {
					$firstfield = 0;
				}
				if( !isset($row["$fieldcounter"])) {
					$tabledump .= 'NULL';
				}
				else {
					$tabledump .= "'" . mysql_real_escape_string ($row["$fieldcounter"]) . "'";
				}
			}
			$tabledump .= ");\n";
			if( !$hay_Zlib ) 
				fwrite($fp, $tabledump);
			else
				gzwrite($fp, $tabledump);	
		}
		free_result($rows);
		$tabledump = "UNLOCK TABLES;\n";
		if( !$hay_Zlib ) 
			fwrite($fp, $tabledump);
		else
			gzwrite($fp, $tabledump);	
	}

	function strip_backticks(&$text) {
		return $text;
	}

	function fetch_array($query_id=-1) {
		if( $query_id!=-1) {
			$query_id=$query_id;
		}
		$record = mysql_fetch_array($query_id);
		return $record;
	}

	function problemas($msg) {
		$errdesc = mysql_error();
    $errno = mysql_errno();
    $message  = "<br>";
    $message .= "- Ha habido un problema accediendo a la Base de Datos<br>";
    $message .= "- Error $appname: $msg<br>";
    $message .= "- Error mysql: $errdesc<br>";
    $message .= "- Error n�mero mysql: $errno<br>";
    $message .= "- Script: ".getenv("REQUEST_URI")."<br>";
    $message .= "- Referer: ".getenv("HTTP_REFERER")."<br>";

		echo( "</strong><br><br><hr><center><small>" );
		setlocale( LC_TIME,"spanish" );
		echo strftime( "%A %d %B %Y&nbsp;-&nbsp;%H:%M:%S", time() );
		echo( "<br>&copy;2005 <a href=\"mailto:insidephp@gmail.com\">Inside PHP</a><br>" );
		echo( "vers." . Str_VERS . "<br>" );
		echo( "</small></center>" );
		echo( "</BODY>" );
		echo( "</HTML>" );
		die("");
  }

	function free_result($query_id=-1) {
    if( $query_id!=-1) {
      $query_id=$query_id;
    }
    return @mysql_free_result($query_id);
  }

  function query_first($query_string) {
    $res = query($query_string);
    $returnarray = fetch_array($res);
    free_result($res);
    return $returnarray;
  }

	function query($query_string) {
    $query_id = mysql_query($query_string);
    if( !$query_id) {
      problemas("Invalid SQL: ".$query_string);
    }
    return $query_id;
  }


//------------------------------------------------------------------------------------------
//  Main
?>
<!DOCTYPE html>
<HTML>
 <HEAD>
	<title>Estudios Medicos||Respaldo</title>
	<!-- no cache headers -->
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="no-cache">
	<meta http-equiv="Expires" content="-1">
	<meta http-equiv="Cache-Control" content="no-store">
	<meta http-equiv="Cache-Control" content="no-cache">
	<meta http-equiv="Cache-Control" content="must-revalidate">
            <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./css/dashboard.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.min.js"></script>
	<!-- end no cache headers --> 
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
 </HEAD>
<BODY 
	bgcolor="#D5D5D5" 
	text="#000000" 
	id="all" 
	leftmargin="25" 
	topmargin="25" 
	marginwidth="25" 
	marginheight="25" 
	link="#000020" 
	vlink="#000020" 
	alink="#000020">
<center><h1>Respaldo y descargas de la Base de Datos</h1></center>
<br>
<strong>
<?php
	@set_time_limit( 0 );

	echo( "- Base de Datos: '$db_name' en '$db_server'.<br>" );
	$error = false;
	$tablas = 0;

	if( !@function_exists( 'gzopen' ) ) {
		$hay_Zlib = false;
		echo( "- Ya que no est� disponible Zlib, salvar� la Base de Datos sin comprimir, como '$filename'<br>" );
	}
	else {
		$filename = $filename . ".gz";
		$hay_Zlib = true;
	}
	
	if( !$error ) { 
	    $dbconnection = @mysql_connect( $db_server, $db_username, $db_password ); 
	    if( $dbconnection) 
	        $db = mysql_select_db( $db_name );
	    if( !$dbconnection || !$db ) { 
	        echo( "<br>" );
	        echo( "- La conexion con la Base de datos ha fallado: ".mysql_error()."<br>" );
	        $error = true;
	    }
	    else {
	        echo( "<br>" );
	    }
	}

	if( !$error ) { 
		//  MySQL versi�n
		$result = mysql_query( 'SELECT VERSION() AS version' );
		if( $result != FALSE && @mysql_num_rows($result) > 0 ) {
			$row   = mysql_fetch_array($result);
		} else {
			$result = @mysql_query( 'SHOW VARIABLES LIKE \'version\'' );
			if( $result != FALSE && @mysql_num_rows($result) > 0 ){
				$row   = mysql_fetch_row( $result );
			}
		}
		if(! isset($row) ) {
			$row['version'] = '3.21.0';
		}
	}

	if( !$error ) { 
		$el_path = getenv("REQUEST_URI");
		$el_path = substr($el_path, strpos($el_path, "/"), strrpos($el_path, "/"));

$sql = "SHOW TABLES FROM $db_name";
$result = mysql_query($sql);



		if (!$result) {
    echo "DB Error, could not list tables\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}

		else {
			$t_start = time();
			
			if( !$hay_Zlib ) 
				$filehandle = fopen( $filename, 'w' );
			else
				$filehandle = gzopen( $filename, 'w6' );	//  nivel de compresi�n
				
			if( !$filehandle ) {
				$el_path = getenv("REQUEST_URI");
				$el_path = substr($el_path, strpos($el_path, "/"), strrpos($el_path, "/"));
				echo( "<br>" );
				echo( "- No he podido crear '$filename' en '$el_path/'. Por favor, aseg�rese de<br>" );
				echo( "&nbsp;&nbsp;que dispone de privilegios de escritura.<br>" );
			}
			else {					
				$tabledump = "-- Dump de la Base de Datos\n";
				if( !$hay_Zlib ) 
					fwrite( $filehandle, $tabledump );
				else
					gzwrite( $filehandle, $tabledump );	
				setlocale( LC_TIME,"spanish" );
				$tabledump = "-- Fecha: " . strftime( "%A %d %B %Y - %H:%M:%S", time() ) . "\n";
				if( !$hay_Zlib ) 
					fwrite( $filehandle, $tabledump );
				else
					gzwrite( $filehandle, $tabledump );	
				$tabledump = "--\n";
				if( !$hay_Zlib ) 
					fwrite( $filehandle, $tabledump );
				else
					gzwrite( $filehandle, $tabledump );	
				$tabledump = "-- Version: " . Str_VERS . ", del " . Str_DATE . ", insidephp@gmail.com\n";
				if( !$hay_Zlib ) 
					fwrite( $filehandle, $tabledump );
				else
					gzwrite( $filehandle, $tabledump );	
				$tabledump = "-- Soporte y Updaters: http://insidephp.sytes.net\n";
				if( !$hay_Zlib ) 
					fwrite( $filehandle, $tabledump );
				else
					gzwrite( $filehandle, $tabledump );	
				$tabledump = "--\n";
				if( !$hay_Zlib ) 
					fwrite( $filehandle, $tabledump );
				else
					gzwrite( $filehandle, $tabledump );	
				$tabledump = "-- Host: `$db_server`    Database: `$db_name`\n";
				if( !$hay_Zlib ) 
					fwrite( $filehandle, $tabledump );
				else
					gzwrite( $filehandle, $tabledump );	
				$tabledump = "-- ------------------------------------------------------\n";
				if( !$hay_Zlib ) 
					fwrite( $filehandle, $tabledump );
				else
					gzwrite( $filehandle, $tabledump );	
				$tabledump = "-- Server version	". $row['version'] . "\n\n";
				if( !$hay_Zlib ) 
					fwrite( $filehandle, $tabledump );
				else
					gzwrite( $filehandle, $tabledump );	

				$result = query( 'SHOW tables' );
				while( $currow = fetch_array($result, DBARRAY_NUM) ) {
					fetch_table_dump_sql( $currow[0], $filehandle );
					fwrite( $filehandle, "\n" );
					if( !$hay_Zlib ) 
						fwrite( $filehandle, "\n" );
					else
						gzwrite( $filehandle, "\n" );
						$tablas++;
				}
				$tabledump = "\n-- Dump de la Base de Datos Completo.";
				if( !$hay_Zlib ) 
					fwrite( $filehandle, $tabledump );
				else
					gzwrite( $filehandle, $tabledump );	
				if( !$hay_Zlib ) 
					fclose( $filehandle );
				else
					gzclose( $filehandle );
	
				$t_now = time();
				$t_delta = $t_now - $t_start;
				if( !$t_delta )
					$t_delta = 1;
				$t_delta = floor(($t_delta-(floor($t_delta/3600)*3600))/60)." minutos y "
				.floor($t_delta-(floor($t_delta/60))*60)." segundos.";
				echo( "- He salvado las $tablas tablas en $t_delta<br>" );
				echo( "<br>" );
				echo( "- Descargar respaldo,por seguridad al salir de esta pagina el archivo sera ELIMINADO : </strong><a href=\"$filename\">$filename</a>" );
				$size = filesize($filename);
				$size = number_format( $size );
				$size = str_replace( ",",".",$size );
				echo( "&nbsp;&nbsp;&nbsp;<small>($size bytes)</small><br>" );
		
             
                                }
		}
	}

	if( $dbconnection )
	    mysql_close();

	echo( "</strong><br><br><hr><center><small>" );
	setlocale( LC_TIME,"spanish" );
	echo strftime( "%A %d %B %Y&nbsp;-&nbsp;%H:%M:%S", time() );
	echo( "<br>&copy;2005 <a href=\"mailto:insidephp@gmail.com\">Inside PHP</a><br>" );
	echo( "vers." . Str_VERS . "<br>" );
	echo( "</small></center>" ); ?>
    <center> <input type="submit" style="" value="<<Pagina principal>>" class="btn btn-primary navbar-btn" onClick=window.location="eliminarRespaldo.php"> </center>
	<?php echo( "</BODY>" );
	echo( "</HTML>" );
	
//------------------------------------------------------------------------------------------
//  END
?>


<?php
///////  El �rea protegida acaba ANTES de la ANTERIOR l�nea  /////
	

?>
