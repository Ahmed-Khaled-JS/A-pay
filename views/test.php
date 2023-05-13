<?php
include_once '../PHPMailer/src/PHPMailer.php';
include_once '../PHPMailer/src/Exception.php';
include_once '../PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
function Sendmail($email){
//PHPMailer Object
$mail = new PHPMailer(true); //Argument true in constructor enables exceptions

//From email address and name
$mail->From = "pay@ahmedkhaled.tech";
$mail->FromName = "A PAY";

//To address and name

$mail->addAddress("$email", "rec Name");
$mail->IsSMTP();
$mail->Host = "smtp.hostinger.com";

// optional
// used only when SMTP requires authentication  
$mail->SMTPAuth = true;
$mail->Username = 'pay@ahmedkhaled.tech';
$mail->Password = '312235saf"fsaA';//Address to which recipient will reply
$mail->addReplyTo("pay@ahmedkhaled.tech", "Reply");
//If SMTP requires TLS encryption then set it
$mail->SMTPSecure = "tls";                           
//Set TCP port to connect to
$mail->Port = 465;    
//CC and BCC

//Send HTML or Plain Text email
$mail->isHTML(true);

$mail->Subject = "New transaction";
$mail->Body = "<p>go to our website apay.ahmedkhaled.tech and collect your money</p>";
$mail->AltBody = "and collect your money";

// try {
    $mail->send();
    echo "Message has been sent successfully";
}
// } catch (Exception $e) {
//     echo "Mailer Error: " . $mail->ErrorInfo;
// }