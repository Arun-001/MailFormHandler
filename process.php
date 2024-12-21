<?php
// Include Composer's autoloader
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate inputs
    $errors = [];

    if (empty($name)) {
        $errors[] = "Name is required.";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "A valid email is required.";
    }

    if (empty($message)) {
        $errors[] = "Message is required.";
    }

    if (empty($errors)) {
        // Initialize PHPMailer
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';  // Use Gmail's SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'bollaarunkumar98@gmail.com';  // Your Gmail address
            $mail->Password = 'bcfx yiro donu svfy';  // Your Gmail App Password (not regular Gmail password)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;  // Port 587 for TLS

            //Recipients
            $mail->setFrom($email, $name);  // Sender's email and name
            $mail->addAddress('bollaarunkumar98@gmail.com', 'Recipient Name');  // Recipient's email

            // Content
            $mail->isHTML(true);
            $mail->Subject = "New Contact Form Submission";
            $mail->Body    = "<strong>Name:</strong> $name<br><strong>Email:</strong> $email<br><strong>Message:</strong><br>$message";
            $mail->AltBody = "Name: $name\nEmail: $email\nMessage: $message";  // For email clients that don't support HTML

            // Send the email
            if ($mail->send()) {
                echo "<div class='message success'>Thank you for contacting us! We will get back to you soon.</div>";
            } else {
                echo "<div class='message error'>There was an error sending your message. Please try again later.</div>";
            }
        } catch (Exception $e) {
            echo "<div class='message error'>Mailer Error: {$mail->ErrorInfo}</div>";
        }
    } else {
        echo "<div class='message error'><ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul></div>";
    }
} else {
    // If the form is not submitted via POST, redirect back to the form
    header("Location: index.php");
    exit;
}
?>
