<?php
require_once 'phpmailer/Exception.php';
require_once 'phpmailer/PHPMailer.php';
require_once 'phpmailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;

function sendResponseEmail($reclamationSubject, $reclamationMsg, $userEmail, $userName)
{
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'az.backup04@gmail.com'; // Gmail address which you want to use as SMTP server
        $mail->Password = 'huht fwty shtq appg'; // Gmail address Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = '587';

        $mail->setFrom('az.backup04@gmail.com'); // Gmail address which you used as SMTP server

        $mail->addAddress($userEmail); // Email address where you want to receive emails

        $mail->isHTML(true);
        $mail->Subject = $reclamationSubject;
        $mail->Body = "
            <div style='font-size: 16px; color:black;'>
                <h3>Hello $userName,</h3>
                <p><strong>Message:</strong> $reclamationMsg</p>
                <p>Visit our website for more details.</p>
                <p>Best regards,<br>Admin</p>
            </div>";

        $mail->send();
        return true; // Email sent successfully
    } catch (Exception $e) {
        return $e->getMessage(); // Return error message if email sending fails
    }
}

?>
