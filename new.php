<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/466639aa9b.js"></script>
    <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script language="JavaScript" src="scripts/gen_validatorv31.js" type="text/javascript"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
    <title>MacKenzie Mortgages - Sending Email ....</title>
  </head>
  <body>
</body>
</html>

<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true); // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 0; // Enable verbose debug output
    $mail->isSMTP(); // Set mailer to use SMTP
    $mail->Host = 'localhost'; // Specify main and backup SMTP servers
    $mail->SMTPAuth = false; // Enable SMTP authentication
    $mail->SMTPAutoTLS = false;
    $mail->SMTPSecure = 'none'; // Enable SSL encryption, TLS also accepted with port 465
    $mail->Port = 25; // TCP port to connect to

    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['mail']);
    $query = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    //Recipients
    $mail->setFrom('helenm@helen-mackenzie.co.uk', 'MacKenzie Mortgages');//This is the email your form sends From
    $mail->addAddress('helenm@helen-mackenzie.co.uk', 'MacKenzie Mortgages Contact Form'); // Add a recipient address

    //Content
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = "Contact Form Submission from: $name ($email)";
 //   $mail->Body = preg_replace('/\[\]/','',$message);
 //   $mail->AltBody = preg_replace('/\[\]/','',$message);
 //   
 //   $subject = "$subject";
    $body = "
    <html>
<head>
<style>
@import url('https://fonts.googleapis.com/css2?family=Amarante&family=Exo+2&display=swap');
body, html {
    font-family: 'Exo 2', sans-serif;

}

body {
    font-size: 16px;
    background: linear-gradient(#fff, #1761a0) no-repeat center center fixed;
    -webkit-background-size: cover;
     -moz-background-size: cover;
    background-size: cover;
    -o-background-size: cover;
}

h1, h2, h3 {
    font-family: 'Amarante', cursive;
    color: #1761a0;
}

p, span, a {
    font-family: 'Exo 2', sans-serif;
}
.logo {
    text-align: center;
    margin: 10px 10px 50px 10px;
}
.container {
    margin: 50px;
    padding: 20px 20px 50px 20px;
    border-radius: 10px 10px 10px 10px;
    border: 1px solid #1761a0;
    background-color: #d4e1ee;
}
.row {
    border-radius: 5px 5px 5px 5px;
    background-color: #ffffff;
    padding: 5px;
    margin: 5px;
}
.row-left {
    float: left;
    width: 5%;
}
.row-right {
    float: right;
    width: 92%;
    text-align: left;
}
.clear {
    clear: both;
}

</style>
</head>
<body>
    <h1 class='logo'>MacKenzie Mortgages</h1>
    <div class='container'>
        <p>The following customer has sent the below email from the MacKenzie Mortgages contact form:</p>
        <br>
            <div>
                <div class='row row-left'><p>Name:</p></div>
                <div class='row row-right'><p> $name</p></div>
                <div class='clear'></div>    
            </div>
            <div>
                <div class='row row-left'><p>Email:</p></div>
                <div class='row row-right'><p> $email</p></div>
                
            </div>
            <div>
                <div class='row row-left'><p>Subject:</p></div>
                <div class='row row-right'><p> $query</p></div>
                
            </div>
            <div>
                <div class='row row-left'><p>Message:</p></div>
                <div class='row row-right'><p> $message</p></div>
                <div class='clear'></div>   
            </div>
    </div>
</body>
</html>";
    $mail->Body = $body;

 //   $mail->Body = strval($message);
    $mail->send();
// echo '<br><h1>Message has been sent</h1>';
    header("location: thank-you.html");

} catch (FFI\Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}

