<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('atributo.php');
require_once ('formulario.php');
require_once ('form_attr.php');
require_once ('./conexion/conectar.php');
require_once ('./conexion/configuracion.php');
 function cargarDatosPaciente() {
     $from_attr=new form_attr();
        $formp=new formulario();     
        $nombrep="paciente";
        $versionp="1.0";
        $attp1=new atributo();
        $attp1->setNombre("id_paciente");
        $attp1->setTipo("int");
        $attp1->setCalculado(0);
        $id1=$attp1->ingresarAtributo();
        $attp2=new atributo();
        $attp2->setNombre("nombre");
        $attp2->setTipo("text");
        $attp2->setCalculado(0);
        $id2=$attp2->ingresarAtributo();
        $attp3=new atributo();
        $attp3->setNombre("apellido");
        $attp3->setTipo("text");
        $attp3->setCalculado(0);
        $id3=$attp3->ingresarAtributo();
        $attp4=new atributo();
        $attp4->setNombre("fecha_nac");
        $attp4->setTipo("text");
        $attp4->setCalculado(0);
        $id4=$attp4->ingresarAtributo();     
        $attp7=new atributo();
        $attp7->setNombre("edad");
        $attp7->setTipo("int");
        $attp7->setCalculado(1);
        $id7=$attp7->ingresarAtributo();  
        $attp5=new atributo();
        $attp5->setNombre("sexo");
        $attp5->setTipo("text");
        $attp5->setCalculado(0);
        $id5=$attp5->ingresarAtributo();
        $formp->setNombre($nombrep);
        $formp->setVersion($versionp);
      $idf=$formp->insertarFormulario();
      $from_attr->setId_form($idf);
      $from_attr->setId_atributo($id1);
      $from_attr->insertarFormulario();
      $from_attr->setId_atributo($id2);
      $from_attr->insertarFormulario();
      $from_attr->setId_atributo($id3);
      $from_attr->insertarFormulario();
      $from_attr->setId_atributo($id4);
      $from_attr->insertarFormulario();
      $from_attr->setId_atributo($id5);
      $from_attr->insertarFormulario();  
      $from_attr->setId_atributo($id7);
      $from_attr->insertarFormulario(); 
      cargarFichaP();
 }
 
 function cargarFichaP(){
          $from_attr=new form_attr();
        $formp=new formulario();     
        $nombrep="ficha_patronimica";
        $versionp="1.0";
        $attp1=new atributo();
        $id1=$attp1->devolverId("id_paciente");
        $attp2=new atributo();
        $attp2->setNombre("peso");
        $attp2->setTipo("double");
        $attp2->setCalculado(0);
        $id2=$attp2->ingresarAtributo();
        $attp3=new atributo();
        $attp3->setNombre("altura");
        $attp3->setTipo("double");
        $attp3->setCalculado(0);
        $id3=$attp3->ingresarAtributo();
        $attp4=new atributo();
        $attp4->setNombre("fecha_estudio");
        $attp4->setTipo("date");
        $attp4->setCalculado(0);
        $id4=$attp4->ingresarAtributo();
        $attp5=new atributo();
        $attp5->setNombre("imc");
        $attp5->setTipo("double");
        $attp5->setCalculado(1);
        $id5=$attp5->ingresarAtributo();
        $formp->setNombre($nombrep);
        $formp->setVersion($versionp);
      $idf=$formp->insertarFormulario();
      $from_attr->setId_form($idf);
      $from_attr->setId_atributo($id1);
      $from_attr->insertarFormulario();
      $from_attr->setId_atributo($id2);
      $from_attr->insertarFormulario();
      $from_attr->setId_atributo($id3);
      $from_attr->insertarFormulario();
      $from_attr->setId_atributo($id4);
      $from_attr->insertarFormulario();
      $from_attr->setId_atributo($id5);
      cargarComentario();
 }
     
  function cargarComentario(){
          $from_attr=new form_attr();
        $formp=new formulario();     
        $nombrep="comentario";
        $versionp="1.0";
        $attp1=new atributo();
        $id1=$attp1->devolverId("id_paciente");
        $attp2=new atributo();
        $attp2->setNombre("titulo");
        $attp2->setTipo("text");
        $attp2->setCalculado(0);
        $id2=$attp2->ingresarAtributo();
        $attp3=new atributo();
        $attp3->setNombre("texto");
        $attp3->setTipo("text");
        $attp3->setCalculado(0);
        $id3=$attp3->ingresarAtributo();
       
      $formp->setNombre($nombrep);
        $formp->setVersion($versionp);
      $idf=$formp->insertarFormulario();
      $from_attr->setId_form($idf);
      $from_attr->setId_atributo($id1);
      $from_attr->insertarFormulario();
      $from_attr->setId_atributo($id2);
      $from_attr->insertarFormulario();
      $from_attr->setId_atributo($id3);
      $from_attr->insertarFormulario();
      cargarDistancia();
 }
 
 function cargarDistancia(){
          $from_attr=new form_attr();
        $formp=new formulario();     
        $nombrep="distancia";
        $versionp="1.0";
        $attp1=new atributo();
        $id1=$attp1->devolverId("id_paciente");
        $attp2=new atributo();
        $attp2->setNombre("car_fem");
        $attp2->setTipo("int");
        $attp2->setCalculado(0);
        $id2=$attp2->ingresarAtributo();
        $attp3=new atributo();
        $attp3->setNombre("car_hueco");
        $attp3->setTipo("int");
        $attp3->setCalculado(0);
        $id3=$attp3->ingresarAtributo();
        $attp4=new atributo();
        $attp4->setNombre("hueco_hombro");
        $attp4->setTipo("int");
        $attp4->setCalculado(0);
        $id4=$attp4->ingresarAtributo();
        $attp5=new atributo();
        $attp5->setNombre("hombro_braq");
        $attp5->setTipo("int");
        $attp5->setCalculado(0);
        $id5=$attp5->ingresarAtributo();
         $attp6=new atributo();
        $attp6->setNombre("hombro_rad");
        $attp6->setTipo("int");
        $attp6->setCalculado(0);
        $id6=$attp6->ingresarAtributo();
        $attp7=new atributo();
        $attp7->setNombre("hueco_cuffxell");
        $attp7->setTipo("int");
        $attp7->setCalculado(0);
        $id7=$attp7->ingresarAtributo();
        $attp8=new atributo();
        $attp8->setNombre("cuffxell_fem");
        $attp8->setTipo("int");
        $attp8->setCalculado(0);
        $id8=$attp8->ingresarAtributo();
     
        $formp->setNombre($nombrep);
        $formp->setVersion($versionp);
      $idf=$formp->insertarFormulario();
      $from_attr->setId_form($idf);
      $from_attr->setId_atributo($id1);
      $from_attr->insertarFormulario();
      $from_attr->setId_atributo($id2);
      $from_attr->insertarFormulario();
      $from_attr->setId_atributo($id3);
      $from_attr->insertarFormulario();
      $from_attr->setId_atributo($id4);
      $from_attr->insertarFormulario();
      $from_attr->setId_atributo($id5);
      $from_attr->insertarFormulario();
      $from_attr->setId_atributo($id6);
      $from_attr->insertarFormulario(); 
       $from_attr->setId_atributo($id7);
      $from_attr->insertarFormulario();
      $from_attr->setId_atributo($id8);
      $from_attr->insertarFormulario(); 
      cargarImt();
 }
 
 function cargarImt(){
          $from_attr=new form_attr();
        $formp=new formulario();     
        $nombrep="imt";
        $versionp="1.0";
        $attp1=new atributo();
        $id1=$attp1->devolverId("id_paciente");
        $attp2=new atributo();
        $attp2->setNombre("cd");
        $attp2->setTipo("double");
        $attp2->setCalculado(0);
        $id2=$attp2->ingresarAtributo();
        $attp3=new atributo();
        $attp3->setNombre("ci");
        $attp3->setTipo("double");
        $attp3->setCalculado(0);
        $id3=$attp3->ingresarAtributo();
        
       $formp->setNombre($nombrep);
        $formp->setVersion($versionp);
      $idf=$formp->insertarFormulario();
      $from_attr->setId_form($idf);
      $from_attr->setId_atributo($id1);
      $from_attr->insertarFormulario();
      $from_attr->setId_atributo($id2);
      $from_attr->insertarFormulario();
      $from_attr->setId_atributo($id3);
      $from_attr->insertarFormulario();
      cargarPresionB();
 }
 
 function cargarPresionB(){
          $from_attr=new form_attr();
        $formp=new formulario();     
        $nombrep="presion_braqueal";
        $versionp="1.0";
        $attp1=new atributo();
        $id1=$attp1->devolverId("id_paciente");
        $attp2=new atributo();
        $attp2->setNombre("psis");
        $attp2->setTipo("int");
        $attp2->setCalculado(0);
        $id2=$attp2->ingresarAtributo();
        $attp3=new atributo();
        $attp3->setNombre("pdias");
        $attp3->setTipo("int");
        $attp3->setCalculado(0);
        $id3=$attp3->ingresarAtributo();
        
       $formp->setNombre($nombrep);
        $formp->setVersion($versionp);
      $idf=$formp->insertarFormulario();
      $from_attr->setId_form($idf);
      $from_attr->setId_atributo($id1);
      $from_attr->insertarFormulario();
      $from_attr->setId_atributo($id2);
      $from_attr->insertarFormulario();
      $from_attr->setId_atributo($id3);
      $from_attr->insertarFormulario();
      cargarPresionC();
 }
 
 function cargarPresionC(){
              $from_attr=new form_attr();
        $formp=new formulario();     
        $nombrep="presion_central";
        $versionp="1.0";
        $attp1=new atributo();
        $id1=$attp1->devolverId("id_paciente");
        $attp2=new atributo();
        $attp2->setNombre("psis");
        $attp2->setTipo("int");
        $attp2->setCalculado(0);
        $id2=$attp2->ingresarAtributo();
        $attp3=new atributo();
        $attp3->setNombre("pdias");
        $attp3->setTipo("int");
        $attp3->setCalculado(0);
        $id3=$attp3->ingresarAtributo();
        
       $formp->setNombre($nombrep);
        $formp->setVersion($versionp);
      $idf=$formp->insertarFormulario();
      $from_attr->setId_form($idf);
      $from_attr->setId_atributo($id1);
      $from_attr->insertarFormulario();
      $from_attr->setId_atributo($id2);
      $from_attr->insertarFormulario();
      $from_attr->setId_atributo($id3);
      $from_attr->insertarFormulario();
      cargarRiesgo();
 }
 
 function cargarRiesgo(){
          $from_attr=new form_attr();
        $formp=new formulario();     
        $nombrep="riesgo";
        $versionp="1.0";
        $attp1=new atributo();
        $id1=$attp1->devolverId("id_paciente");
        $attp2=new atributo();
        $attp2->setNombre("fuma");
        $attp2->setTipo("checkbox");
        $attp2->setCalculado(0);
        $id2=$attp2->ingresarAtributo();
        $attp3=new atributo();
        $attp3->setNombre("presion");
        $attp3->setTipo("checkbox");
        $attp3->setCalculado(0);
        $id3=$attp3->ingresarAtributo();
        $attp4=new atributo();
        $attp4->setNombre("colesterol");
        $attp4->setTipo("checkbox");
        $attp4->setCalculado(0);
        $id4=$attp4->ingresarAtributo();
        $attp5=new atributo();
        $attp5->setNombre("hiperglisemia");
        $attp5->setTipo("checkbox");
        $attp5->setCalculado(0);
        $id5=$attp5->ingresarAtributo();
         $attp6=new atributo();
        $attp6->setNombre("ant_familiares");
        $attp6->setTipo("checkbox");
        $attp6->setCalculado(0);
        $id6=$attp6->ingresarAtributo();
        $attp7=new atributo();
        $attp7->setNombre("sedentarismo");
        $attp7->setTipo("checkbox");
        $attp7->setCalculado(0);
        $id7=$attp7->ingresarAtributo();
        $attp8=new atributo();
        $attp8->setNombre("ejercicio");
        $attp8->setTipo("checkbox");
        $attp8->setCalculado(0);
        $id8=$attp8->ingresarAtributo();
        $attp9=new atributo();
        $attp9->setNombre("medicacion");
        $attp9->setTipo("checkbox");
        $attp9->setCalculado(0);
        $id9=$attp9->ingresarAtributo();
        $attp10=new atributo();
        $attp10->setNombre("diabetes");
        $attp10->setTipo("checkbox");
        $attp10->setCalculado(0);
        $id10=$attp10->ingresarAtributo();
     
       $formp->setNombre($nombrep);
        $formp->setVersion($versionp);
      $idf=$formp->insertarFormulario();
      $from_attr->setId_form($idf);
      $from_attr->setId_atributo($id1);
      $from_attr->insertarFormulario();
      $from_attr->setId_atributo($id2);
      $from_attr->insertarFormulario();
      $from_attr->setId_atributo($id3);
      $from_attr->insertarFormulario();
      $from_attr->setId_atributo($id4);
      $from_attr->insertarFormulario();
      $from_attr->setId_atributo($id5);
      $from_attr->insertarFormulario();
      $from_attr->setId_atributo($id6);
      $from_attr->insertarFormulario(); 
      $from_attr->setId_atributo($id7);
      $from_attr->insertarFormulario();
      $from_attr->setId_atributo($id8);
      $from_attr->insertarFormulario(); 
      $from_attr->setId_atributo($id9);
      $from_attr->insertarFormulario();
      $from_attr->setId_atributo($id10);
      $from_attr->insertarFormulario(); 
      cargarVop();
 }
 
 function cargarVop(){
          $from_attr=new form_attr();
        $formp=new formulario();     
        $nombrep="vop";
        $versionp="1.0";
        $attp1=new atributo();
        $id1=$attp1->devolverId("id_paciente");
        $attp2=new atributo();
        $attp2->setNombre("hemo");
        $attp2->setTipo("float");
        $attp2->setCalculado(0);
        $id2=$attp2->ingresarAtributo();
        $attp3=new atributo();
        $attp3->setNombre("xcell");
        $attp3->setTipo("float");
        $attp3->setCalculado(0);
        $id3=$attp3->ingresarAtributo();
      $formp->setNombre($nombrep);
        $formp->setVersion($versionp);
      $idf=$formp->insertarFormulario();
      $from_attr->setId_form($idf);
      $from_attr->setId_atributo($id1);
      $from_attr->insertarFormulario();
      $from_attr->setId_atributo($id2);
      $from_attr->insertarFormulario();
      $from_attr->setId_atributo($id3);
      $from_attr->insertarFormulario();
 }
 