<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of enviarPHPmailer
 *
 * @author pico
 */
 require_once './vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
 require_once ('admin.php');
 require_once ('./conexion/configuracion.php');
class enviarPHPmailer {
    public function enviar($email, $nick, $cuerpo,$asunto) {
        $ok=true;
        $usr=new admin();
        $usr->setNick($nick);
        $usr=$usr->traerAdmin();
$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = Email;
$mail->Password = Epass;
$mail->SMTPSecure = 'tls';
$mail->From       = Email;
$mail->FromName   = 'Estudios medicos o algo asi'; 
$mail->addAddress($email, $usr->getNombre() ." ". $usr->getApellido());
$mail->WordWrap   = 50;
$mail->isHTML(true);
$mail->Subject= $asunto;    
$mail->Body= $cuerpo;
$mail->AltBody =$cuerpo;
$mail->Port=587;
if(!$mail->send()) {
   $ok=false;
}
//var_dump($mail);exit();
return $ok;
    }
}
