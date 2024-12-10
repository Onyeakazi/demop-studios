<?php 
    if (isset($_GET['id'])) {
        $Id = $_GET['id'];
    }

    $query = "SELECT * FROM services WHERE id = $Id";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);

    $media_name = $row['media_name'];
    $media = $row['media'];
    $details = $row['details'];
    $type = $row['type'];

    if (isset($_POST['update'])) {
        $media_name = $_POST['media_name'];
        $type = $_POST['type'];
        $details = $_POST['details'];
        
        // Check if a new media file was uploaded
        if (!empty($_FILES['media']['name'])) {
            $media = $_FILES['media']['name'];
            $media_tmp = $_FILES['media']['tmp_name'];

            // Move the uploaded file
            if (move_uploaded_file($media_tmp, "assets/img/$media")) {
                // Prepare update query including new media
                $query = "UPDATE services SET media_name = '{$media_name}', media = '{$media}', details = '{$details}', type = '{$type}', date = NOW() WHERE id = {$Id}";
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
            $query = "UPDATE services SET media_name = '{$media_name}', details = '{$details}', type = '{$type}', date = NOW() WHERE id = {$Id}";
        }

        // Execute the update query
        $result = mysqli_query($connection, $query);
        if ($result) {
            echo '<script>
                    Swal.fire({
                        title: "Success!",
                        text: "Service Updated successfully.",
                        icon: "success",
                        confirmButtonText: "OK"
                    }).then(() => {
                        window.location.href = "services.php";
                    });
                </script>';
        } else {
            echo '<script>
                    Swal.fire({
                        title: "Error!",
                        text: "Failed to Update Service. Error: ' . mysqli_error($connection) . '",
                        icon: "error",
                        confirmButtonText: "OK"
                    }).then(() => {
                        window.location.href = "services.php";
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
                            <h5 class="card-title">Edit Flyer</h5>
                            <!-- Floating Labels Form -->
                            <form action="" method="post" enctype="multipart/form-data" class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="media_name" value="<?php echo $media_name ?>" required class="form-control" id="floatingName" placeholder="Your Name">
                                        <label for="floatingName">Service Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select name="type" class="form-control" id="" required>
                                            <option value="#" disabled selected>Select Design Type</option>
                                            <option value="social_media" <?php echo ($type == 'social_media') ? 'selected' : ''; ?>>Social Media</option>
                                            <option value="event" <?php echo ($type == 'event') ? 'selected' : ''; ?>>Event, Movie & Posters</option>
                                            <option value="church" <?php echo ($type == 'church') ? 'selected' : ''; ?>>Church Designs</option>
                                            <option value="prints" <?php echo ($type == 'prints') ? 'selected' : ''; ?>>Prints</option>
                                            <option value="video" <?php echo ($type == 'video') ? 'selected' : ''; ?>>Video Editing</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                    <textarea name="details" required class="form-control" placeholder="Address" id="floatingTextarea" style="height: 100px;"><?php echo $details ?></textarea>
                                    <label for="floatingTextarea">Details</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- Video preview section -->
                                    <div id="videoPreview">
                                        <?php if (strpos($media, '.mp4') !== false || strpos($media, '.webm') !== false || strpos($media, '.ogg') !== false): ?>
                                            <video id="video-element" width='200' height='200' controls>
                                                <source src="assets/img/<?php echo htmlspecialchars($media); ?>" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        <?php endif; ?>
                                    </div>

                                    <!-- File input for video upload -->
                                    <input type="file" accept="video/mp4,video/webm,video/ogg" name="media" id="videoInput" class="form-control" style="display: none;" onchange="previewVideo(event)">
                                    <br>
                                    <button type="button" id="upload-btn-video" class="btn btn-warning" onclick="document.getElementById('videoInput').click();">Select Video <i class="fa fa-video"></i></button>
                                </div>
                                
                                <div class="text-start mt-3">
                                    <button type="submit" name="update" class="btn btn-primary btn-lg">Upload <i class="bi bi-check-circle"></i></button>
                                </div>
                            </form><!-- End floating Labels Form -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->
