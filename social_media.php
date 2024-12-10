<?php include "includes/header.php" ?>

  <?php include "includes/navbar.php" ?>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8 service-details-section">
              <h1>Service Details</h1>
              <p class="mb-0 mt-3">Explore the creative journey behind our work. Each project in our portfolio is a testament to our commitment to bringing bold ideas to life. From concept to completion, we prioritize quality and precision, ensuring every detail aligns with our clients' unique vision. Here, you’ll see how we transform concepts into powerful visuals, tailored to make a lasting impact in today’s competitive landscape. Dive into our portfolio and discover how we can elevate your brand with our creative expertise.</p>
            </div>
          </div>
        </div>
      </div>
    </div><!-- End Page Title -->

    <!-- Service Details Section -->
    <section id="service-details" class="service-details section">
      <div class="container">
        <div class="row gy-1">

            <?php 
                $query = "SELECT * FROM services WHERE type = 'social_media' ";
                $result = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($result)) {
                    $media_name = $row['media_name'];
                    $media = $row['media'];
                    // $details = $row['details'];
                    // $type = $row['type'];
                    // $date = $row['date'];
            ?>
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="service-box">
                    <div>
                        <img src="./dashboard/assets/img/<?php echo $media ?>" alt="" class="img-fluid services-img">
                    </div>
                    <h2 >
            <?php echo $media_name ?>
        </h2>
                </div><!-- End Services List -->
            </div>

            <?php } ?>
        </div>
      </div>
    </section><!-- /Service Details Section -->
  </main>

  <?php include "includes/footer.php" ?>