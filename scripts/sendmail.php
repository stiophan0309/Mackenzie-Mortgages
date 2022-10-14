<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'localhostt';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = false;                               // Enable SMTP authentication
 //   $mail->Username = 'info@example.net';                 // SMTP username
 //   $mail->Password = 'MyStrongPassword!';                           // SMTP password
 //   $mail->SMTPSecure = 'STARTTLS';                           
    $mail->Port = 25;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('helenm@helen-mackenzie.co.uk');
    $mail->addAddress($_POST['mail']);     // Add a recipient



    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Name = $_POST['name'];
    $mail->Subject = $_POST['subject'];
    $mail->Body    = $_POST['message'];

    $mail->send();
    header('Location: http://www.helen-mackenzie.co.uk/contact.html');
    exit();
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}
?>