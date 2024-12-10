<?php
    if(isset($_POST['submit'])) {
        $name = $_POST['name'];
        $job = $_POST['job'];
        $review = $_POST['review'];
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];

        if (move_uploaded_file($image_tmp, "assets/img/$image")) {
            $query = "INSERT INTO testimonial(name, image, message, date, job ) ";
            $query .= "VALUES('{$name}', '{$image}', '{$review}', NOW(), '{$job}' )";

            $result = mysqli_query($connection, $query);

            if ($result) {
                echo '<script>
                        Swal.fire({
                            title: "Success!",
                            text: "Testimonial uploaded successfully.",
                            icon: "success",
                            confirmButtonText: "OK"
                        }).then(() => {
                            window.location.href = "testimonial.php";
                        });
                    </script>';
            } else {
                // Error handling for SQL query failure
                echo '<script>
                        Swal.fire({
                            title: "Error!",
                            text: "Failed to upload Testimonial. Please try again. Error: ' . mysqli_error($connection) . '",
                            icon: "error",
                            confirmButtonText: "OK"
                        }).then(() => {
                            window.location.href = "testimonial.php";
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
                        window.location.href = "testimonial.php";
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
                        <h5 class="card-title">Add A Testimonial</h5>
                        <!-- Floating Labels Form -->
                        <form action="" method="post" enctype="multipart/form-data" class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="name" class="form-control" id="floatingName" placeholder="Your Name">
                                    <label for="floatingName">Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="job" class="form-control" id="floatingName" placeholder="Your Name">
                                    <label for="floatingName">Occupation</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                <textarea name="review" class="form-control" placeholder="Address" id="floatingTextarea" style="height: 100px;"></textarea>
                                <label for="floatingTextarea">Review</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <img src="assets/img/image placeholder.jpeg" alt="Profile" id="image-preview" width="250">
                                <video id="video-preview" width="250" class="mb-3" controls style="display: none;"></video>
                                <div class="pt-2">
                                <input class="form-control" name="image" id="inpfile" type="file" accept="image/*,video/*" onchange="previewMedia(event)">
                            </div>
                            
                            <div class="text-start mt-3">
                                <button type="submit" name="submit" class="btn btn-primary btn-lg">Add Testimonial</i></button>
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