<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Estudios Médicos||Modificar Perfil</title>
    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/dateFechamio.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="./css/dashboard.css" rel="stylesheet">
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/jquery.min.js"></script>
    <script src="./js/dateFechamio.js"></script>
    <script src="./js/jquery.js"></script>
    <script>
      function confirmar(){
           var ok=false;
            var pass=document.getElementById("passw").value;
          var dato=document.getElementById("passw1").value;
          if(pass!=''){
if(dato!='' && dato==pass){
    ok=true;
}else if(dato==''){
    alert('El campo Confirmar Contraseña está vacio');
}else if(dato!=pass){
  alert('Las contraseñas no coinciden');  
}
          return ok;}
      }  
    </script> 
</head>

<body>

    <?php include 'cabezal.php'; ?>
    <div class="container-fluid" style="position: absolute;top: 120px;">
            <?php
               error_reporting(0);
   $mensage=$_GET['mensage'];
   if(isset($mensage)){ ?>
      <font style="color: red;font-weight: bold;"><?php echo $mensage;?></font> 
     <?php } ?>
        <div id="respuestauser"></div>
        <?php 
require_once ('./clases/admin.php');
require_once ('./clases/session.php');
  $usuario=new admin();
  $nick=  Session::get("nick");
  $usuario->setNick($nick);
     $usuario=$usuario->traerAdmin();

     ?>
        <form style="width: 500px;" method="POST" action="modificarPerfil.php">
            <fieldset><legend>Mi Perfil</legend></fieldset>   
              <div class="form-group">
                   <label  class="col-sm-4 control-label">Nick</label>
    <div class="col-lg-offset-2 col-lg-10">
        <input type="text" name="viejo" value="<?php echo $usuario->getNick()?>" hidden="">
        <input type="text" name="nick" value="<?php echo $usuario->getNick()?>">
    </div>
  </div>
            
              <div class="form-group">
        <label  class="col-sm-4 control-label">Nombre</label>
    <div class="col-lg-offset-2 col-lg-10">
        <input type="text" name="nombre" value="<?php echo $usuario->getNombre()?>"> </div>
  </div>
            
              <div class="form-group">
        <label  class="col-sm-4 control-label">Apellido</label>
    <div class="col-lg-offset-2 col-lg-10">
        <input type="text" name="apellido" value="<?php echo $usuario->getApellido()?>"></div>
  </div>
            
              <div class="form-group">
          <label  class="col-sm-4 control-label">Email</label>
    <div class="col-lg-offset-2 col-lg-10">
        <input type="email" name="email" value="<?php echo $usuario->getEmail()?>"></div>
  </div>
          
               <div class="form-group">
          <label  class="col-sm-4 control-label">Contraseña</label>
    <div class="col-lg-offset-2 col-lg-10">
        <input type="password" name="passw" id="passw"></div>
  </div>
          
            <div class="form-group">
          <label  class="col-sm-4 control-label">Confirmar Contraseña</label>
    <div class="col-lg-offset-2 col-lg-10">
        <input type="password" name="passw1" id="passw1"></div><div id="respuesta"></div>
  </div>   
            
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
        <button type="submit" class="btn btn-primary btn-lg btn-block" onclick="return confirmar();">Modificar Datos</button>
    </div>
  </div>
            
        </form>
 
    </div>
    <?php include 'footer.php';?>
</body>

</html>