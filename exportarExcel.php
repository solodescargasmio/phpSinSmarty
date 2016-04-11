<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('./clases/atributo.php');
require_once ('./clases/formulario.php');
require_once ('./clases/form_attr.php');
require_once ('./clases/session.php');
require_once ('./clases/tabla.php');
require_once ('./clases/estudio_medico.php');
require_once ('./clases/dependencia.php');
require_once ('./clases/datosPrecargados.php');
Session::init();
$id_paciente=Session::get("cedula");
$num=  Session::get("numero_estudio");
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=EstudioNº".$num."_".$id_paciente.".xls");
header("Pragma: no-cache");
header("Expires: 0");
$form=new formulario();
$estudio=new estudio_medico();
$attr=new atributo();
$id_estudio=Session::get("estudio");
$formularios=$estudio->traerFormEchosXestudios($id_paciente,$id_estudio);
//var_dump($formularios);exit();
foreach ($formularios as $value) {
   $estudios=$estudio->traerFormEstudioId($id_estudio, $value);
  $nomform=$form->traerNombre($value);
   echo "<table border=1> ";
echo "<caption border=2>".strtoupper($nomform)."</caption>";
echo "<tr> ";
echo "<th>Atributo</th> ";
echo "<th>Valor</th> ";
echo "</tr> ";
foreach ($estudios as $key => $value) {  
  echo "<tr> ";
echo "<td><font color=green>".ucfirst($value->getNom_attributo())."</font></td> ";
echo "<td>".$value->getValor()."</td> ";
echo "</tr> ";  
}
 echo "</table> ";  
}


