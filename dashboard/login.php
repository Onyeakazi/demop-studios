<?php
include "includes/header.php";
session_start();

// Initialize error variables
$emailError = $passwordError = "";

// Check if the user is already logged in via cookies
if (isset($_COOKIE['remember_me_email']) && isset($_COOKIE['remember_me_token'])) {
    $email = $_COOKIE['remember_me_email'];
    $token = $_COOKIE['remember_me_token'];

    // Validate the token in the database (this can be a hashed value stored with the user record)
    $query = "SELECT * FROM user WHERE email = '{$email}'"; 
    $result = $connection->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($token, $row['token'])) {
            // If the token is valid, log the user in
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['email'] = $row['email'];
            header("Location: index"); // Redirect to dashboard
            exit();
        }
    }
}

// Handle login when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $remember = isset($_POST["remember"]) ? true : false;

    // Check if email or password is empty
    if (empty($email)) {
        $emailError = "Email is required.";
    }

    if (empty($password)) {
        $passwordError = "Password is required.";
    }

    // Validate email format if it's not empty
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Invalid email format.";
    }

    // Escape the email to prevent SQL injection
    $email = mysqli_real_escape_string($connection, $email);

    // If no errors so far, proceed with the SQL query
    if (empty($emailError) && empty($passwordError)) {
        $query = "SELECT * FROM user WHERE email = '{$email}'"; // Directly inserting email

        // Execute the query
        $result = $connection->query($query);

        // Check if the user exists
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Verify password
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['email'] = $row['email'];

                // If "Remember Me" is checked, set cookies
                if ($remember) {
                    // Generate a token for the cookie (this could be a hashed value stored in the DB)
                    $token = bin2hex(random_bytes(16)); // Generate a random token

                    // Store this token in the database, associated with the user (optional, for validation)
                    $updateQuery = "UPDATE user SET token = '" . password_hash($token, PASSWORD_DEFAULT) . "' WHERE email = '{$email}'";
                    $connection->query($updateQuery);

                    // Set cookies for email and token
                    setcookie('remember_me_email', $email, time() + (86400 * 30), "/"); // 30 days
                    setcookie('remember_me_token', $token, time() + (86400 * 30), "/"); // 30 days
                }

                header("Location: index"); // Redirect to dashboard
                exit();
            } else {
                $passwordError = "Incorrect password!";
            }
        } else {
            $emailError = "No account found with that email.";
        }
        // Close the result set and connection
        $result->close();
    }
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
                            <a href="index" class="logo d-flex align-items-center w-auto">
                                <span class="d-none d-lg-block">Demop Studios</span>
                            </a>
                        </div><!-- End Logo -->

                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                                    <p class="text-center small">Enter your email & password to login</p>
                                </div>

                                <form method="post" class="row g-3 needs-validation" novalidate>
                                  <div class="col-12">
                                      <label for="email" class="form-label">Email</label>
                                      <div class="input-group has-validation">
                                          <input type="email" name="email" class="form-control <?php echo ($emailError) ? 'is-invalid' : ''; ?>" id="youremail" value="<?php echo htmlspecialchars($email ?? '', ENT_QUOTES); ?>" required>
                                          <div class="invalid-feedback"><?php echo $emailError; ?></div>
                                      </div>
                                  </div>

                                  <div class="col-12">
                                    <label for="yourPassword" class="form-label">Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control <?php echo ($passwordError) ? 'is-invalid' : ''; ?>" id="yourPassword" required>
                                        <span class="input-group-text" onclick="togglePasswordVisibility('yourPassword', this)" style="cursor: pointer;">
                                            <i class="bi bi-eye-slash" id="toggleIcon"></i>
                                        </span>
                                        <div class="invalid-feedback"><?php echo $passwordError; ?></div>
                                    </div>
                                  </div>

                                  <!-- Forgot Password Link -->
                                  <div class="col-12">
                                      <a href="forgot_password" class="small text-muted">Forgot your password?</a>
                                  </div>

                                  <div class="col-12">
                                      <div class="form-check">
                                          <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                                          <label class="form-check-label" for="rememberMe">Remember me</label>
                                      </div>
                                  </div>

                                  <div class="col-12">
                                      <button class="btn btn-primary w-100" type="submit">Login</button>
                                  </div>

                                  <div class="col-12">
                                      <p class="small mb-0">Don't have an account? <a href="register">Create an account</a></p>
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

