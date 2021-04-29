<?php

require '../plugin/PhpMailer/PHPMailer.php';
require '../plugin/PhpMailer/Exception.php';
require '../plugin/PhpMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class EmailHandler{

    public $mail;

    function __construct()
    {
        $this->mail = new PHPMailer();
    }

    function SendEmail($to,$subject,$body){

        try {
            //Server settings
            $this->mail->SMTPDebug = 2;                      // Enable verbose debug output
            $this->mail->isSMTP();                                            // Send using SMTP
            $this->mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $this->mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $this->mail->Username   = 'cuentawar16@gmail.com';                     // SMTP username
            $this->mail->Password   = 'mamalala123';                               // SMTP password
            $this->mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $this->mail->Port       = 587;   
            $this->mail->setFrom('cuentawar16@gmail.com', 'Centro de Votacion');                                 // TCP port to connect to
        
            //Recipients

            $this->mail->addAddress($to);     // Add a recipient
         
        
            // Content
            $this->mail->Subject = $subject;
            $this->mail->Body    = $body;
            //$this->mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $this->mail->send();
           
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
            exit();
        }

    }

    




}



?>