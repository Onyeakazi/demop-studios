<?php include "includes/header.php" ?>

  <?php include "includes/navbar.php" ?>

    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">
        <!-- DISPLAY NAVBAR -->
        <?php include ("includes/navbar.php") ?>
        <div class="container-fluid bg-primary py-1 mb-5 hero-header" style="background-image: linear-gradient(rgba(20, 20, 31, .4), rgba(20, 20, 31, .4)), url(assets/img/blog55.jpg);">
            <div class="container py-5">
                <div class="row justify-content-center py-5">
                    <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                        <h1 class="display-3 text-white animated slideInDown" style="font-weight: 700;">Our <span class="span">Blog</span></h1>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
    <!-- Navbar & Hero End -->

    <!-- OUR BLOG Start -->
    <div class="container-xxl py-5">
      <div class="container">
        <div class="title text-center wow fadeInUp" data-wow-delay="0.1s">
          <h6 class="bg-white text-center text-primary px-3">OUR BLOG</h6>
          <h1 class="mb-8" style="margin-bottom: 46px;">Read Our Latest News</h1>
        </div>
        <div class="row g-4 justify-content-center">
          <?php 
          $query = "SELECT * FROM blog";
          $result = mysqli_query($connection, $query);
          
          while($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $title = $row['title'];
            $content = $row['content'];
            $image = $row['image'];

          ?>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
              <div class="package-item" style="position: relative; border-radius: 10px; overflow: hidden; position: relative; border-radius: 10px; overflow: hidden; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2); transition: box-shadow 0.3s ease;" onmouseover="this.style.boxShadow='0px 6px 15px rgba(0, 0, 0, 0.3)'" onmouseout="this.style.boxShadow='0px 4px 10px rgba(0, 0, 0, 0.2)'">
                  <!-- Image with zoom effect on hover -->
                <div class="overflow-hidden" style="height: 200px;">
                    <img class="img-fluid" src="./dashboard/assets/img/<?php echo $image?>" alt="" 
                        style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;" 
                        onmouseover="this.style.transform='scale(1.1)'" 
                        onmouseout="this.style.transform='scale(1)'">
                </div>
                  
                <!-- Blog content -->
                <div class="p-4" style="text-align: left;">
                  <h3 style="margin-bottom: 15px; font-size: 20px;">
                      <a href="#" class="text-dark" style="text-decoration: none; font-weight: 700;"><?php echo $title ?></a>
                  </h3>
                  <p style="color: gray; font-size: 14px; line-height: 1.6; max-height: 3.6em; overflow: hidden; text-overflow: ellipsis;"><?php echo $content?></p>
                  <a href="single-blog?id=<?php echo $id ?>" style="position: absolute; bottom: 0px; left: 10px; padding: 5px 15px; font-size: 14px; color: blue; text-decoration: none; transition: all 0.3s ease;">Read More</a>
                </div>
                  
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
    <!-- OUR BLOG End -->
<?php include ("includes/footer.php") ?>