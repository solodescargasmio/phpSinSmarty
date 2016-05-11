<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('admin.php');
require_once ('atributo.php');
require_once ('formulario.php');
require_once ('form_attr.php');
require_once ('tabla.php');
require_once ('./conexion/conectar.php');
require_once ('./conexion/configuracion.php');

 function cargarDatosPaciente() {
     $from_attr=new form_attr();
        $formp=new formulario();
        $tabla=new tabla();
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
        $attp4->setTipo("date");
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
        $attp5->setTabla(1);
        $id5=$attp5->ingresarAtributo();
        $tabla->setId_atributo($id5);
        $tabla->setOpcion("femenino");
        $tabla->ingresarTabla();
        $tabla->setOpcion("masculino");
        $tabla->ingresarTabla();
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
 }
     
 