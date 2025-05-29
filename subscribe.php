<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $email = $_POST['email'];

        $mail = new PHPMailer(true);

        try {
            // SMTP Settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';           // Use your mail server
            $mail->SMTPAuth = true;
            $mail->Username   = 'operations@onemore-bloom.com ';       // 🔁 Replace with your Gmail
            $mail->Password   = 'ippi eaok qtft rclp';   // Use App Password (not your Gmail password)
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Email Headers
            $mail->setFrom('operations@onemore-bloom.com ', 'One More Party');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Thank You for Subscribing!';
            $mail->Body    = "
                <h3>Thank you for subscribing to One More Party!</h3>
                <p>We’re excited to share our latest updates, offers, and celebrations with you.</p>
                <p>Stay tuned!</p>
                <br>
                <strong>– The One More Party Team</strong>
            ";

            $mail->send();
            echo "Subscription successful! A confirmation email has been sent to your email.";
        } catch (Exception $e) {
            echo "Email could not be sent. Error: {$mail->ErrorInfo}";
        }

    } else {
        echo "Invalid email address.";
    }
} else {
    echo "Invalid request method.";
}

session_start(); // Start session at the top

// ... after PHPMailer sends successfully
$_SESSION['flash_message'] = "✅ Thanks for subscribing to our newsletter. Stay tuned for event inspiration and updates!";
header("Location: index.php"); // or wherever your form is
exit;
