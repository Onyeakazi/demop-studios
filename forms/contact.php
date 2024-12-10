<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form inputs
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

    // Check if all required fields are filled
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        // Display an error if fields are empty
        echo '<script>alert("Please fill in all fields before submitting the form.");</script>';
        exit;
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Display an error if the email format is invalid
        echo '<script>alert("Please enter a valid email address.");</script>';
        exit;
    }

    // Set up PHPMailer
    $mail = new PHPMailer(true);

    // SMTP settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'onyitech147@gmail.com';
    $mail->Password = 'loia cjwa hyyl sreg'; 
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    // Set sender info
    $mail->setFrom('demopstudios@gmail.com', 'Demop Studios');

    // Set recipient (your client's email)
    $mail->addAddress('demopstudios@gmail.com'); // Change to your client’s email

    // Email content
    $mail->isHTML(true);
    $mail->Subject = "New Contact Form Submission: " . $subject;
    $mail->Body = "
        <h3>New Message from Contact Form</h3>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Subject:</strong> $subject</p>
        <p><strong>Message:</strong><br>$message</p>
    ";
    $mail->AltBody = "New Message from Contact Form\n\nName: $name\nEmail: $email\nSubject: $subject\nMessage:\n$message";
    if ($mail->send()) {
      echo 'OK';
    } else {
        echo 'Mailer Error: ' . $mail->ErrorInfo; // This will return the error message
    }
} else {
    echo "Invalid request.";
}
?>
