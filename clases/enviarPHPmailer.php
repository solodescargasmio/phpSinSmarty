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
class enviarPHPmailer {
    public function enviar($email, $nick, $cuerpo,$asunto) {  
        $usr=new admin();
        $usr->setNick($nick);
        $usr=$usr->traerAdmin();
$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'solodescargasmio@gmail.com';
$mail->Password = 'noespico1234';
$mail->SMTPSecure = 'tls';
$mail->From       = 'solodescargasmio@gmail.com';
$mail->FromName   = 'Estudios medicos o algo asi'; 
$mail->addAddress($email, $usr->getNombre() ." ". $usr->getApellido());
$mail->WordWrap   = 50;
$mail->isHTML(true);
$mail->Subject= $asunto;    
$mail->Body= $cuerpo;
$mail->AltBody =$cuerpo;
$mail->Port=587;
if(!$mail->send()) {
   echo 'El Mensaje no se pudo enviar.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}
//var_dump($mail);exit();

    }
}
