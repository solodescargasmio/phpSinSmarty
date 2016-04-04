<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Nuevo Atributo</title>
         <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
 <script src="js/jquery.js" type="text/javascript"></script>  
    </head>
    <body>
      <div class="fondo">
      <form id="my-dynamic-form" action="atrapar.php" method="post" enctype="multipart/form-data">                            
          <fieldset>  <label  class="col-sm-4 control-label">Atributo</label></fieldset>
    
      <div class="form-group">     
       <label  class="col-sm-4 control-label">Nombre del atributo</label>
                    <div class="col-sm-8">
  <input type="" name="nombre" id="nombre" placeholder="Ej: direccion (Sin espacios o caracteres raros)" class="success" size ="50">
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
        </select>
                   </div> 
                </div>   
      <input type="submit" value="Enviar" class="btn btn-primary btn-group-justified">
            </form>
      </div>
    </body>
</html>
