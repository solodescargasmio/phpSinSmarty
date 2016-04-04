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
require_once ('./PHPExel/PHPExcel.php');
Session::init();
$id_paciente=  Session::get("cedula");

  $objXLS = new PHPExcel();
  $form=new formulario();
$estudio=new estudio_medico();
$attr=new atributo();
$id_paciente=  Session::get("cedula");
$id_estudio=$estudio->traerId($id_paciente);
$formularios=$estudio->traerFormEchos($id_paciente);
//var_dump($formularios);exit();
foreach ($formularios as $value){
   $estudios=$estudio->traerFormEstudioId($id_estudio, $value);
  $nomform=$form->traerNombre($value);
$objSheet = $objXLS->setActiveSheetIndex(0);
  $positionInExcel=0;//esto es para que ponga la nueva pestaña al principio
$objXLS->createSheet(0);//creamos la pestaña
$objXLS->getActiveSheet(0)->setTitle(strtoupper($nomform));
$objXLS->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
$objXLS->getActiveSheet()->getColumnDimension("B")->setAutoSize(true);
$numero=0;
foreach ($estudios as $key => $value) {  
     $numero=$numero+1;
$objSheet->setCellValue('A'.$numero, ucfirst($value->getNom_attributo()));
$objSheet->setCellValue('B'.$numero,$value->getValor());
}

}
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Datos".$id_paciente.".xls");
header("Pragma: no-cache");
header("Expires: 0");
$objWriter = PHPExcel_IOFactory::createWriter($objXLS, 'Excel5');
$objWriter->save('php://output');
//$objWriter->save("E:\\Escritorio\Paciente".$id_paciente.".xls");
header("Location: principal.php");
 


  
//$objSheet = $objXLS->setActiveSheetIndex(0);
//////////////////////TITULOS///////////////////////////
//$objSheet->setCellValue('A1', 'Atributo');
//$objSheet->setCellValue('B1', 'Valor');
//
//	$numero=1;
//	for($a=0;$a<10;$a++){
//                $numero=$numero+1;;
//	        $objSheet->setCellValue('A'.$numero, $a);
//		$objSheet->setCellValue('B'.$numero, 'Numero a:'.$a);
//                $a=$a+1;
//        }
//$objXLS->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
//$objXLS->getActiveSheet()->getColumnDimension("B")->setAutoSize(true);
//$objXLS->getActiveSheet()->setTitle('REGIONES');
//$objXLS->setActiveSheetIndex(0);
//$positionInExcel=0;//esto es para que ponga la nueva pestaña al principio
//$objXLS->createSheet($positionInExcel);//creamos la pestaña
//$objXLS->setActiveSheetIndex(0)->setTitle('Nueva Ventana');
//$objSheet = $objXLS->setActiveSheetIndex(0);
//////////////////////TITULOS///////////////////////////
//$objWriter = PHPExcel_IOFactory::createWriter($objXLS, 'Excel5');
//$objWriter->save(__DIR__ . "\Regiones.xls");
//echo 'Archivo Guardado en '.(__DIR__ . "\Regiones.xls");
////$objSheet->setCellValue('A1', 'ID');
////$objSheet->setCellValue('B1', 'Nombre Persona');
////
////
////	$numero=1;
////	for($a=0;$a<5;$a++){
////                $numero=$numero+1;;
////	        $objSheet->setCellValue('A'.$numero, $a);
////		$objSheet->setCellValue('B'.$numero, 'Aldana : '.$a);
////                $a=$a+1;
////        }
////$objXLS->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
////$objXLS->getActiveSheet()->getColumnDimension("B")->setAutoSize(true);
////$objXLS->getActiveSheet()->setTitle('Nombre');
// 
