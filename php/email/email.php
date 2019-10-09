<?php
session_start();
 echo php_ini_loaded_file();
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../../vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

define("MAIL_HOST", "smtp.gmail.com");
define("SENDER_USER_NAME", "inforevnhrm@gmail.com");
define("SENDER_PASSWORD", "inforevnhrm2019");
define("SENDER_DISPLAY_NAME", "INFORE VIET NAM - HR DEPARTMENT");
define("EMAIL_FIELDS_OFFSET", 2);

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;    
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = MAIL_HOST;                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = SENDER_USER_NAME;                     // SMTP username
    $mail->Password   = SENDER_PASSWORD;                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;  

    $mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);                                  // TCP port to connect to

    //Recipients
    $mail->setFrom('infore-hrm@gmail.com', SENDER_DISPLAY_NAME);
    
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    
} catch (Exception $e) {
    echo "Cannot set server settings. Mailer Error: {$mail->ErrorInfo}";
}

$fieldContents = '';
$emailInfoArray = $_SESSION["infoEmailArr"];
foreach(array_slice($emailInfoArray, EMAIL_FIELDS_OFFSET) as $field=>$field_value) {
    $extractedFields = '<tr> 
    <th>'.$field. ':</th><td>'.$field_value.'</td> 
    </tr>';
    $fieldContents = $fieldContents . $extractedFields;
}

$htmlContent = ' 
    <html> 
    <head> 
        <title>' . $emailInfoArray["subject"] . '</title> 
    </head> 
    <body> 
        <h1>Your request has been confirmed!</h1> 
        <table cellspacing="0" style="border: 2px dashed #FB4314; width: 100%;"> 
            '
                .$fieldContents.
            '
        </table> 
    </body> 
    </html>'; 

    sendEmail($mail, $emailInfoArray["recipient"], $emailInfoArray["subject"], $htmlContent);
 

function sendEmail($mail, $recipient, $subject, $body) {
    try {
    $mail->addAddress($recipient);     // Add a recipient
    $mail->Subject = $subject;
    $mail->Body = $body;

    $mail->send();
    echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

    echo "<script>
    window.location.href='../admin.php?adminpage=adminBookOrder';
    </script>";


?>
