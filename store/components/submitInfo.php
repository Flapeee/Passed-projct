<?php
include_once 'connectMysql.php';
$sessionId = session_id();
$name = $_POST['name'];
$country = $_POST['country'];
$state = $_POST['state'];
$suburbs = $_POST['suburbs'];
$address = $_POST['address'];
$email = $_POST['email'];


//Import the PHPMailer class into the global namespace
//You don't have to modify these lines.
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

require '../vendor/autoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// SMTP::DEBUG_OFF = off (for production use)
// SMTP::DEBUG_CLIENT = client messages
// SMTP::DEBUG_SERVER = client and server messages
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;
//Set the hostname of the mail server (We will be using GMAIL)
$mail->Host = 'smtp.163.com';
//Set the SMTP port number - likely to be 25, 465 or 587
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication
$mail->Username = 'testemaila1@163.com';
//Password to use for SMTP authenticationpk
$mail->Password = 'NXRVOOFKUZNVPWQM'; //NXRVOOFKUZNVPWQM
//Set who the message is to be sent from
$mail->setFrom('testemaila1@163.com', 'Grocery Store Administrator');
//Set an alternative reply-to address
//$mail->addReplyTo('replyto@example.com', 'First Last');
//Set who the message is to be sent to email and name
$mail->addAddress($email, $name);
//Name is optional
//$mail->addAddress('recepientid@domain.com');

//You may add CC and BCC
//$mail->addCC("recepient2id@domain.com");
//$mail->addBCC("recepient3id@domain.com");

$mail->isHTML(true);

//You can add attachments. Provide file path and name of the attachments
//$mail->addAttachment("file.txt", "File.txt");
//Filename is optional
//$mail->addAttachment("images/profile.png");

//Set the subject line

$mail->Subject = 'Your order is complete!';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->Body = '
Dear '.$name.',<br>        
Your order is complete!<br>
I wish you a happy life!<br>
';
//You may add plain text version using AltBody
//$mail->AltBody = "This is the plain text version of the email content";
//send the message, check for errors
$messageHidden = '';
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
    $messageHidden = 'hidden';
}
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/base.css"/>
    <link rel="stylesheet" href="../css/submitInfo.css"/>
    <title></title>
</head>
<body style="background-color: #F0FFF0">
<div class="sendMessage" <?=$messageHidden; ?>>
    Dear, <?=$name; ?>.<br>
    Your order information has been sent to your email:<?=$email; ?>.<br>
    Please check!
</div>
<?php
    $_SESSION['checkout'] = 0;
    $deleteSql = "delete from carts where session_id='$sessionId'";
    $deleteRes = $conn->query($deleteSql);
?>
</body>
</html>