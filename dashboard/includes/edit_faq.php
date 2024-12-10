<?php 
  if (isset($_GET['id'])) {
      $Id = $_GET['id'];
  }

  $query = "SELECT * FROM faq WHERE id = $Id";
  $result = mysqli_query($connection, $query);
  $row = mysqli_fetch_assoc($result);

  $title = $row['title'];
  $details = $row['details'];

  if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $details = $_POST['details'];

    $result = mysqli_query($connection, $query);
    if ($result) {
        echo '<script>
                Swal.fire({
                    title: "Success!",
                    text: "Updated successfully.",
                    icon: "success",
                    confirmButtonText: "OK"
                }).then(() => {
                    window.location.href = "faq.php";
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
                    window.location.href = "faq.php";
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
                            <h5 class="card-title">Edit FAQ</h5>
                            <form action="" method="post" enctype="multipart/form-data" class="row g-3">
                                <div class="col-12">
                                    <div class="form-floating mb-3" >
                                        <input width="35" type="text" name="title" class="form-control" id="floatingName" placeholder="Your Name" value="<?php echo $title ?>">
                                        <label for="floatingName">FAQ Title</label>
                                    </div>
                                </div>
                                  
                                <div class="col-12 text-center">
                                    <div class="form-floating">
                                      <textarea name="details" class="form-control" placeholder="Address" id="floatingTextarea" style="height: 100px;"><?php echo $details ?></textarea>
                                      <label for="floatingTextarea">FAQ Details</label>
                                    </div>
                                    
                                    <div class="text-start mt-3">
                                        <button type="submit" name="update" class="btn btn-primary btn-lg">Update</button>
                                    </div>
                                </form><!-- End floating Labels Form -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->
