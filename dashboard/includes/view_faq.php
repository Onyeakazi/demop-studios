<main id="main" class="main">
  <div class="pagetitle">
    <h1>Frequently Asked Questions</h1>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <!-- Table with stripped rows -->
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Title</th>
                  <th scope="col">Details</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  // Pagination setup
                  $results_per_page = 10;
                  if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                  } else {
                    $page = 1;  // Default to the first page
                  }

                  // Calculate the starting row for the query
                  $start_from = ($page - 1) * $results_per_page;

                  // Fetch total number of records
                  $query_total = "SELECT COUNT(*) FROM faq";
                  $result_total = mysqli_query($connection, $query_total);
                  $total_rows = mysqli_fetch_array($result_total)[0];
                  $total_pages = ceil($total_rows / $results_per_page);

                  // Query to fetch only the records for the current page
                  $query = "SELECT * FROM faq LIMIT $start_from, $results_per_page";
                  $results = mysqli_query($connection, $query);

                  // Counter for serial numbers
                  $serial_number = $start_from + 1;
                  
                  while($row = mysqli_fetch_assoc($results)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $details = $row['details'];
                    
                    echo "<tr>";
                    echo "<th scope='row'>$serial_number</th>";
                    echo "<td>$title</td>";
                    echo "<td>$details</td>";
                    echo "<td><a class='btn btn-secondary' href='faq.php?source=edit&id={$id}'><i class='bi bi-collection'></i></a></td>";
                    echo "<td><a class='btn btn-danger' href='faq.php?delete={$id}'><i class='bi bi-trash'></i></a></td>";
                    echo "</tr>";

                    // Increment the serial number
                    $serial_number++;
                  }
                ?>
              </tbody>
            </table>
            <!-- End Table with stripped rows -->

            <?php 
              if (isset($_GET['delete'])) {
                $id = $_GET['delete'];

                $query = "DELETE FROM faq WHERE id = $id";
                $result = mysqli_query($connection, $query);

                if ($result) {
                  echo '<script>
                          Swal.fire({
                              title: "Success!",
                              text: "FAQ Deleted successfully.",
                              icon: "success",
                              confirmButtonText: "OK"
                          })
                      </script>';
                } else {
                    // Error handling for SQL query failure
                    echo '<script>
                          Swal.fire({
                              title: "Error!",
                              text: "Failed to Delete FAQ. Please try again. Error: ' . mysqli_error($connection) . '",
                              icon: "error",
                              confirmButtonText: "OK"
                          })
                      </script>';
                }

                header("Location: faq.php?source=view_faq");
              }       
            ?>

            <!-- Pagination Links -->
            <div class="pagination">
              <?php 
                // Previous page
                if ($page > 1) {
                  echo "<a href='faq.php?page=" . ($page - 1) . "'>&laquo; Previous</a>";
                }

                // Page numbers
                for ($i = 1; $i <= $total_pages; $i++) {
                  if ($i == $page) {
                    echo "<a class='active' href='faq.php?page=$i'>$i</a>";
                  } else {
                    echo "<a href='faq.php?page=$i'>$i</a>";
                  }
                }

                // Next page
                if ($page < $total_pages) {
                  echo "<a href='faq.php?page=" . ($page + 1) . "'>Next &raquo;</a>";
                }
              ?>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
</main><!-- End #main -->
