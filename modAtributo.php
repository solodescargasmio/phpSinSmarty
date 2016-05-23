<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Estudios Médicos||Modificar Atributos</title>
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
    $("#id_attr").hide();
    
  $('.campo1').click( function(){
            var $dato= $(".campo",this).val();
            var $dato1= $(".valor",this).val();
            var $id_att=0;
            $id_att=$(".id_att",this).val();
            document.getElementById("atributo").value=$dato;
            document.getElementById("id_attr").value=$id_att;
            datatyp='atributo='+$id_att;
              $.ajax({
         url: 'controlarAjax.php',//llamo a la pagina q hace el control
         type:'POST',//metodo por el cual paso el dato
         data:datatyp,
             success: function (data) { //funcion q recoge la respuesta de la pagina q hace el control
                  $("#texarea").fadeIn(1000).html(data); //imprimo el mensaje en el div      
                
    }
     });   
            
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
        nomb_form=document.getElementById("nom_formulario").value;
      datatypo='nom_formulario='+nomb_form;
          $.ajax({
         url: 'controlarAjax.php',//llamo a la pagina q hace el control
         type:'POST',//metodo por el cual paso el dato
         data:datatypo,
             success: function (data) { //funcion q recoge la respuesta de la pagina q hace el control
                  $("#avizo").fadeIn(1000).html(data); //imprimo el mensaje en el div      
                
    }
     });  
    }
   
        </script>
   
<body>
   <?php include 'cabezal.php';?>
    <div class="container-fluid">
        
          <div id="menus">
      <div style="float: right;"><h6><font style="color: red;font-weight: bold;">Haga click sobre el nombre del atributo</font> </h6></div>       
<!-- Buscar atributo <input type="search" name="buscaratr" id="buscaratr">-->  
   <form id="miform" class="form-horizontal"  method="post" enctype="multipart/form-data">
          <br> <table class="table-responsive" border="1">  
               <tr> 
               <td>Nombre y tipo Campo :</td>    
              </tr>   
           <?php    
         require_once ('./clases/atributo.php');
         $atr=new atributo();
         $arreglo= array("id_paciente", "nombre", "apellido", "fecha_nac","edad","peso","altura","imc","fecha_estudio");
         $resultado=$atr->traerAtributos();
          if(isset($resultado)){
          foreach ($resultado as $key => $value) {
              if(!in_array($value->getNombre(), $arreglo)){?>
             <tr class="agregar">  
                <td class="campo1"><a style="cursor:pointer;"><input type="text" name="campo" class="campo" value="<?php echo $value->getNombre()?>" hidden=""><?php echo $value->getNombre();?>    
              &nbsp;&nbsp;&nbsp; &nbsp;<input type="text" name="valor" class="valor" value="<?php echo $value->getTipo(); ?>" hidden=""><?php echo $value->getTipo(); ?></a>         
                    <input type="text" name="id_att" class="id_att" value="<?php echo $value->getId_attributo(); ?>" hidden="">   
           </td>                   
           </tr>  
          <?php }}}else{?>
           <p>No existen resultados para mostrar</p>
         <?php }?>
          </table>  
      </form>
          

           
          </div>
     <?php
               error_reporting(0);
   $mensage=$_GET['mensage'];
   if(isset($mensage)){ ?>
        <br><br>
      <font style="color: red;font-weight: bold;"><?php echo $mensage;?></font> 
     <?php } ?>
      
       <div id="avizo"></div>
       <form method="post" action="modificar.php"> 
           
      <h3>Atributo</h3>
   <label>Nombre atributo</label>
   <input type="text" name="atributo" id="atributo" class="form-control" onkeypress="return vacio(event);">
  <input type="text" name="id_attr" id="id_attr" class="form-control" hidden="">
  <br>
  <div id="texarea"></div>
  <input type="submit" class="btn btn-primary btn-group-sm" value="Guardar modificacion">
       </form>     
  </div> 
    <?php include 'footer.php';?>     
</body>
</html>