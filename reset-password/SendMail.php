<?php
// namespace App\SendMail;
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';


// class SendMail {
function sendMailResetPassword($to_email, $mail_subject, $mail_content, $headers)
{
    $mail = new PHPMailer(true);
    try {
        //Server settings
        // $mail->SMTPDebug = 1;                      //Enable verbose debug output
 

        // lay tu mailtrap.io

        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'c420eeb479c446';
        $mail->Password = '9f172aca3a8f7b';


        //Recipients
        $mail->setFrom('phongtranhk20@gmail.com'); // nguoi gui
        $mail->addAddress($to_email);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $mail_subject;
        $mail->Body    = $mail_content;
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        // echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
// }