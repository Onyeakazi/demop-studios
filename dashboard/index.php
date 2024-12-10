
<?php include "includes/header.php" ?>

  <!-- ======= Header ======= -->
  <?php include "includes/navbar.php"?>  
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
   <?php include "includes/sidebar.php" ?>
  <!-- End Sidebar-->

  
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">
            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">
                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>
                    <li><a style="margin-left: 17px;" href="services.php?source=images" class="text-success small pt-1 fw-bold">View All Graphics </a> </li>
                    <li><a style="margin-left: 17px;" href="services.php?source=videos" class="text-success small pt-1 fw-bold">View All Videos </a> </li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Services</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-briefcase"></i>
                    </div>
                    <div class="ps-3">
                      <?php 
                        $query = "SELECT * FROM services ";
                        $result = mysqli_query($connection, $query);
                        $service_count = mysqli_num_rows($result); 

                        echo "<h6>{$service_count}</h6>";
                      ?>
                      <a href="services.php?source=images" class="text-success small pt-1 fw-bold">View</a>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Sales Card -->

            <!-- Logo Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card customers-card">
                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>
                    <li><a style="margin-left: 17px;" href="logo.php?source=view_logo" class="text-success small pt-1 fw-bold">View All</a> </li>
                  </ul>
                </div>
                <div class="card-body">
                  <h5 class="card-title">Logos</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="fas fa-handshake"></i>
                    </div>
                    <div class="ps-3">
                      <?php 
                        $query = "SELECT * FROM client_logo ";
                        $result = mysqli_query($connection, $query);
                        $count = mysqli_num_rows($result); 

                        echo "<h6>{$count}</h6>"
                        
                      ?>
                      <a href="logo.php?source=view_logo" class="text-success small pt-1 fw-bold">View</a> 
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Logo Card -->

            <!-- Testimonial Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card customers-card1">
                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>
                    <li><a style="margin-left: 17px;" href="testimonial.php?source=view_all" class="text-success small pt-1 fw-bold">View All</a> </li>
                  </ul>
                </div>
                <div class="card-body">
                  <h5 class="card-title">Testimonial</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="fas fa-star"></i>
                    </div>
                    <div class="ps-3">
                      <?php 
                        $query = "SELECT * FROM testimonial ";
                        $result = mysqli_query($connection, $query);
                        $count = mysqli_num_rows($result); 

                        echo "<h6>{$count}</h6>"
                      ?>
                      <a href="testimonial.php?source=view_all" class="text-success small pt-1 fw-bold">View</a> 
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Testimonial Card -->

            <!-- Team Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card customers-card2">
                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>
                    <li><a style="margin-left: 17px;" href="team.php?source=view_all" class="text-success small pt-1 fw-bold">View All</a> </li>
                  </ul>
                </div>
                <div class="card-body">
                  <h5 class="card-title">Team</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people-fill"></i>
                    </div>
                    <div class="ps-3">
                      <?php 
                        $query = "SELECT * FROM team ";
                        $result = mysqli_query($connection, $query);
                        $count = mysqli_num_rows($result); 

                        echo "<h6>{$count}</h6>"
                      ?>
                      <a href="team.php?source=view_all" class="text-success small pt-1 fw-bold">View</a> 
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Team Card -->

            <!-- FAQ Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">
                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>
                    <li><a style="margin-left: 17px;" href="faq.php?source=view_all" class="text-success small pt-1 fw-bold">View All</a> </li>
                  </ul>
                </div>
                <div class="card-body">
                  <h5 class="card-title">F.A.Q</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-question-circle"></i>
                    </div>
                    <div class="ps-3">
                      <?php 
                        $query = "SELECT * FROM faq ";
                        $result = mysqli_query($connection, $query);
                        $count = mysqli_num_rows($result); 

                        echo "<h6>{$count}</h6>"
                      ?>
                      <a href="faq.php?source=view_all" class="text-success small pt-1 fw-bold">View</a> 
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End FAQ Card -->

            <!-- Blog Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">
                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-chat-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>
                    <li><a style="margin-left: 17px;" href="blog.php?source=view_all" class="text-success small pt-1 fw-bold">View All</a> </li>
                  </ul>
                </div>
                <div class="card-body">
                  <h5 class="card-title">Blog</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-chat-dots"></i>
                    </div>
                    <div class="ps-3">
                      <?php 
                        $query = "SELECT * FROM blog ";
                        $result = mysqli_query($connection, $query);
                        $count = mysqli_num_rows($result); 

                        echo "<h6>{$count}</h6>"
                      ?>
                      <a href="blog.php?source=view_all" class="text-success small pt-1 fw-bold">View</a> 
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End FAQ Card -->
          </div>
        </div><!-- End Left side columns -->
      </div>
    </section>
  </main><!-- End #main -->

<?php include "includes/footer.php" ?>