<?php
// ini_set('SMTP', 'smtp.gmail.com');
// ini_set('smtp_port',587);
// ini_set('sendmail_from','hrm@infore');
// ini_set('auth_username','huytx0909.hdc@gmail.com');
// ini_set('smtp_password','huytx12345');

// $to = "tuantran0722.inforevn@gmail.com";
// $subject = "TEST EMAIL FROM HRM!";
// $message = "hello, you have ordered this book, thanks!";
// $headers = "From: hrm.infore@gmail.com";

// mail($to, $subject, $message, $headers);

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../../vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;    
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'huytx0909.hdc@gmail.com';                     // SMTP username
    $mail->Password   = 'huytx12345';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('infore-hrm@gmail.com', 'INFORE VIET NAM - HR DEPARTMENT');
    $mail->addAddress('tuantran0722.inforevn');     // Add a recipient
    
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Confirmation Email';
    $mail->Body    = 'Hello, You have ordered the book: <b>Book name!</b>';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
