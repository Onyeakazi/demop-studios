<?php 
if (isset($_GET['id'])) {
    $Id = $_GET['id'];
}

$query = "SELECT * FROM blog WHERE id = $Id";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);

$title = $row['title'];
$image = $row['image'];
$content = $row['content'];

if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $type = $_POST['type'];
    $content = $_POST['content'];
    
    // Check if a new image file was uploaded
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];

        // Move the uploaded file
        if (move_uploaded_file($image_tmp, "assets/img/$image")) {
            // Prepare update query including new image
            $query = "UPDATE blog SET title = '{$title}', image = '{$image}', content = '{$content}', date = NOW() WHERE id = {$Id}";
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
        $query = "UPDATE blog SET title = '{$title}', content = '{$content}', image = '{$image}', date = NOW() WHERE id = {$Id}";
    }

    // Execute the update query
    $result = mysqli_query($connection, $query);
    if ($result) {
        echo '<script>
                Swal.fire({
                    title: "Success!",
                    text: "Blog Updated successfully.",
                    icon: "success",
                    confirmButtonText: "OK"
                }).then(() => {
                    window.location.href = "blog.php";
                });
              </script>';
    } else {
        echo '<script>
                Swal.fire({
                    title: "Error!",
                    text: "Failed to Update Blog. Error: ' . mysqli_error($connection) . '",
                    icon: "error",
                    confirmButtonText: "OK"
                }).then(() => {
                    window.location.href = "blog.php";
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
                        <form action="" method="post" enctype="multipart/form-data" class="row g-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>" class="form-control" id="floatingName" placeholder="Blog Title" required>
                                    <label for="floatingName">Service Name</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea name="content" class="form-control" placeholder="content" id="floatingTextarea" style="height: 100px;" required><?php echo htmlspecialchars($content); ?></textarea>
                                    <label for="floatingTextarea">content</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <input type="file" accept="image/*" name="image" id="inpfile" class="form-control" style="display: none;"><br>
                                <img id="image-preview" style="border-radius:10%; width:40%;" src="assets/img/<?php echo htmlspecialchars($image); ?>" alt=""><br><br>
                                <button type="button" id="upload-btn" class="btn btn-warning">Select File <i class="fa fa-image"></i></button>
                            </div>
                            <div class="text-start mt-3">
                                <button type="submit" name="update" class="btn btn-primary btn-lg">Update <i class="bi bi-check-circle"></i></button>
                            </div>
                        </form><!-- End floating Labels Form -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

