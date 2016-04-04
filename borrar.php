<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */  
require_once './clases/atributo.php';
 require_once ('./clases/formulario.php');
$dato=$_POST['borrar'];
var_dump('dentro borrar');
header("Location: paginar.php?borrar=".$dato);