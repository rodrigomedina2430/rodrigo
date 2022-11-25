<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../sistema/PHPmailer/Exception.php';
require '../sistema/PHPmailer/PHPMailer.php';
require '../sistema/PHPmailer/SMTP.php';


$mail = new PHPMailer(true);
//$newTicket = $_GET['noTicket'];
//$newPDF = $newTicket;

try {

    $mail->SMTPOptions = array(
        'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true,
        )
    );

    //Server settings
    $mail->SMTPDebug  = 0;                                       //Enable verbose debug output
    $mail->isSMTP(); 
    $mail->CharSet    = 'UTF-8';                                           //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'rodrigoaxelyedramedina@gmail.com';                     //SMTP username
    $mail->Password   = 'vccgnmufslathnty';                               //SMTP password
    $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('rodrigoaxelyedramedina@gmail.com', 'SISTEMA DE CELULARES');
    $mail->addAddress('zalbertozf@gmail.com');     //Add a recipient

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    $mail->addAttachment('C:\xampp\htdocs\sistema\PDF\Ticket4171.pdf');
    $mail->addAttachment('C:\xampp\htdocs\sistema\PDF\Graficas.pdf');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'COMPRAR DE TU CELULAR';
    $mail->Body    = 'ESTE ES EL COMPROBANTE DE TU PEDIDO';
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'REVISA TU CORREO SE HA MANDADO LA FACTURA Y GRAFICAS';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>