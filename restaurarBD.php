<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
  <?php include 'cabezal.php'; ?>
        <div class="container-fluid" style="position: absolute;top: 25%;">
        <form method="POST" role="form" action="restore_db.php" enctype="multipart/form-data">
             <div class="form-group">
                <label for="nombre" class="col-lg-2 control-label">Seleccionar archivo base de datos</label> 
                <div class="col-lg-offset-2 col-lg-10">
                    <input type="file" name="bd">
        </div>
                 </div>
            <div class="form-group">
                
                <div class="col-lg-offset-2 col-lg-10">
                    <input type="submit" value="Iniciar respaldo">
        </div>
                 </div>
            
        </form>
</div>
        </body>
</html>
