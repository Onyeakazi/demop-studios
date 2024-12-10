<main id="main" class="main">
  <div class="pagetitle">
    <h1>Testimonial Reviews</h1>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <?php
              // Set the number of items per page
              $limit = 10;

              // Determine the current page
              $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
              $page = max($page, 1); // Ensure the page is at least 1

              // Calculate the offset for the query
              $offset = ($page - 1) * $limit;

              // Query to get the total number of testimonials
              $total_query = "SELECT COUNT(*) as total FROM testimonial";
              $total_result = mysqli_query($connection, $total_query);
              $total_row = mysqli_fetch_assoc($total_result);
              $total_testimonials = $total_row['total'];

              // Calculate the total number of pages
              $total_pages = ceil($total_testimonials / $limit);

              // Query to get the testimonials for the current page
              $query = "SELECT * FROM testimonial ORDER BY date DESC LIMIT $limit OFFSET $offset";
              $results = mysqli_query($connection, $query);

              // Counter for serial numbers
              $serial_number = $offset + 1;
            ?>

            <!-- Table with stripped rows -->
            <table class="table table-borderless table-hover">
              <thead>
                <tr>
                  <th scope="col">S/N</th>
                  <th scope="col">Name</th>
                  <th scope="col">Review</th>
                  <th scope="col">Image</th>
                  <th scope="col">Occupation</th>
                  <th scope="col">Date Created</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($row = mysqli_fetch_assoc($results)) {
                  $id = $row['id'];
                  $name = $row['name'];
                  $image = $row['image'];
                  $job = $row['job'];
                  $message = $row['message'];
                  $date = $row['date'];
                ?>
                  <tr>
                    <th scope="row"><?php echo $serial_number; ?></th>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $message; ?></td>
                    <td><img src="assets/img/<?php echo $image; ?>" alt="<?php echo $name; ?>" width="100"></td>
                    <td><?php echo $job; ?></td>
                    <td><?php echo $date; ?></td>
                    <td><a class="btn btn-secondary" href="testimonial.php?source=edit&id=<?php echo $id; ?>"><i class="bi bi-collection"></i></a></td>
                    <td><a class="btn btn-danger" href="testimonial.php?delete=<?php echo $id; ?>"><i class="bi bi-trash"></i></a></td>
                  </tr>
                <?php 
                  $serial_number++;
                } ?>
              </tbody>
            </table>
            <!-- End Table with stripped rows -->

            <!-- Pagination Links -->
            <nav aria-label="Page navigation">
              <ul class="pagination justify-content-center">
                <?php if ($page > 1): ?>
                  <li class="page-item">
                    <a class="page-link" href="testimonial.php?source=view_all&page=<?php echo $page - 1; ?>">Previous</a>
                  </li>
                <?php endif; ?>
                
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                  <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                    <a class="page-link" href="testimonial.php?source=view_all&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                  </li>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                  <li class="page-item">
                    <a class="page-link" href="testimonial.php?source=view_all&page=<?php echo $page + 1; ?>">Next</a>
                  </li>
                <?php endif; ?>
              </ul>
            </nav>

            <?php 
              // Deletion functionality
              if (isset($_GET['delete'])) {
                  $id = $_GET['delete'];

                  // Fetch the media (image) associated with the testimonial
                  $query = "SELECT image FROM testimonial WHERE id = $id";
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
                      $query_delete = "DELETE FROM testimonial WHERE id = $id";
                      $result_delete = mysqli_query($connection, $query_delete);

                      // Check if deletion was successful
                      if ($result_delete) {
                          echo '<script>
                                  Swal.fire({
                                      title: "Success!",
                                      text: "Testimonial and associated image deleted successfully.",
                                      icon: "success",
                                      confirmButtonText: "OK"
                                  })
                              </script>';
                      } else {
                          echo '<script>
                                  Swal.fire({
                                      title: "Error!",
                                      text: "Failed to Delete Testimonial from the database. Please try again. Error: ' . mysqli_error($connection) . '",
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
                  header("Location: testimonial.php?source=view_all");
                  exit(); // Make sure no further script execution occurs after redirection
              }
            ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</main><!-- End #main -->
