<?php
include "includes/header.php";

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

// Initialize error variables
$emailError = $passwordError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate email input
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<script>
            Swal.fire({
                icon: "error",
                title: "Invalid Email",
                text: "Please enter a valid email address."
            }).then(() => {
                    window.location.href = "forgot_password"; 
                });
        </script>';
        exit;
    }

    // Check if the email exists in the database
    $query = "SELECT * FROM user WHERE email = '$email'";
    $result = $connection->query($query);

    if ($result->num_rows == 0) {
        echo '<script>
            Swal.fire({
                icon: "error",
                title: "Email Not Found",
                text: "This email address is not registered."
             }).then(() => {
                    window.location.href = "forgot_password"; 
                });
        </script>';
        exit;
    }

    // Set up PHPMailer
    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'onyitech147@gmail.com'; // Your Gmail username
        $mail->Password = 'loia cjwa hyyl sreg';   // Your Gmail app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Sender info
        $mail->setFrom('demopstudios@gmail.com', 'Demop Studios');
        $mail->addAddress($email); // Send reset link to the user’s email

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset Request';
        $resetLink = "http://localhost/demop%20studio/dashboard/reset-password?email=" . urlencode($email);
        $mail->Body = "
            <h3>Password Reset Request</h3>
            <p>Hi,</p>
            <p>You requested to reset your password. Click the link below to proceed:</p>
            <p><a href='$resetLink' target='_blank'>$resetLink</a></p>
            <p>If you did not make this request, please ignore this email.</p>
        ";
        $mail->AltBody = "Password Reset Request\n\nYou requested to reset your password. Click the link below to proceed:\n$resetLink\n\nIf you did not make this request, please ignore this email.";

        // Send email
        if ($mail->send()) {
            echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Email Sent",
                    text: "Check your Email, a password reset link has been sent.",
                    confirmButtonText: "OK"
                }).then(() => {
                    window.location.href = "login"; 
                });
            </script>';
        } else {
            echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Mailer Error",
                    text: "' . $mail->ErrorInfo . '"
                }).then(() => {
                    window.location.href = "forgot_password"; 
                });
            </script>';
        }
    } catch (Exception $e) {
        echo '<script>
            Swal.fire({
                icon: "error",
                title: "Email Sending Failed",
                text: "' . $mail->ErrorInfo . '"
             }).then(() => {
                    window.location.href = "forgot_password"; 
                });
        </script>';
    }
} else {
    echo " ";
}
?>

<!-- Your HTML form -->
<main>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <div class="d-flex justify-content-center py-4">
                            <a href="index" class="logo d-flex align-items-center w-auto">
                                <span class="d-none d-lg-block">Demop Studios</span>
                            </a>
                        </div><!-- End Logo -->

                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Forgot Password</h5>
                                </div>

                                <form method="post" class="row g-3 needs-validation" novalidate>
                                    <div class="col-12">
                                        <label for="email" class="form-label">Email</label>
                                        <div class="input-group has-validation">
                                            <input type="email" name="email" class="form-control" id="youremail" required>
                                            <div class="invalid-feedback">Please enter your email address.</div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Send Reset Link</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>