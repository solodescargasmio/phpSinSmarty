<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('./conexion/configuracion.php');
function crearBaseDeDatos(){
     try {
   $pdo1=new PDO('mysql:host=localhost;dbname='.DB_DB, DB_USR, DB_PASS)or die("Error al conectar"); 
} catch (PDOException $e) {
    cargarTablas();
}
     
}

function cargarTablas(){
 $pdo = new PDO('mysql:host=localhost', DB_USR, DB_PASS);
$sql="CREATE DATABASE IF NOT EXISTS ".DB_DB." DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE ".DB_DB.";";
$pdo->exec($sql);
$sql="CREATE TABLE IF NOT EXISTS `administrador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nick` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(150) NOT NULL,
  `tipo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nick` (`nick`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
$pdo->exec($sql);
$sql="INSERT INTO `administrador` (`id`, `nick`, `nombre`, `apellido`, `email`, `pass`, `tipo`) VALUES
(1, 'admin', 'Ad', 'Min', 'micorreo@outlook.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 0);";
$pdo->exec($sql);
$sql="CREATE TABLE IF NOT EXISTS `atributo` (
  `id_attributo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `calculado` tinyint(1) NOT NULL,
  `tabla` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_attributo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
$pdo->exec($sql);
$sql="INSERT INTO `atributo` (`id_attributo`, `nombre`, `tipo`, `calculado`, `tabla`) VALUES
(1, 'id_paciente', 'int', 0, 0),
(2, 'nombre', 'text', 0, 0),
(3, 'apellido', 'text', 0, 0),
(4, 'fecha_nac', 'date', 0, 0),
(5, 'edad', 'int', 1, 0),
(6, 'sexo', 'text', 0, 1),
(7, 'peso', 'double', 0, 0),
(8, 'altura', 'double', 0, 0),
(9, 'fecha_estudio', 'date', 0, 0),
(10, 'imc', 'double', 1, 0);
";
$pdo->exec($sql);
$sql="CREATE TABLE IF NOT EXISTS `dependencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `depende` varchar(100) NOT NULL,
  `de` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
$pdo->exec($sql);
$sql="CREATE TABLE IF NOT EXISTS `estudio_atributo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_estudio` int(11) NOT NULL,
  `id_form` int(11) NOT NULL,
  `id_attributo` int(11) NOT NULL,
  `valor` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_estudio` (`id_estudio`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
";
$pdo->exec($sql);
$sql="CREATE TABLE IF NOT EXISTS `estudio_paciente` (
  `id_estudio` int(11) NOT NULL AUTO_INCREMENT,
  `id_paciente` int(11) NOT NULL,
  `fecha_estudio` date NOT NULL,
  `numero` int(11) NOT NULL,
  PRIMARY KEY (`id_estudio`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
$pdo->exec($sql);
$sql="CREATE TABLE IF NOT EXISTS `form` (
  `id_form` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `version` int(11) NOT NULL,
  `fecha_crea` date NOT NULL,
  PRIMARY KEY (`id_form`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
$pdo->exec($sql);
$sql="INSERT INTO `form` (`id_form`, `nombre`, `version`, `fecha_crea`) VALUES
(1, 'paciente', 1, '2016-04-07'),
(2, 'ficha_patronimica', 1, '2016-04-07'),";
$pdo->exec($sql);
$sql="CREATE TABLE IF NOT EXISTS `form_attr` (
  `id_form` int(11) NOT NULL,
  `id_attributo` int(11) NOT NULL,
  `obligatorio` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_form`,`id_attributo`),
  KEY `id_form` (`id_form`,`id_attributo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
$pdo->exec($sql);
$sql="INSERT INTO `form_attr` (`id_form`, `id_attributo`, `obligatorio`) VALUES
(1, 1, 1),
(1, 2, 1),
(1, 3, 1),
(1, 4, 1),
(1, 5, 1),
(1, 6, 1),
(2, 1, 1),
(2, 7, 1),
(2, 8, 1),
(2, 9, 1),
(2, 10, 1);";
$pdo->exec($sql);
$sql="CREATE TABLE IF NOT EXISTS `tabla` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_attributo` int(11) NOT NULL,
  `opcion` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_attributo` (`id_attributo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
$pdo->exec($sql);
$sql="ALTER TABLE `estudio_atributo`
  ADD CONSTRAINT `estudio_atributo_ibfk_1` FOREIGN KEY (`id_estudio`) REFERENCES `estudio_paciente` (`id_estudio`) ON DELETE CASCADE ON UPDATE CASCADE;
";
$pdo->exec($sql);
$sql="ALTER TABLE `form_attr`
  ADD CONSTRAINT `form_attr_ibfk_1` FOREIGN KEY (`id_form`) REFERENCES `form` (`id_form`) ON DELETE CASCADE ON UPDATE CASCADE;
";
$pdo->exec($sql);
$sql="ALTER TABLE `tabla`
  ADD CONSTRAINT `tabla_ibfk_1` FOREIGN KEY (`id_attributo`) REFERENCES `atributo` (`id_attributo`) ON DELETE CASCADE ON UPDATE CASCADE;
";
$pdo->exec($sql);   
}