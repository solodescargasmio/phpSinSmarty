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
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
 <script src="js/jquery.js" type="text/javascript"></script>  
 <link href="css/dashboard.css" rel="stylesheet">
 <script type="text/javascript" src="ajax.js"></script>
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
    <style>
td{
	width:200px;
}
a{
	text-decoration:underline;
	cursor:pointer;
}
</style>
    <script>
    $(document).ready(function(){
       if($("mostrar").show()){
         $("mostrar").hide()  
       };
    });
    </script>
    </head>
    <body>
        <form id="miform" class="form-horizontal"  method="post" enctype="multipart/form-data">
     <br> <table class="table-responsive" border="1">  
               <tr> 
               <td>Nombre y tipo Campo :</td>    
              </tr>
          <div id="contenido">
<?php include('paginador.php')?>
</div>
          </table> 
      </form>

    </body>
</html>
