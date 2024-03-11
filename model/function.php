<?php
require('../config/mail.php');

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;

function sendMail($subject, $body, $to, $from, $from_name)
{
  // Create a new PHPMailer instance
  $mail = new PHPMailer;

  //Server settings
  // $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
  $mail->isSMTP(); //Send using SMTP
  $mail->Host = SMTP_HOST; //Set the SMTP server to send through
  $mail->SMTPAuth = true; //Enable SMTP authentication
  $mail->Username = SMTP_USERNAME; //SMTP username
  $mail->Password = SMTP_PASSWORD; //SMTP password
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
  $mail->Port = SMTP_PORT; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

  //Recipients
  $mail->setFrom($from, $from_name);

  // Set your email subject and body
  $mail->Subject = $subject;
  $mail->isHTML(true); // Set email format to HTML
  $mail->Body = $body;
  $mail->AltBody = strip_tags($body); // Provide a plain-text version of the HTML email content

  $mail->addAddress($to);

  // Send the email
  if ($mail->send()) {
    $statusRes = "success";
  } else {
    $statusRes = "error";
  }

  return $statusRes;
}

?>