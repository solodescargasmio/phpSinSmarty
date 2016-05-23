<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Estudios Médicos||Cambiar Nombre Formularios</title>
 <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
 <script src="js/jquery.js" type="text/javascript"></script>  
 <link href="css/dashboard.css" rel="stylesheet">
    </head>
        <style type="text/css">
        body { font-family:Lucida Sans, Arial, Helvetica, Sans-Serif; font-size:13px; margin:20px;}
        #main { width:960px; margin: 0px auto; border:solid 1px #b2b3b5; -moz-border-radius:10px; padding:20px; background-color:#f6f6f6;}
        #header { text-align:center; border-bottom:solid 1px #b2b3b5; margin: 0 0 20px 0; }
        fieldset { border:none; width:500px;}
        legend { font-size:18px; margin:0px; padding:10px 0px; color:#b0232a; font-weight:bold;}
        label { display:block; margin:15px 0 5px;}
        input[type=text], input[type=password] { width:300px; padding:5px; border:solid 1px #000;}
 
    </style>
            <script>
             
$(document).ready(function(){ 
    $("#viejo").hide();
    });
  
  $(function(){
    $('.version1').click( function(){
        
            var $dato1= $(".formular",this).val();
        document.getElementById("nuevo").value=$dato1; 
        document.getElementById("viejo").value=$dato1; 
    });
    });
  

   function vacio(e){
       ok=true;
       patron =/\w/;
       k=e.which;
       if (k==8 || k==0) return true;
       n = String.fromCharCode(k);
return patron.test(n);
 /*if((k < 97 || k > 122) && (k < 65 || k > 90) && (k !== 16||k !== 8||k !== 242)){
       alert("No agrege espacios en blanco ni caracteres raros \n si quiere escribir varias palabras unalas con guión bajo '_'");
ok=false; 
        }
return ok;*/
    } 
    
    
    function control(){
 var dato=document.getElementById("nuevo").value;
 alert(dato);
 return false;
    }
   
        </script>
   
<body>
   <?php include 'cabezal.php';?>
    <div class="container-fluid">
        
          <div id="menus">
      <div style="float: right;"><h6><font style="color: red;font-weight: bold;">Haga click sobre el nombre del formulario</font> </h6>      
<!-- Buscar atributo <input type="search" name="buscaratr" id="buscaratr">-->  
   <div style="position: absolute;float: right;">    
    <form id="formversion" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
           <br> <table class="table-responsive" border="1">  
                <tr>
                  <td>Formularios :</td>
               </tr>
               <?php
               require_once ('./clases/atributo.php');
    require_once ('./clases/formulario.php');
    require_once ('./clases/form_attr.php');
    require_once ('./clases/estudio_medico.php');
               $form=new formulario();
          $resultados=$form->traerFormularios();
          if($resultados!=null){
          foreach ($resultados as $key => $formulario) {
              if((strcmp($formulario->getNombre(), "paciente")==0) || (strcmp($formulario->getNombre(), "ficha_patronimica")==0)){}else{  ?>
       <tr class="version1">
    <td class="formu">
     <a style="cursor:pointer;">   <input type="text" id="formular" name="formular" class="formular" value=" <?php echo $formulario->getNombre(); ?>" hidden="">
        <?php echo strtoupper($formulario->getNombre()); ?></a></td>                 
                   </tr>
          <?php   
          }}} ?>

           </table> 
           </form>    
                </div> 

          </div>  
          </div>
     <?php
               error_reporting(0);
   $mensage=$_GET['mensage'];
   if(isset($mensage)){ ?>
        <br><br>
      <font style="color: red;font-weight: bold;"><?php echo $mensage;?></font> 
     <?php } ?>
      
       <div id="avizo"></div>
       <form method="post" action="modificarnombre.php"> 
           
      <h3>Formulario</h3>
   <label>Nombre Formulario</label>
   <input type="text" name="nuevo" id="nuevo" class="form-control" onkeypress="return vacio(event);" required="">
  <input type="text" name="viejo" id="viejo" class="form-control" >
  <br>
  <div id="texarea"></div>
  <input type="submit" class="btn btn-primary btn-group-sm" value="Guardar modificacion">
       </form>     
  </div> 
    <?php include 'footer.php';?>     
</body>
</html>