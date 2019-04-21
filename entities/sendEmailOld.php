<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

$email_from = $_GET['email_from'];
$purpose = $_GET['purpose'];
$pid = $_GET['pid'];
$amount = $_GET['amount'];


$conn_string = "host=localhost dbname=postgres port=5432 user=postgres password=Naughty880042";

$dbconn = pg_connect($conn_string);

$query = pg_query($dbconn, "SELECT enterBid('$email_from', $pid, $amount) as status");


function sendEmail($to, $subject, $body){
$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->SMTPDebug = 2;                                       // Enable verbose debug output
    $mail->isSMTP(); 
    $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'helpify.info@gmail.com';            // SMTP username
    $mail->Password   = '8800421451';                           // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('helpify.info@gmail.com');
    $mail->addAddress($to);     // Add a recipient
    // $mail->addReplyTo('info@example.com', 'Information');

    // Content
    $mail->Subject = $subject;
    $mail->Body    = $body;

    $mail->send();
    echo 'Message has been sent';
 } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
 }
}

if ($purpose == 1){
    $body = 'The user ' . $email_from . ' has bid ' .$amount. ' on your post #' .$pid . '. Respond to the bid at helpify.com';
    $subject = 'Help is on its Way. Your post got a new bid';
    sendEmail($to, $subject, $body);
    $body = 'Your bid of amount ' .$amount. ' on post #' .$pid . ' has been successfully posted.';
    $subject = 'We\'ve received your bid.';
    sendEmail($email_from, $subject, $body);
} elseif ($purpose == 2) {
    $body = 'The user ' . $email_from . ' has commented on your post #' .$pid . '. Scoot over to helpify.com to check it out.';
    $subject = 'Help is on its Way. Your post got a new comment';
    sendEmail($to, $subject, $body);
} elseif ($purpose == 3) {
    $body = 'Your bid on post #' .$pid . ' has been selected. Scoot over to helpify.com to get in touch with the post OP. Sayonara!';
    $subject = 'Your bid has been selected';
    sendEmail($email_from, $subject, $body);
}

?>