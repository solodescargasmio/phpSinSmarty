<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Estudios Médicos||Nuevo Atributo</title>
       <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/dateFechamio.css" rel="stylesheet">
     <link href="./css/dashboard.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/jquery.min.js"></script>
    <script src="./js/dateFechamio.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#myform2").hide();
             $("#mostrar").hide();
             $("#ocultar").show();
             
                $("#ocultar").click(function(){     
                $("#msg").hide();
                $("#myform1").hide();
                $("#mostrar").show();
                $("#myform2").show();
                $("#ocultar").hide();
            
    });
             
            $("#mostrar").click(function(){
                $("#myform2").hide();
                $("#ocultar").show();
                $("#myform1").show();
                $("#mostrar").hide();     
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
  function confirmar(){
           var ok=false;
            var pass=document.getElementById("nombre").value;
 
      if(pass!=''){
             ok=true;
         }else{
             alert('Ingrese un nombre para el atributo');
         }
          return ok;
      }
      
      function confirmarCompuesto(){
           var ok=false;
            var pass=document.getElementById("nombrecom").value;
      if(pass!=''){
          var tex=document.getElementById("selectortexto").value;
          if(tex!=''){
               ok=true;
          }else{
             alert('Ingrese opciones para el atributo compuesto');
         }    
         }else{
             alert('Ingrese un nombre para el atributo');
         }
          return ok;
      }
    
    </script>
    </head>
    <body>

        <?php include 'cabezal.php'; ?>
    <div class="container-fluid" style="position: absolute;top: 30%;">
      <h3>Ingresar Atributos</h3>
            <a href="#" onclick="mostrarDiv()" id="att"> <button id="mostrar"  class="btn btn-primary btn-group-sm">Atributo Simple</button></a>
   <a href="#" onclick="mostrarDiv()" id="att1"> <button id="ocultar"  class="btn btn-primary btn-group-sm">Atributo Compuesto </button></a>
   
   <form style="width: 500px;" id="myform1" method="post" enctype="multipart/form-data" class="form-horizontal" action="atrapar.php">                            
          <fieldset>  <label  class="col-sm-4 control-label">Atributo Simple</label></fieldset>
    
      <div class="form-group">     
       <label  class="col-sm-4 control-label">Nombre del atributo</label>
                    <div class="col-sm-8">
                        <input type="text" onkeypress="return vacio(event);" name="nombre" id="nombre" placeholder="Ej: direccion (Sin espacios o caracteres extraños)" class="success" size ="50">
                   </div> 
                </div> 
      
      <div class="form-group">     
       <label  class="col-sm-4 control-label">Agregar campo de tipo</label>
                    <div class="col-sm-8">
        <select name="selector">
        <option value="text">text</option>
        <option value="checkbox">checkbox</option>
        <option value="double">double</option>
        <option value="int">int</option>
        <option value="date">date</option>
        <option value="file">file</option>
        </select>
                   </div> 
                </div>   
      <input type="submit" onclick="return confirmar();" value="Enviar" class="btn btn-primary btn-group-justified">
            </form>
    
   <form style="width: 600px;" id="myform2" method="post" enctype="multipart/form-data" class="form-horizontal" action="atrapar.php">                            
          <fieldset>  <label  class="col-sm-4 control-label">Atributo Compuesto</label></fieldset>
    
      <div class="form-group">     
       <label  class="col-sm-4 control-label">Nombre de la tabla</label>
                    <div class="col-sm-8">
  <input type="text" onkeypress="return vacio(event);" name="nombre" id="nombrecom" placeholder="Ej: sexo (Sin espacios o caracteres extraños)" class="success" size ="50">
                   </div> 
                </div> 
      
      <div class="form-group">     
       <label  class="col-sm-4 control-label">Agregar opciones de atributo</label>
                    <div class="col-sm-8">
                        <textarea id="selectortexto" name="selectortexto" placeholder="ej: masculino,   femenino"></textarea>
                        <font style="color: red;font-weight: bold;">   Separados por comas (',')</font>
                    </div> 
                </div>   
      <input type="submit" onclick="return confirmarCompuesto();" value="Enviar" class="btn btn-primary btn-group-justified">
            </form>
   <div id="msg">   <?php 
          error_reporting(0);
        $mensage=$_GET['mensage'];
   if(isset($mensage)){?>
   <font style="font-weight: bold;"><?php echo $mensage;?></font><?php } ?> </div>
      </div>
        <?php include 'footer.php';?>
    </body>
</html>