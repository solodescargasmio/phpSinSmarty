<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Estudios Médicos||Dependencias</title>
 <link href="css/bootstrap.css" rel="stylesheet" type="text/css">

 <script src="js/jquery.js" type="text/javascript"></script>
 <script type="text/javascript">
/*$(document).ready(function(){
	 $('.campo1').click( function(){
            var id= $(".valor",this).val();
         datatypo='dependencia'   
    });
    });*/
    
    function control(){
        var ok=true;
         var dos=$('select[name=selector1]').val();
             var uno=$('select[name=selector]').val();
             if(uno==dos){
            alert("Los formularios deben de ser distintos"); 
            ok=false;
        }
        return ok;
    };
 </script>
    </head>   
<body>

  <?php include 'cabezal.php';?>
   <div id="menuses">
       <table border="1" class="table table-striped">
        <tr class="success">
            <td>Depende</td>
            <td>De</td>
        </tr>
       <?php 
       error_reporting(0);
       require_once ('./clases/atributo.php');
require_once ('./clases/formulario.php');
require_once ('./clases/dependencia.php');

        $depencia=new dependencia();
        $dependencias=$depencia->traerDependencias(); 
        $form=new formulario();
        $resultados=$form->traerFormularios();
          foreach ($dependencias as $key => $value) {
              $depe=new dependencia();
          foreach ($resultados as $keys => $values) {
             if(strcmp($value->getDepende(),$values->getNombre())==0){
              $depe->setDepende($values->getNombre());   
             }else
                 if(strcmp($value->getDe(),$values->getNombre())==0){
              $depe->setDe($values->getNombre());   
             } 
          }
          $depe->setId($value->getId());
               
          $dependen[]=$depe;
        }
       ?>
    
       <?php 
       
       foreach ($dependen as $keys => $depen) { ?>
                <tr>  
                <td><?php echo strtoupper($depen->getDepende());?></td> 
              <td><?php echo strtoupper($depen->getDe());?></td> 
              <td><a style="cursor:pointer;" href="depende.php?ide=<?php echo $depen->getId();?>">
                      Eliminar</a></td>  
           <?php } ?>
    </table>
   </div>
    <div class="container-fluid" style="position: absolute;top: 25%;"> 
  <h3>Dependencias entre Formularios</h3>
        <br>
        <form method="POST" action="depende.php">
            <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
    <select name="selector">
            <?php  $resultados=$form->traerFormularios();
          if($resultados!=null){
          foreach ($resultados as $key => $formulario1) {?>
        <option value="<?php echo $formulario1->getNombre(); ?>"> <?php echo strtoupper($formulario1->getNombre()); ?></option>
                   
         <?php }
          ?>
    </select><h5><font style="color: red;font-weight: bold;">Depende de que :</font></h5>
    </div>
  </div>
    
    <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
       <br><select name="selector1">
<?php
          foreach ($resultados as $key => $formulario) {?>
           <option value="<?php echo $formulario->getNombre()?>"><?php echo strtoupper($formulario->getNombre());?></option>
          <?php }} ?>
    </select><h5><font style="color: red;font-weight: bold;"> esté completo</font></h5>
 </div>
  </div>

<div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
        <button type="submit" class="btn btn-primary btn-lg btn-block" onclick="return control();">Guardar dependencias</button>
    </div>
  </div>
        </form>
         <?php
   $mensage=$_GET['mensage'];
   if(isset($mensage)){ ?>
      <font style="color: red;font-weight: bold;"><?php echo $mensage;?></font> 
     <?php } ?>
        
      </div>   
   
</body>
</html>