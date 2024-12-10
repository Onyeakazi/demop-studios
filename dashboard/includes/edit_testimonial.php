<?php 
if (isset($_GET['id'])) {
    $Id = $_GET['id'];
}

$query = "SELECT * FROM testimonial WHERE id = $Id";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);

$name = $row['name'];
$image = $row['image'];
$review = $row['message'];
$job = $row['job'];

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $job = $_POST['job'];
    $review = $_POST['review'];
    
    // Check if a new image file was uploaded
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];

        // Move the uploaded file
        if (move_uploaded_file($image_tmp, "assets/img/$image")) {
            // Prepare update query including new media
            $query = "UPDATE testimonial SET name = '{$name}', image = '{$image}', message = '{$review}', job = '{$job}', date = NOW() WHERE id = {$Id}";
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
        // No new image uploaded, keep the old image
        $query = "UPDATE testimonial SET name = '{$name}', message = '{$review}', job = '{$job}', date = NOW() WHERE id = {$Id}";
    }

    // Execute the update query
    $result = mysqli_query($connection, $query);
    if ($result) {
        echo '<script>
                Swal.fire({
                    title: "Success!",
                    text: "Testimonial Updated successfully.",
                    icon: "success",
                    confirmButtonText: "OK"
                }).then(() => {
                    window.location.href = "view_testmonial.php";
                });
              </script>';
    } else {
        echo '<script>
                Swal.fire({
                    title: "Error!",
                    text: "Failed to Update Testimonial. Error: ' . mysqli_error($connection) . '",
                    icon: "error",
                    confirmButtonText: "OK"
                }).then(() => {
                    window.location.href = "view_testmonial.php";
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
                        <h5 class="card-title">Edit Testimonial</h5>
                        <form action="" method="post" enctype="multipart/form-data" class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="name" value="<?php echo $name; ?>" class="form-control" id="floatingName" placeholder="Your Name">
                                    <label for="floatingName">Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="job" value="<?php echo $job; ?>" class="form-control" id="floatingName" placeholder="Your Name">
                                    <label for="floatingName">Occupation</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea name="review" class="form-control" placeholder="Address" id="floatingTextarea" style="height: 100px;"><?php echo $review; ?></textarea>
                                    <label for="floatingTextarea">Review</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <img src="assets/img/<?php echo $image ?>" alt="Profile" id="image-preview" width="250">
                                <div class="pt-2">
                                    <input class="form-control" name="image" id="inpfile" type="file" accept="image/*,video/*" onchange="previewMedia(event)">
                                </div>
                            </div>
                            <div class="text-start mt-3">
                                <button type="submit" name="update" class="btn btn-primary btn-lg">Update Testimonial</button>
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
    const preview = document.getElementById('image-preview');
    
    // Check if a file is selected
    if (file) {
        const reader = new FileReader();

        // Event listener for when the file is loaded
        reader.onload = function(e) {
            // Check the file type and set the appropriate preview
            if (file.type.startsWith('image/')) {
                preview.src = e.target.result; // Display image
                preview.style.display = 'block'; // Show image
                preview.classList.remove('video-preview'); // Remove video class if exists
            } else if (file.type.startsWith('video/')) {
                preview.src = e.target.result; // Display video
                preview.style.display = 'block'; // Show video
                preview.classList.add('video-preview'); // Add a class for video styling
                preview.setAttribute('controls', 'controls'); // Add controls for video
            }
        }

        // Read the file as a data URL
        reader.readAsDataURL(file);
    }
}
</script>
