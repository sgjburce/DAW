<?php
require __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {

    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'burceajohan@gmail.com';
    $mail->Password   = 'gfuu jshu kdoz fhks'; // parola de aplicație
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('burceajohan@gmail.com', 'Catalog Digital');
    $mail->addAddress('johanburcea@gmail.com');

    $mail->Subject = $subiect;
    $mail->Body    = "sent by " . $email . " <" . $mesaj . ">";

    $mail->send();
    echo "Trimis OK";
} catch (Exception $e) {
    echo "Eroare trimitere: " . $mail->ErrorInfo;
}