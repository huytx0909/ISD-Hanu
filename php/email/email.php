<?php
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
define("SENDER_USER_NAME", "huytx0909.hdc@gmail.com");
define("SENDER_PASSWORD", "huytx12345");
define("SENDER_DISPLAY_NAME", "INFORE VIET NAM - HR DEPARTMENT");

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;    
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = MAIL_HOST;                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = SENDER_USER_NAME;                     // SMTP username
    $mail->Password   = SENDER_PASSWORD;                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('infore-hrm@gmail.com', SENDER_DISPLAY_NAME);
    
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    
} catch (Exception $e) {
    echo "Cannot set server settings. Mailer Error: {$mail->ErrorInfo}";
}

$recipient = $_POST["recipient"];
$subject = $_POST['subject'];

$bookName = $_POST['book-name'];
$type = $_POST['type'];
$price = $_POST['price'];

$htmlContent = ' 
    <html> 
    <head> 
        <title>' . $subject . '</title> 
    </head> 
    <body> 
        <h1>Your request has been confirmed!</h1> 
        <table cellspacing="0" style="border: 2px dashed #FB4314; width: 100%;"> 
            <tr> 
                <th>Book:</th><td>'.$bookName.'</td> 
            </tr> 
            <tr>
                <th>Type:</th><td>'. $type .'</td>  
            </tr>
            <tr>
                <th>Price</th>'. $price .'<td>
            </tr>
        </table> 
    </body> 
    </html>'; 

    sendEmail($mail, $recipient, $subject, $htmlContent);
 

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
?>
