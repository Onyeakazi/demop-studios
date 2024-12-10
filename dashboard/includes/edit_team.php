<?php 
if (isset($_GET['id'])) {
    $Id = $_GET['id'];
}

$query = "SELECT * FROM team WHERE id = $Id";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);

$name = $row['name'];
$image = $row['image'];
$job = $row['job'];
$facebook = $row['facebook'];
$x = $row['x'];
$instagram = $row['instagram'];
$linkedin = $row['linkedin'];

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $job = $_POST['job'];
    $facebook = $_POST['facebook'];
    $x = $_POST['x'];
    $instagram = $_POST['instagram'];
    $linkedin = $_POST['linkedin'];
    
    // Check if a new image file was uploaded
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];

        // Move the uploaded file
        if (move_uploaded_file($image_tmp, "assets/img/$image")) {
            // Prepare update query including new image
            $query = "UPDATE team SET name = '{$name}', image = '{$image}', job = '{$job}', facebook = '{$facebook}', x = '{$x}', instagram = '{$instagram}', linkedin = '{$linkedin}' WHERE id = {$Id}";
        } else {
            echo '<script>
                    Swal.fire({
                        title: "Error!",
                        text: "Failed to move uploaded file. Please try again.",
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                  </script>';
            return;
        }
    } else {
        // No new media uploaded, keep the old media
        $query = "UPDATE team SET name = '{$name}', job = '{$job}', facebook = '{$facebook}', x = '{$x}', instagram = '{$instagram}', linkedin = '{$linkedin}'  WHERE id = {$Id}";
    }

    // Execute the update query
    $result = mysqli_query($connection, $query);
    if ($result) {
        echo '<script>
                Swal.fire({
                    title: "Success!",
                    text: "Updated successfully.",
                    icon: "success",
                    confirmButtonText: "OK"
                }).then(() => {
                    window.location.href = "team.php";
                });
              </script>';
    } else {
        echo '<script>
                Swal.fire({
                    title: "Error!",
                    text: "Failed to Update. Error: ' . mysqli_error($connection) . '",
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
                        <h5 class="card-title">Edit Team</h5>
                        <form action="" method="post" enctype="multipart/form-data" class="row g-3">
                            <div class="col-md-6">
                              <div class="form-floating">
                                  <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" class="form-control" id="floatingName" placeholder="Service Name" required>
                                  <label for="floatingName">Member Name</label>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-floating">
                                  <input type="text" name="job" value="<?php echo $job; ?>" class="form-control" id="floatingName" placeholder="Service Name" required>
                                  <label for="floatingName">Occupation</label>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-floating">
                                  <input type="text" name="facebook" value="<?php echo $facebook; ?>" class="form-control" id="floatingFacebook" placeholder="Facebook Link" required>
                                  <label for="floatingFacebook">Facebook Link</label>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-floating">
                                  <input type="text" name="x" value="<?php echo $x; ?>" class="form-control" id="floatingX" placeholder="Twitter Link (X)" required>
                                  <label for="floatingX">Twitter Link (X)</label>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-floating">
                                  <input type="text" name="instagram" value="<?php echo $instagram; ?>" class="form-control" id="floatingInstagram" placeholder="Instagram" required>
                                  <label for="floatingInstagram">Instagram</label>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-floating">
                                  <input type="text" name="linkedin" value="<?php echo $linkedin; ?>" class="form-control" id="floatingLinkedIn" placeholder="LinkedIn" required>
                                  <label for="floatingLinkedIn">LinkedIn</label>
                              </div>
                            </div>
                            <div class="col-md-6">
                                <input type="file" accept="image/*" name="image" id="inpfile" class="form-control" style="display: none;"><br>
                                <img id="image-preview" style="border-radius:10%; width:40%;" src="assets/img/<?php echo htmlspecialchars($image); ?>" alt=""><br><br>
                                <button type="button" id="upload-btn" class="btn btn-warning">Select File <i class="fa fa-image"></i></button>
                            </div>
                            <div class="text-start mt-3">
                                <button type="submit" name="update" class="btn btn-primary btn-lg">Add Member</button>
                            </div>
                        </form><!-- End floating Labels Form -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

