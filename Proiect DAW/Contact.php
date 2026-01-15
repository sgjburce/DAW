<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($connection);

    include("header.php");

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require __DIR__ . '/vendor/autoload.php';

    $status = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {

        $subiect = trim($_POST['subiect'] ?? '');
        $mesaj   = trim($_POST['mesaj'] ?? '');
        $email   = trim($_POST['email'] ?? '');

        if ($subiect !== '' && $mesaj !== '' && filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'burceajohan@gmail.com';
                $mail->Password = 'gfuu jshu kdoz fhks';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('burceajohan@gmail.com', 'Catalog Digital');

                // unde ajunge mesajul (tu către tine)
                $mail->addAddress('johanburcea@gmail.com');
                $mail->Subject = $subiect;
                $mail->Body = "sent by " . $email . " <" . $mesaj . ">";

                $mail->send();
                $status = "Trimis OK";
            } catch (Exception $e) {
                $status = "Eroare trimitere: " . $mail->ErrorInfo;
            }

        } else {
            $status = "Completează corect subiectul/mesajul și un email valid.";
        }
        }
        if ($status !== "") echo "<p>$status</p>";
?>

<!DOCTYPE html>
<html>

<body>
    <style>
    h1{
        font-family: Arial, sans-serif;
        color: #020a7aff;
        margin: 0;
        padding: 0;
    }
    p{
        font-family: Arial, sans-serif;
        font-size: 14px;
        color:black;
    }
    a{
        color: #000000ff;
        text-decoration: none;
        font-family: Arial, sans-serif;
    }
    </style>
    <h1>Contacteaza-ne</h1>
    <form method="post">
        <input type="text" name="subiect" placeholder="Subiect" required><br><br>
        <input type="text" name="email" placeholder="Email" required><br><br>
        <textarea name="mesaj" placeholder="Mesaj" required></textarea><br><br>
        <input type="submit" value="Trimite">
    </form>
</body>
</html>

<?php
    include("footer.php");
?>