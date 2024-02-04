<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Common fields
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Instantiate PHPMailer
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.titan.email';
    $mail->SMTPAuth = true;
    $mail->Username = 'mordecaiportfolio@xeleratedtech.com';
    $mail->Password = 'mordecai2002.';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->Timeout = 10;

    // Set common email parameters
    $mail->setFrom('mordecaiportfolio@xeleratedtech.com', $name);
    $mail->addAddress('mordecaiportfolio@xeleratedtech.com', 'Recipient Name');
    $mail->isHTML(true);
    $mail->Subject = 'Contact Form Submission';

    // Customize email content
    $mail->Body = "
        <h1>Contact Form Submission</h1>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Subject :</strong> $subject</p>
        <br>
        
        <h2><strong>Message :</strong><br> $message</h2>
    ";

    // Send email
    if ($mail->send()) {
        echo '<h2>Your message has been sent successfully</h2>';
        echo '<a href="index.html" class="btn btn-primary">Go Back</a>';
        echo '<script>
                setTimeout(function() {
                    window.location.href = "index.html";
                }, 3000);
              </script>';
    } else {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
}
?>
