<?php
include 'includes/header.php'; // Include database connection and any required files

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Validate email in the URL
    if (!isset($_GET['email']) || !filter_var($_GET['email'], FILTER_VALIDATE_EMAIL)) {
        echo '<script>
            Swal.fire("Error", "Invalid or missing email address.", "error").then(() => {
                window.location.href = "login";
            });
        </script>';
        exit;
    }
    $email = $_GET['email'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and validate form inputs
    $email = $_POST['email']; // Passed as hidden input from the form
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate passwords
    if ($new_password !== $confirm_password) {
        echo '<script>Swal.fire("Error", "Passwords do not match!", "error");</script>';
        exit;
    }

    if (strlen($new_password) < 8) {
        echo '<script>Swal.fire("Error", "Password must be at least 8 characters long.", "error");</script>';
        exit;
    }

    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update password in the database
    $sql = "UPDATE user SET password = '$hashed_password' WHERE email = '$email'";
    if ($connection->query($sql) === TRUE) {
        echo '<script>
            Swal.fire("Success", "Your password has been reset. Proceed to login!", "success").then(() => {
                window.location.href = "login";
            });
        </script>';
    } else {
        echo '<script>Swal.fire("Error", "Something went wrong. Please try again.", "error");</script>';
    }

    $connection->close();
}
?>

<!-- Your existing HTML and PHP code for the form remains unchanged -->
<main>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <div class="d-flex justify-content-center py-4">
                            <a href="index.php" class="logo d-flex align-items-center w-auto">
                                <span class="d-none d-lg-block">Demop Studios</span>
                            </a>
                        </div><!-- End Logo -->

                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Reset Your Password</h5>
                                </div>

                                <form method="post" class="row g-3 needs-validation" novalidate>
                                    <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
                                    
                                    <div class="col-12">
                                        <label for="newPassword" class="form-label">New Password</label>
                                        <div class="input-group">
                                            <div class="input-group has-validation">
                                                <input type="password" name="new_password" class="form-control" id="new_password" required>
                                                <span class="input-group-text" onclick="togglePasswordVisibility('new_password', this)" style="cursor: pointer;">
                                                    <i class="bi bi-eye-slash" id="toggleIcon"></i>
                                                </span>
                                                <div class="invalid-feedback">Please enter your new password.</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                                        <div class="input-group">
                                            <input type="password" name="confirm_password" class="form-control" id="confirm_password" required>
                                            <span class="input-group-text" onclick="togglePasswordVisibility('confirm_password', this)" style="cursor: pointer;">
                                                <i class="bi bi-eye-slash" id="toggleIcon"></i>
                                            </span>
                                        </div>
                                        <div class="invalid-feedback">Please confirm your new password.</div>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Reset Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main><!-- End #main -->

<script>
function togglePasswordVisibility(passwordId, toggleElement) {
    const passwordInput = document.getElementById(passwordId);
    const toggleIcon = toggleElement.querySelector("i");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleIcon.classList.remove("bi-eye-slash");
        toggleIcon.classList.add("bi-eye");
    } else {
        passwordInput.type = "password";
        toggleIcon.classList.remove("bi-eye");
        toggleIcon.classList.add("bi-eye-slash");
    }
}
</script>

