<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'mathengemordecai@gmail.com';
    $mail->Password = 'mordecai2002';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->Timeout = 10;
    
    $mail->setFrom($email);
    $mail->addAddress('mathengemordecai@gmail.com', 'Recipient Name');
    $mail->isHTML(true);
    $mail->Subject = 'New Contact Form Submission';
    
    
    $mail->Body = "
        <h1>Contact Details:</h1>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Subject:</strong> $subject</p>
        
        <h1>Message:</h1>
        <p>$message</p>
        
    ";
    
    // Send email
    if ($mail->send()) {
        echo '<h1>Your message has been sent successfully. Thank you!</h1>';
        echo '<a href="index.html">Go Back</a>';
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
