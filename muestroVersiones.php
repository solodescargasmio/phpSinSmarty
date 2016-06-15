<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Estudios Médicos||Crear Formularios</title>
 <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
 <script src="js/jquery.js" type="text/javascript"></script>  
 <link href="css/dashboard.css" rel="stylesheet">
    </head> 
<body>

    <?php include 'cabezal.php';?>
    <div class="container-fluid" style="position: absolute;top: 30%;">
        <h3>Seleccione la versión del formulario con el cual trabajará</h3>
    <?php 
    require_once ('./clases/formulario.php');
require_once ('./clases/tabla.php');
require_once ('./clases/estudio_medico.php');
require_once ('./clases/form_attr.php');
require_once ('./clases/atributo.php');
      $atr=new atributo();
        $tabla=new tabla();
        $form=new formulario();
      $nombre=trim($_GET['nombre']);
      $form->setNombre($nombre);
      $resultados=$form->traerFormulariosNombre();
      $dat=count($resultados);
      foreach ($resultados as $key => $formu) {
        $estudio=$atr->traerAtributosForm($formu->getId_form());   
    ?>
    
           <div id="registro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="top:200px;  background-color: #cccccc;" >
               
               <form>
            <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">

                  <h4><font style="color: blue;">Utilizar este formulario :<?php echo '  Versión:'.$formu->getVersion();?></font></h4>  
                  <p>Creado : <?php echo $formu->getFecha_crea();?></p>
                  </div>
                <form >   
            <fieldset><legend><?php echo strtoupper($nombre); ?></legend></fieldset>
                  <div class="modal-body">
          <?php foreach ($estudio as $keys => $estudio) {   ?> 
 
            <input type="text" name="nomformulario" value="<?php echo $nombre; ?>" id="nomformulario" hidden="">
           <div class="form-group" style="border-width: 10px; background: #C8C0C0;">
               <label for="nombre" class="col-lg-2 control-label"><?php echo strtoupper($estudio->getNombre()); ?></label>
    <div class="col-lg-offset-2 col-lg-10">
        <?php  if((strcmp($estudio->getTipo(),"file")==0)){ ?>
        <input type="file" readonly="">        
        <?php }else{  ?>
       <input type="text" readonly="">      
<?php }  ?> 
        </div>
  </div>
        
 <?php }  ?> 
                  </div>
                  <div class="modal-footer">
               <div class="form-group">  
                              <label  class="col-sm-8 control-label"></label>
                                 <div class="col-lg-10">
                                     <button type="button" class="btn btn-primary btn-group-justified" onclick="window.location='llenarFormularios.php?nombre=<?php echo $nombre;?>&id_form=<?php echo $formu->getId_form();?>'">Trabajar con este formulario</button>                                   
                                 </div>
                          </div>

                  </div>
              </div>
          </div>  
                </form>
       </div><br>
       <?php   }
       ?>
       </div>
    <?php include 'footer.php';?>
</body>
</html>