<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Estudios Médicos||Regístro</title>
    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/dateFechamio.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="./css/dashboard.css" rel="stylesheet">
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/jquery.min.js"></script>
    <script src="./js/dateFechamio.js"></script>

 <script>
          $(function(){
	//Aqui se coge el elemento y con la propiedad .on que requiere dos  parametros : change (cuando el valor de ese id cambie, que es cuando se elige otra opcion en la desplegable)y ejecutar la siguiente funcion cuando se haga change
	$("#nick").keyup( function(){
            var id=$(this).val();
     datatypo='nick='+id;//genero un array con indice
             $.ajax({
         url: 'controlarAjax.php',//llamo a la pagina q hace el control
         type:'POST',//metodo por el cual paso el dato
         data:datatypo,
             success: function (data) { //funcion q recoge la respuesta de la pagina q hace el control
                  $("#respuestanick").fadeIn(1000).html(data); //imprimo el mensaje en el div      
                
    }
     }); 
      
    });  
           //  datatypo='user='+user;//genero un array con indice
      
    });
   </script>
</head>

<body>
 
    <?php include 'cabezal.php';?>
    <div class="container-fluid" style="position: absolute;top: 25%;">
   <?php
               error_reporting(0);
   $mensage=$_GET['mensage'];
   if(isset($mensage)){ ?>
      <font style="color: red;font-weight: bold;"><?php echo $mensage;?></font> 
     <?php } ?>
        <div id="registro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="top:200px;">
            <form method="POST" action="registrarUsuario.php">
            <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                  <h4><font style="color: blue;">Ingrese datos de usuario</font></h4>  
                  <div id="respuestanick"></div>
                  </div>
                  <div class="modal-body">
                      <form method="POST">
                         
                           <div class="form-group">  
                              <label  class="col-sm-8 control-label">Nick</label>
                                 <div class="col-lg-10">
   <input type="text" name="nick" id="nick">
                                 </div>
                          </div>
                          
                          <div class="form-group">  
                              <label  class="col-sm-8 control-label">Nombre Usuario</label>
                                 <div class="col-lg-10">
   <input type="text" name="nombre" id="nombre">
                                 </div>
                          </div>
                          
                           <div class="form-group">  
                              <label  class="col-sm-8 control-label">Apellido Usuario</label>
                                 <div class="col-lg-10">
   <input type="text" name="apellido" id="apellido">
                                 </div>
                          </div>
                          
                           <div class="form-group">  
                              <label  class="col-sm-8 control-label">Email Usuario(se utilizara para restaurar contraseña)</label>
                                 <div class="col-lg-10">
                    <input type="email" name="email" id="email">
                                 </div>
                          </div>
                          
                          <div class="form-group">  
                              <label  class="col-sm-8 control-label">Contraseña</label>
                                 <div class="col-lg-10">
                                     <input type="password" name="passw" id="passw">     
                                 </div>
                          </div>
                          
                           <div class="form-group">  
                              <label  class="col-sm-8 control-label">Privilegios del Usuario</label>
                                 <div class="col-lg-10">
                              <select name="privilegio">
        <option value="todos">Administrador</option>
        <option value="comun">Usuario Comùn</option>

        </select>    
                                 </div>
                          </div>
                        
                  </div>
                  <div class="modal-footer">
               <div class="form-group">  
                              <label  class="col-sm-8 control-label"></label>
                                 <div class="col-lg-10">
                                     <input type="submit" value="Registrar" class="btn btn-primary btn-group-justified" name="registrar">
                                 </div>
                          </div>
                      </form> 
                  </div>
              </div>
          </div>  
                </form>
       </div><br>   
       
    </div>
<?php include 'footer.php';?>
</body>

</html>