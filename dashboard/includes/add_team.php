<?php 
  if(isset($_POST['update'])) {  // Changed from 'submit' to 'update'
    $name = $_POST['name'];
    $job = $_POST['job'];
    $facebook = $_POST['facebook'];
    $x = $_POST['x'];
    $instagram = $_POST['instagram'];
    $linkedin = $_POST['linkedin'];

    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];

    if (move_uploaded_file($image_tmp, "assets/img/$image")) {
        $query = "INSERT INTO team(name, image, job, facebook, instagram, x, linkedin) ";
        $query .= "VALUES('{$name}', '{$image}', '{$job}', '{$facebook}', '{$instagram}', '{$x}', '{$linkedin}' )";

        $result = mysqli_query($connection, $query);

        if ($result) {
            echo '<script>
                    Swal.fire({
                        title: "Success!",
                        text: "Member uploaded successfully.",
                        icon: "success",
                        confirmButtonText: "OK"
                    }).then(() => {
                        window.location.href = "team.php";
                    });
                </script>';
        } else {
            // Error handling for SQL query failure
            echo '<script>
                    Swal.fire({
                        title: "Error!",
                        text: "Failed to upload Member. Please try again. Error: ' . mysqli_error($connection) . '",
                        icon: "error",
                        confirmButtonText: "OK"
                    }).then(() => {
                        window.location.href = "team.php"; 
                    });
                </script>';
        }
    } else {
        // Error handling for file upload failure
        echo '<script>
                Swal.fire({
                    title: "Error!",
                    text: "Failed to move uploaded file. Please try again.",
                    icon: "error",
                    confirmButtonText: "OK"
                }).then(() => {
                    window.location.href = "team.php";
                });
            </script>';
    }
  }
?>

<main id="main" class="main">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add Member</h5>
                        <form action="" method="post" enctype="multipart/form-data" class="row g-3">
                            <div class="col-md-6">
                              <div class="form-floating">
                                  <input type="text" name="name" class="form-control" id="floatingName" placeholder="Member Name" required>
                                  <label for="floatingName">Member Name</label>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-floating">
                                  <input type="text" name="job" class="form-control" id="floatingJob" placeholder="Occupation" required>
                                  <label for="floatingJob">Occupation</label>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-floating">
                                  <input type="text" name="facebook" class="form-control" id="floatingFacebook" placeholder="Facebook Link" required>
                                  <label for="floatingFacebook">Facebook Link</label>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-floating">
                                  <input type="text" name="x" class="form-control" id="floatingX" placeholder="Twitter Link (X)" required>
                                  <label for="floatingX">Twitter Link (X)</label>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-floating">
                                  <input type="text" name="instagram" class="form-control" id="floatingInstagram" placeholder="Instagram" required>
                                  <label for="floatingInstagram">Instagram</label>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-floating">
                                  <input type="text" name="linkedin" class="form-control" id="floatingLinkedIn" placeholder="LinkedIn" required>
                                  <label for="floatingLinkedIn">LinkedIn</label>
                              </div>
                            </div>
                            <div class="col-md-6">
                                <img src="assets/img/default.png" alt="Profile" id="image-preview" width="250">
                                <video id="video-preview" width="250" class="mb-3" controls style="display: none;"></video>
                                <div class="pt-2">
                                <input class="form-control" name="image" id="inpfile" type="file" accept="image/*,video/*" onchange="previewMedia(event)">
                            </div>
                            <div class="text-start mt-3">
                                <button type="submit" name="update" class="btn btn-primary btn-lg">Add Member</button>  <!-- Changed button name to 'update' -->
                            </div>
                        </form><!-- End floating Labels Form -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

<script>
    function previewMedia(event) {
        const file = event.target.files[0];
        const imagePreview = document.getElementById('image-preview');
        const videoPreview = document.getElementById('video-preview');

        // Reset previews
        imagePreview.style.display = 'none';
        videoPreview.style.display = 'none';
        imagePreview.src = '';
        videoPreview.src = '';

        // Check if a file is selected
        if (file) {
            const reader = new FileReader();

            // Event listener for when the file is loaded
            reader.onload = function(e) {
                // Check the file type and set the appropriate preview
                if (file.type.startsWith('image/')) {
                    imagePreview.src = e.target.result; // Set image source
                    imagePreview.style.display = 'block'; // Show image preview
                } else if (file.type.startsWith('video/')) {
                    videoPreview.src = e.target.result; // Set video source
                    videoPreview.style.display = 'block'; // Show video preview
                }
            }

            // Read the file as a data URL
            reader.readAsDataURL(file);
        }
    }
</script>
