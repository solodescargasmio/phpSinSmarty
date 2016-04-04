<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!--<html>
    <head>
        <meta charset="UTF-8">
        <title>Formulario</title>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
  <script src="js/bootstrap.min.js" type="text/javascript"></script>
 <script src="js/jquery.js" type="text/javascript"></script> 
 <script src="js/bootstrap-hover-dropdown.min.js" type="text/javascript"></script> 
    </head>
    <body>
        <form action="capturarDatos.php" method="POST">
             <fieldset>
        <?php
        require_once ('./clases/formulario.php');
        require_once ('./clases/form_attr.php');
        require_once ('./clases/atributo.php');
        $dato=$_GET['id'];
        $nombre=$_GET['nombre'];
        $atr=new atributo();
        $fr_atr=new form_attr();
        $fr_atr->setId_form($dato);
        $dat=$fr_atr->existenAtributos();
        echo ' <legend>'.  strtoupper($nombre).'</legend>';
        if($dat>0){
        $resultado=$atr->traerAtributosForm($dato);
        foreach ($resultado as $key => $value) {
            if(strcmp("int",$value->getTpo()==0)||strcmp("double",$value->getTpo()==0)||strcmp("text",$value->getTpo()==0)){
                $tipo="text";
            }else{$tipo=$value->getTpo();}
            ?>
                 <input type="text" name="nombre_formulario" value="<?php echo $nombre; ?>" hidden="">
                  <div class="form-group">
                      <label><?php echo strtoupper($value->getNombre()); ?></label>               
    <div class="col-lg-offset-2 col-lg-10">
        <input type="<?php echo $tipo; ?>" name="<?php echo $value->getNombre(); ?>" class="success">
    </div>
  </div>
 
      <?php 
      }?>
                            <div class="form-group">
                           
    <div class="col-lg-offset-2 col-lg-10">
        <input type="submit" class="btn-group" value="Enviar Datos">
    </div>
  </div>
    <?php }else{
        echo 'El formulario actual no contiene atributos.<br>Ingrese una nueva version del mismo y asegurese de agregarle atributos.<br> No sea nabo.';
    }
        ?>
                    
            </fieldset>
        </form>
    </body>
</html>-->
