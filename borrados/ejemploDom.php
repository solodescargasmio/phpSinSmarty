<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ejemplo DOM</title>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
 <script src="js/jquery.js" type="text/javascript"></script>  
 <script type="text/javascript">
 $(function () { 
    $("#btnRecorrer").click(function () 
    {
        $("#divRecorrer p").each(function(idx, el) {
    alert(
        'El elemento ' + idx +
        'contiene el siguiente HTML: ' +
        $(el).html()
); });
    })
})
 </script>
    </head>
    <body>
     <input type="button" id="btnRecorrer" value="Recorrer Div !"/>
<div id="divRecorrer" style="border:1px Solid Red">
    <br/> 
    <p class="borde">Div 1 o Párrafo</p>
    <div class="borde">Div o Párrafo</div>
    <p class="borde">Div 2 o Párrafo</p>
    <div class="borde">Div o Párrafo</div>
    <p class="borde">Div 3 o Párrafo</p>
    <div class="borde">Div o Párrafo</div>
    <p class="borde">Div o Párrafo</p>
    <div class="borde">Div o Párrafo</div>
    <br/>
</div>
    </body>
</html>
