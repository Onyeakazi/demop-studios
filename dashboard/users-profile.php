<?php include "includes/header.php" ?>
  <!-- ======= Header ======= -->
   <?php include "includes/navbar.php" ?>
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <?php include "includes/sidebar.php" ?>
  <!-- End Sidebar-->

  <?php
      // Step 1: Fetch user data (for a specific user, if needed)
    $query = "SELECT * FROM user WHERE id = 1"; // Specify an id or pass it dynamically
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query Failed: " . mysqli_error($connection));
    }
    $user = mysqli_fetch_assoc($result);
    if ($user) {
        $id = $user['id'];
        $name = $user['name'];
        $about = $user['about'];
        $email = $user['email'];
        $phone = $user['phone'];
        $address = $user['address'];
        $profile = $user['profile'];
    }

    // Step 2: Update user data
    if (isset($_POST['update_user'])) {
      // Retrieve form data
      $name = $_POST['name'];
      $about = $_POST['about'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $address = $_POST['address'];
      $profile = $_FILES['profile']['name'];
      $profile_temp = $_FILES['profile']['tmp_name'];

      // Move uploaded file to the destination folder
      if (!empty($profile)) {
          move_uploaded_file($profile_temp, "assets/img/$profile");
      } else {
          $profile = $user['profile']; // Keep existing profile image if no new upload
      }

      // Update query
      $query = "UPDATE user SET ";
      $query .= "name = '{$name}', ";
      $query .= "about = '{$about}', ";
      $query .= "email = '{$email}', ";
      $query .= "phone = '{$phone}', ";
      $query .= "address = '{$address}', ";
      $query .= "profile = '{$profile}' ";
      $query .= "WHERE id = {$id}";

      $updated_user = mysqli_query($connection, $query);

      if (!$updated_user) {
          echo "QUERY FAILED: " . mysqli_error($connection);
      } else {
          echo "User updated successfully!";
          header("Location: users-profile.php");
      }
    }
  ?>


  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Profile</h1>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">
          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="assets/img/<?php echo $profile ?>" alt="Profile" class="rounded-circle" width="100">
              <h2><?php echo $_SESSION['name'] ?></h2>
              <h3><?php echo $about ?></h3>
              <div class="social-links mt-2">
                <a href="https://www.facebook.com/BetheSolution5" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="https://www.instagram.com/demopstudios?igsh=MWl0dWZnbjBxaTVrcA==" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="https://www.linkedin.com/in/david-okenwa-151375239?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8">
          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">
                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>
              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">Profile Details</h5>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8"><?php echo $_SESSION['name'] ?></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Company</div>
                    <div class="col-lg-9 col-md-8">DEMOP STUDIOS</div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Job</div>
                    <div class="col-lg-9 col-md-8"><?php echo $about ?></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8"><?php echo empty($address) ? '' : $address; ?></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8"><?php echo empty($phone) ? '' : $phone; ?></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?php echo $_SESSION['email'] ?></div>
                  </div>
                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                  <!-- Profile Edit Form -->
                  <form action="" method="post" enctype="multipart/form-data"> 
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        <img src="assets/img/<?php echo $profile ?>" alt="Profile" id="profilePreview">
                        <div class="pt-2">
                             <!-- Hidden file input with styled button -->
                          <input type="file" name="profile" id="profileImage" class="form-control d-none" onchange="previewProfileImage(event)">
                          <button type="button" class="btn btn-primary btn-sm" onclick="document.getElementById('profileImage').click()" title="Upload new profile image">
                              <i class="bi bi-upload"></i>
                          </button>
                          <button type="submit" name="delete_image" class="btn btn-danger btn-sm" title="Remove profile image">
                              <i class="bi bi-trash"></i>
                          </button>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="name" type="text" class="form-control" id="fullName" value="<?php echo $_SESSION['email'] ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="about" class="form-control" id="about" style="height: 100px"><?php echo empty($about) ? '' : $about; ?></textarea>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="address" type="text" class="form-control" id="Address" value="<?php echo empty($address) ? '' : $address; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phone" type="number" class="form-control" id="Phone" value="<?php echo $phone ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="Email" value="<?php echo $_SESSION['email'] ?>">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" name="update_user" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>
              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>
  </main><!-- End #main -->
<?php include "includes/footer.php" ?>