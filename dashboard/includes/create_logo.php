<?php
    if(isset($_POST['submit'])) {
        $name = $_POST['name'];
        $date = $_POST['date'];
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];

        if (move_uploaded_file($image_tmp, "assets/img/$image")) {
            $query = "INSERT INTO client_logo(name, image, date ) ";
            $query .= "VALUES('{$name}', '{$image}', NOW() )";

            $result = mysqli_query($connection, $query);

            if ($result) {
                echo '<script>
                        Swal.fire({
                            title: "Success!",
                            text: "Logo uploaded successfully.",
                            icon: "success",
                            confirmButtonText: "OK"
                        }).then(() => {
                            window.location.href = "logo.php";
                        });
                    </script>';
            } else {
                // Error handling for SQL query failure
                echo '<script>
                        Swal.fire({
                            title: "Error!",
                            text: "Failed to upload Logo. Please try again. Error: ' . mysqli_error($connection) . '",
                            icon: "error",
                            confirmButtonText: "OK"
                        }).then(() => {
                            window.location.href = "logo.php"; 
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
                        window.location.href = "logo.php";
                    });
                </script>';
        }
    }
?>

<main id="main" class="main">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-center align-items-center vh-80">

                    <div class="card" style="width:46rem">
                        <div class="card-body">
                            <h5 class="card-title">Add A Client Logo</h5>
                            <!-- Floating Labels Form -->
                            <form action="" method="post" enctype="multipart/form-data" class="row g-3">
                                <div class="col-12">
                                    <div class="form-floating mb-3" >
                                        <input width="35" type="text" name="name" class="form-control" id="floatingName" placeholder="Your Name">
                                        <label for="floatingName">Logo Name</label>
                                    </div>
                                </div>
                                
                                <div class="col-12 text-center">
                                    <div class="col-md-6">
                                        <img src="assets/img/image placeholder.jpeg" alt="Profile" id="image-preview" width="250">
                                        <div class="pt-2">
                                            <input class="form-control" name="image" id="inpfile" type="file" accept="image/*,video/*" onchange="previewMedia(event)">
                                        </div>
                                    </div>
                                    
                                    <div class="text-start mt-3">
                                        <button type="submit" name="submit" class="btn btn-primary btn-lg">Add Logo <i class="bi bi-check-circle"></i></button>
                                    </div>
                                </div>
                            </form><!-- End floating Labels Form -->
                        </div>
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