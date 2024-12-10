<main id="main" class="main">
  <div class="pagetitle">
    <h1>Video Editing Services Page</h1>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">

            <?php
              $limit = 10; // Number of entries per page
              $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
              $offset = ($page - 1) * $limit;

              // Get total number of records
              $total_query = "SELECT COUNT(*) as total FROM services WHERE type = 'video'";
              $total_result = mysqli_query($connection, $total_query);
              $total_row = mysqli_fetch_assoc($total_result);
              $total = $total_row['total'];
              $total_pages = ceil($total / $limit);

              // Fetch data for current page
              $query = "SELECT * FROM services WHERE type = 'video' ORDER BY date DESC LIMIT $limit OFFSET $offset";
              $results = mysqli_query($connection, $query);

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
                <?php while($row = mysqli_fetch_assoc($results)) : ?>
                  <tr>
                    <th scope="row"><?= $serial_number++ ?></th>
                    <td>
                      <?php if ($row['type'] === 'video') : ?>
                        <video width="200" height="200" controls>
                          <source src="assets/img/<?= $row['media'] ?>" type="video/mp4">
                          Your browser does not support the video tag.
                        </video>
                      <?php else : ?>
                        <img src="assets/img/<?= $row['media'] ?>" alt="<?= $row['media_name'] ?>" width="100">
                      <?php endif; ?>
                    </td>
                    <td><?= $row['media_name'] ?></td>
                    <td><?= $row['details'] ?></td>
                    <td><?= $row['type'] ?></td>
                    <td><?= $row['date'] ?></td>
                    <td>
                      <a class="btn btn-secondary" href="services.php?source=edit_video&id=<?= $row['id'] ?>">
                        <i class="bi bi-collection"></i>
                      </a>
                      <a class="btn btn-danger" href="services.php?delete=<?= $row['id'] ?>">
                        <i class="bi bi-trash"></i>
                      </a>
                    </td>
                  </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
            <!-- End Table with stripped rows -->

            <!-- Pagination Links -->
            <nav aria-label="Page navigation">
              <ul class="pagination justify-content-center">
                <?php if($page > 1): ?>
                  <li class="page-item">
                    <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
                <?php endif; ?>

                <?php for($i = 1; $i <= $total_pages; $i++): ?>
                  <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                  </li>
                <?php endfor; ?>

                <?php if($page < $total_pages): ?>
                  <li class="page-item">
                    <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>
                <?php endif; ?>
              </ul>
            </nav>

            <?php 
              if(isset($_GET['delete'])) {
                $id = $_GET['delete'];
                $query = "DELETE FROM services WHERE id = $id";
                $result = mysqli_query($connection, $query);

                if ($result) {
                  echo '<script>
                          Swal.fire({
                              title: "Success!",
                              text: "Service Deleted successfully.",
                              icon: "success",
                              confirmButtonText: "OK"
                          })
                      </script>';
                } else {
                  echo '<script>
                          Swal.fire({
                              title: "Error!",
                              text: "Failed to Delete Service. Please try again. Error: ' . mysqli_error($connection) . '",
                              icon: "error",
                              confirmButtonText: "OK"
                          })
                      </script>';
                }
              }       
            ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</main><!-- End #main -->
