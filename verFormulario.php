<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Estudios Médicos||Ver</title>
    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/dateFechamio.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="./css/dashboard.css" rel="stylesheet">
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/jquery.min.js"></script>
    <script src="./js/dateFechamio.js"></script>

</head>

<body>

    <?php include 'cabezal.php'; ?> 
     <div class="container-fluid" style="position: absolute;top: 30%;">
        <div id="respuestauser"></div>
    <?php 
    $nombre=$_GET['nombre'];
    
//     error_reporting(0);
require_once ('./clases/estudio_medico.php');
require_once ('./clases/formulario.php');
require_once ('./clases/tabla.php');
$form=new formulario();
       $id_user=Session::get('cedula');
    $id_paciente=$id_user;
    $cedula=$id_user;
    $apell= Session::get('apellido');
    $edad=  Session::get('edad');
    $id_estudio= Session::get("estudio");
     $operador=  Session::get("usuario");
       $mensage="";
        $atr=new atributo();
        $tabla=new tabla();
        
        $idf=$form->traerId($nombre);

        if($id_estudio){
       $estu=new estudio_medico();
        $estudio=$estu->traerFormEstudioId($id_estudio, $idf);
  
        foreach ($estudio as $key => $value){
            if(strcmp($value->getTipo(),"file")==0){
        
   $exten=explode(".",$value->getValor());
        $ex=end($exten);
        $value->setExtencion($ex);
          if(strcmp($ex,"avi")==0||strcmp($ex,"mp4")==0||strcmp($ex,"wmv")==0||strcmp($ex,"mkv")==0||strcmp($ex,"3gp")==0){
        $princi=$exten[0];
       $nuevo=$princi.".webm";
       $value->setValor($nuevo);
          }    
            }
           $es[]=$value;
        }
  
          }  
        ?>
   
       <?php if(is_null($cedula)){ ?>
          <h4>
               <font style="color: red;font-weight: bold;">Debe ingresar un paciente nuevo en el formulario "PACIENTE", <br>
               seleccionar un paciente de la lista ó buscar ID de un paciente en la caja que dice 'cedula paciente'</font></h4>
       <div class="col-lg-offset-2 col-lg-10">
           <button type="submit" class="btn btn-primary btn-lg btn-block" onclick="window.location='principal.php'">Atras</button>
    </div>      
       <?php } else{?>
           
      <h2><legend><?php echo strtoupper($nombre); ?></legend></h2>
       
    <?php    foreach ($es as $estud){
            if(strcmp($estud->getTipo(),"file")==0){ ?>
           <div class="form-group" style="height: 15%; width: 30%;">
                <label for="nombre" class="col-lg-2 control-label"><?php echo strtoupper($estud->getNom_attributo()); ?></label>
    <div class="col-lg-offset-2 col-lg-10">
   <?php  if((strcmp($estud->getExtencion(),"avi")==0)||(strcmp($estud->getExtencion(),"mp4")==0)||(strcmp($estud->getExtencion(),"wmv")==0)||(strcmp($estud->getExtencion(),"mkv")==0)||(strcmp($estud->getExtencion(),"3gp")==0)){  ?>             
 
            <video width="250" height="120" controls>
  <source src="./multimedia/<?php echo $cedula; ?>/<?php echo $id_estudio; ?>/<?php echo $estud->getValor(); ?>" type="video/webm">
Tu navegador no soporta este tipo de video.
</video> 
   <?php }else if(strcmp($estud->getExtencion(),"png")==0){ ?>
        <img src="./multimedia/<?php echo $cedula; ?>/<?php echo $id_estudio; ?>/<?php echo $estud->getValor(); ?>" width="200" height="100">
       <?php } else { ?>
       Tu navegador no soporta la visualizacion de este tipo de archivo.   
      <img src="./multimedia/<?php echo $cedula; ?>/<?php echo $id_estudio; ?>/<?php echo $estud->getValor(); ?>" width="200" height="100">  
           <?php } ?>
        <a class="btn btn-primary btn-lg btn-block" href="descargas.php?archivo=<?php echo $estud->getNom_attributo(); ?>& extension=<?php echo $estud->getExtencion(); ?>">Descargar</a>
         </div>
  </div>
           <?php } ?>
           
           <?php if(strcmp($estud->getTipo(),"file")!=0){ ?>
      <div class="form-group">
                <label for="nombre" class="col-lg-2 control-label"><?php echo strtoupper($estud->getNom_attributo()); ?></label>
    <div class="col-lg-offset-2 col-lg-10">
        <legend><?php echo $estud->getValor(); ?></legend> 
            </div>
  </div>
          <?php } ?>

   
       <?php  }} ?>
    </div>
    <?php include 'footer.php';?>
</body>
</html>