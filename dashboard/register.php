<?php include "includes/header.php" ?>

<?php 
  if(isset($_POST["create_user"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Encrypting password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $query = "INSERT INTO user(name, email, password) VALUES ('$name', '$email', '$hashed_password') ";

    // Execute the query

    if (mysqli_query($connection, $query)) {
      echo '<script>
              Swal.fire({
                  title: "Success!",
                  text: "User Created, Login to Dashbord.",
                  icon: "success",
                  confirmButtonText: "OK"
              }).then(() => {
                  window.location.href = "login.php";
              });
            </script>';
    } else {
        // Error handling for SQL query failure
        echo '<script>
                Swal.fire({
                    title: "Error!",
                    text: "Failed to Create User. Please try again. Error: ' . mysqli_error($connection) . '",
                    icon: "error",
                    confirmButtonText: "OK"
                }).then(() => {
                    window.location.href = "login.php";
                });
            </script>';
    }

  }
?>
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
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small">Enter your personal details to create account</p>
                  </div>

                  <form method="post" class="row g-3 needs-validation" novalidate>
                    <div class="col-12">
                      <label for="yourName" class="form-label">Your Name</label>
                      <input type="text" name="name" class="form-control" id="yourName" required>
                      <div class="invalid-feedback">Please, enter your name!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourEmail" class="form-label">Your Email</label>
                      <input type="email" name="email" class="form-control" id="yourEmail" required>
                      <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <div class="input-group">
                        <input type="password" name="password" class="form-control" id="yourPassword" required>
                        <span class="input-group-text" onclick="togglePasswordVisibility('yourPassword', this)" style="cursor: pointer;">
                            <i class="bi bi-eye-slash" id="toggleIcon"></i>
                        </span>
                        <div class="invalid-feedback">Please enter your password!</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <button name="create_user" class="btn btn-primary w-100" type="submit">Create Account</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="login.php">Log in</a></p>
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