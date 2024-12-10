<main id="main" class="main">
  <div class="pagetitle">
    <h1>Our Team</h1>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">

            <?php
              // Set the number of items per page
              $results_per_page = 10;

              // Find out the number of results in the database
              $query = "SELECT COUNT(id) AS total FROM team";
              $result = mysqli_query($connection, $query);
              $row = mysqli_fetch_assoc($result);
              $total_results = $row['total'];

              // Calculate the total number of pages
              $total_pages = ceil($total_results / $results_per_page);

              // Determine the current page
              $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

              // Calculate the starting limit for the SQL query
              $start_limit = ($page - 1) * $results_per_page;

              // Fetch the data with pagination
              $query = "SELECT * FROM team LIMIT $start_limit, $results_per_page";
              $results = mysqli_query($connection, $query);
            ?>

            <!-- Table with stripped rows -->
            <table class="table table-borderless table-hover">
              <thead>
                <tr>
                  <th scope="col">S/N</th>
                  <th scope="col">Image</th>
                  <th scope="col">Name</th>
                  <th scope="col">Occupation</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $serial_number = $start_limit + 1; // Adjust serial number based on current page
                  while($row = mysqli_fetch_assoc($results)) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $image = $row['image'];
                    $job = $row['job'];

                    echo "<tr>";
                    echo "<th scope='row'>$serial_number</th>";
                    echo "<td><img src='assets/img/$image' alt='$name' width='100'></td>";
                    echo "<td>$name</td>";
                    echo "<td>$job</td>";
                    echo "<td><a class='btn btn-secondary' href='team.php?source=edit&id={$id}'><i class='bi bi-collection'></i></a></td>";
                    echo "<td><a class='btn btn-danger' href='team.php?delete={$id}'><i class='bi bi-trash'></i></a></td>";
                    echo "</tr>";

                    $serial_number++;
                  }
                ?>
              </tbody>
            </table>
            <!-- End Table with stripped rows -->

            <!-- Pagination -->
            <nav>
              <ul class="pagination">
                <?php if($page > 1): ?>
                  <li class="page-item"><a class="page-link" href="?page=<?php echo $page-1; ?>">Previous</a></li>
                <?php endif; ?>

                <?php for($i = 1; $i <= $total_pages; $i++): ?>
                  <li class="page-item <?php if($i == $page) echo 'active'; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                  </li>
                <?php endfor; ?>

                <?php if($page < $total_pages): ?>
                  <li class="page-item"><a class="page-link" href="?page=<?php echo $page+1; ?>">Next</a></li>
                <?php endif; ?>
              </ul>
            </nav>
            <!-- End Pagination -->

            <?php 
              // Deletion functionality
              if (isset($_GET['delete'])) {
                  $id = $_GET['delete'];

                  // Fetch the media (image) associated with the testimonial
                  $query = "SELECT image FROM team WHERE id = $id";
                  $result = mysqli_query($connection, $query);

                  if ($result && mysqli_num_rows($result) > 0) {
                      // Get the media file name
                      $row = mysqli_fetch_assoc($result);
                      $image = $row['image'];

                      // Define the path to the image file
                      $image_path = "assets/img/" . $image;

                      // Check if the image file exists and delete it
                      if (file_exists($image_path)) {
                          unlink($image_path); // Delete the image file from the server
                      }

                      // Now delete the record from the database
                      $query_delete = "DELETE FROM team WHERE id = $id";
                      $result_delete = mysqli_query($connection, $query_delete);

                      // Check if deletion was successful
                      if ($result_delete) {
                          echo '<script>
                                  Swal.fire({
                                      title: "Success!",
                                      text: "Team and associated image deleted successfully.",
                                      icon: "success",
                                      confirmButtonText: "OK"
                                  })
                              </script>';
                      } else {
                          echo '<script>
                                  Swal.fire({
                                      title: "Error!",
                                      text: "Failed to Delete Team from the database. Please try again. Error: ' . mysqli_error($connection) . '",
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
                  header("Location: team.php?source=view_all");
                  exit(); // Make sure no further script execution occurs after redirection
              }
            ?>

          </div>
        </div>
      </div>
    </div>
  </section>
</main><!-- End #main -->