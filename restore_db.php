<head>

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="js/bootstrap.js">
<link rel="stylesheet" href="js/jquery.js">
<link rel="stylesheet" href="css/P-R.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Restaurar BD</title>
<link href='img/logo_app.png' rel='shortcut icon' type='image/png'/>
</head>

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

require_once ('./conexion/configuracion.php');
	//  Conexi�n con la Base de Datos.
	
       $db_server= DB_HOST; 
	$db_name= DB_DB; 
	$db_username= DB_USR; 
	$db_password= DB_PASS; 

	//  Nombre del archivo.
        $filename=$_FILES['bd']['name'];

//------------------------------------------------------------------------------------------
//  No tocar
	error_reporting( E_ALL & ~E_NOTICE );
	define( 'Str_VERS', "1.1.1" );
	define( 'Str_DATE', "18 de Marzo de 2005" );
//------------------------------------------------------------------------------------------

    	// Defines the charset to be used
    	header('Content-Type: text/html; charset=iso-8859-1');
///////  El �rea protegida empieza DESPU�S de la SIGUIENTE l�nea  /////
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<HTML>
 <HEAD>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Restore la Base de Datos</title>
	<!-- no cache headers -->
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="no-cache">
	<meta http-equiv="Expires" content="-1">
	<meta http-equiv="Cache-Control" content="no-store">
	<meta http-equiv="Cache-Control" content="no-cache">
	<meta http-equiv="Cache-Control" content="must-revalidate">
	<!-- end no cache headers --> 
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

	<p> Esta p�gina ser� redireccionada en 30 segundos!</p>
	<center><h1>La base de datos del sistema ha sido actualizada</h1></center><br>
	<strong>
<?php
	@set_time_limit( 0 );

	echo( "- Base de Datos: '$db_name' en '$db_server'.<br>" );
	$error = false;

	if ( !@function_exists( 'gzopen' ) ) {
		$hay_Zlib = false;
		echo( "- Ya que no est� disponible Zlib, usar� el BackUp de la Base de Datos: '$filename'<br>" );
	}
	else {
		$hay_Zlib = true;
		//$filename = $filename . ".gz";
		echo( "- Ya que est� disponible Zlib, usar� el BackUp de la Base de Datos: '$filename'<br>" );
	}

	if( !$file = @fopen( $filename,"r" ) ) { 
	    echo ("<br>- Lo siento, no encuentro o no puedo abrir: '$filename'.<br>");
	    $error = true;
	}
	else { 
	    if( fseek($file, 0, SEEK_END)==0 )
	        $filesize_comprimido = ftell( $file );
	    else { 
	       echo ("<br>- Lo siento, no puedo obtener las dimensiones de '$filename'.<br>");
	       $error = true;
	    }
	 	  fclose( $file );
	}

	if ( !$error ) {
		if( $hay_Zlib ) {
			if ( !$file = @gzopen( $filename, "rb" ) ) { 
				echo( "<br>- Lo siento, no encuentro o no puedo abrir: '$filename'.<br>" );
				$error = true;
			}
			else {
				gzrewind( $file );
			}
		}
		else {
			if ( !$file = @fopen( $filename, "rb" ) ) { 
				echo( "<br>- Lo siento, no encuentro o no puedo abrir: '$filename'.<br>" );
				$error = true;
			}
			else {
				rewind( $file );
			}
		}
	}

	if (!$error) { 
	    $dbconnection = @mysql_connect( $db_server, $db_username, $db_password ); 
	    if ($dbconnection) 
	        $db = mysql_select_db( $db_name );
	    if ( !$dbconnection || !$db ) { 
	        echo( "<br>" );
	        echo( "- Lo siento, la conexion con la Base de datos ha fallado: ".mysql_error()."<br>" );
	        $error = true;
	    }
	    else {
	        echo( "<br>" );
	        echo( "- He establecido conexion con la Base de datos.<br>" );
	    }
	}

	if (!$error) { 
	    
$sql = "SHOW TABLES FROM $db_name";
$result = mysql_query($sql);

if (!$result) {
    echo "DB Error, could not list tables\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}

			else {
					// $count es el n�mero de tablas en la base de datos
					$count = mysql_num_rows($result);
					if( !$count ) {
							echo "- No ha sido necesario borrar la estructura de la Base de datos, estaba vac�a.<br>";
					}
					else {
							while ($row = mysql_fetch_row($result)) {
									$deleteIt = mysql_query("DROP TABLE $row[0]");
									if( !$deleteIt ) {
	        						echo( "<br>" );
											print "- Lo siento, error al borrar la tabla $row[0].<br>";
											$error = true;
											break;
									}
							}
							echo "- He borrado la estructura de la Base de Datos.<br>";
					}
					mysql_free_result($result);
			}
	}

	if( !$error ) { 
	    $query = "";
	    $last_query = "";
	    $total_queries = 0;
	    $total_lineas = 0;
	
			$t_start = time();

			while( 1 ) {
				if( $hay_Zlib )
					$seacabo = gzeof( $file ) OR $error;
				else
					$seacabo = feof( $file ) OR $error;
				if( $seacabo )
					break;
				if( $hay_Zlib )
					$statement = gzgets( $file );
				else
					$statement = fgets( $file );
					
	        $statement = trim( $statement );
	        $total_lineas++;
	        // no se procesan comentarios ni lineas en blanco
	        if ( $statement=="--" || $statement=="" || strpos ($statement, "#") === 0) { 
	            continue;
	        }
	        // pasa a query
	        $query .= $statement;
	        // ejecuta query si esta completo
	        
	        if( preg_match( "/;$/", $statement ) ) { 

	            if ( !mysql_query( $query, $dbconnection) ) { 
	                echo(" <br>" );
	                echo("- Error en statement: $statement<br>" );
	                echo("- Query: $query<br>");
	                echo("- MySQL: ".mysql_error()."<br>" );
	                $error = true;
	                break;
	            }
	            $last_query = $query;
	            $query = "";
	            $total_queries++;
	        }
	    }

			if( $hay_Zlib )
				$file_offset = gztell($file);
	    else
	    	$file_offset = ftell($file);
	
	    echo( "<pre>" );
	    echo( "- Lineas procesadas......................... $total_lineas<br>" );
	    echo( "- Queries procesadas........................ $total_queries<br>" );
	    echo( "- Ultimo Query procesado.................... '$last_query'<br>" );
			if( $hay_Zlib ) {
	    	echo( "- Base de Datos comprimida.................. $filesize_comprimido bytes<br>");
	    	echo( "- Base de Datos descomprimida y procesada... $file_offset bytes<br>" );
	  	}
	  	else {
	    	echo( "- Base de Datos procesada................... $file_offset bytes<br>" );
	  	}
	    echo( "</pre>" );
			$t_now = time();
			$t_delta = $t_now - $t_start;
			if( !$t_delta )
				$t_delta = 1;
			$t_delta = floor(($t_delta-(floor($t_delta/3600)*3600))/60)." minutos y "
			.floor($t_delta-(floor($t_delta/60))*60)." segundos.";
			echo( "- He completado el Restore de la Base de Datos en $t_delta<br>" );
	}

	if ( $dbconnection )
	    mysql_close();
	if ( $file )
		if( $hay_Zlib )
			gzclose($file);
	   else
	    fclose($file);

 ?>

