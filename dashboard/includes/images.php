<main id="main" class="main">
  <div class="pagetitle">
    <h1>Graphics Services Page</h1>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <?php
              // Pagination setup
              $limit = 10; // Number of entries per page
              $page = isset($_GET['page']) ? $_GET['page'] : 1;
              $offset = ($page - 1) * $limit;

              // Get total number of records
              $query_total = "SELECT COUNT(*) AS total FROM services WHERE type != 'video'";
              $result_total = mysqli_query($connection, $query_total);
              $total_data = mysqli_fetch_assoc($result_total)['total'];
              $total_pages = ceil($total_data / $limit);

              // Fetch limited records
              $query = "SELECT * FROM services WHERE type != 'video' ORDER BY date DESC LIMIT $offset, $limit";
              $results = mysqli_query($connection, $query);

              // Counter for serial numbers based on pagination
              $serial_number = $offset + 1;
            ?>

            <!-- Table with stripped rows -->
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Image</th>
                  <th scope="col">Name</th>
                  <th scope="col">Details</th>
                  <th scope="col">Type</th>
                  <th scope="col">Date Created</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  while($row = mysqli_fetch_assoc($results)) {
                    $id = $row['id'];
                    $media_name = $row['media_name'];
                    $media = $row['media'];
                    $details = $row['details'];
                    $type = $row['type'];
                    $date = $row['date'];
                    
                    echo "<tr>";
                    echo "<th scope='row'>$serial_number</th>";
                    echo "<td><img src='assets/img/$media' alt='$media_name' width='100'></td>";
                    echo "<td>$media_name</td>";
                    echo "<td>$details</td>";
                    echo "<td>$type</td>";
                    echo "<td>$date</td>";
                    echo "<td><a class='btn btn-secondary' href='services.php?source=edit_graphics&id={$id}'><i class='bi bi-collection'></i></a></td>";
                    echo "<td><a class='btn btn-danger' href='services.php?delete={$id}'><i class='bi bi-trash'></i></a></td>";
                    echo "</tr>";

                    $serial_number++;
                  }
                ?>
              </tbody>
            </table>
            <!-- End Table with stripped rows -->

            <!-- Pagination Controls -->
            <nav aria-label="Page navigation">
              <ul class="pagination">
                <?php if($page > 1): ?>
                  <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
                <?php endif; ?>

                <?php for($i = 1; $i <= $total_pages; $i++): ?>
                  <li class="page-item <?php if($i == $page) echo 'active'; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                  </li>
                <?php endfor; ?>

                <?php if($page < $total_pages): ?>
                  <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>
                <?php endif; ?>
              </ul>
            </nav>

            <?php 
              // Deletion functionality
              if (isset($_GET['delete'])) {
                  $id = $_GET['delete'];

                  // Fetch the media (image) associated with the testimonial
                  $query = "SELECT media FROM services WHERE id = $id";
                  $result = mysqli_query($connection, $query);

                  if ($result && mysqli_num_rows($result) > 0) {
                      // Get the media file name
                      $row = mysqli_fetch_assoc($result);
                      $media = $row['media'];

                      // Define the path to the image file
                      $image_path = "assets/img/" . $media;

                      // Check if the image file exists and delete it
                      if (file_exists($image_path)) {
                          unlink($image_path); // Delete the image file from the server
                      }

                      // Now delete the record from the database
                      $query_delete = "DELETE FROM services WHERE id = $id";
                      $result_delete = mysqli_query($connection, $query_delete);

                      // Check if deletion was successful
                      if ($result_delete) {
                          echo '<script>
                                  Swal.fire({
                                      title: "Success!",
                                      text: "Service deleted successfully.",
                                      icon: "success",
                                      confirmButtonText: "OK"
                                  })
                              </script>';
                      } else {
                          echo '<script>
                                  Swal.fire({
                                      title: "Error!",
                                      text: "Failed to Delete Service from the database. Please try again. Error: ' . mysqli_error($connection) . '",
                                      icon: "error",
                                      confirmButtonText: "OK"
                                  })
                              </script>';
                      }
                  } else {
                      echo '<script>
                              Swal.fire({
                                  title: "Error!",
                                  text: "Image file not found. Unable to delete.",
                                  icon: "error",
                                  confirmButtonText: "OK"
                              })
                          </script>';
                  }

                  // Redirect back to the testimonial view page after deletion
                  header("Location: services.php?source=view_all");
                  exit(); // Make sure no further script execution occurs after redirection
              }
            ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</main><!-- End #main -->

