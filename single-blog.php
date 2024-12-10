<?php include "includes/header.php" ?>

  <?php include "includes/navbar.php" ?>

  <?php 
    // Get the blog ID from the URL
    $id = $_GET['id'];

    // Query to fetch the blog post details
    $query = "SELECT * FROM blog WHERE id = $id";
    $result = mysqli_query($connection, $query);

    // Check if the blog post exists
    if ($row = mysqli_fetch_assoc($result)) {
        $title = $row['title'];
        $content = $row['content'];
        $image = $row['image'];
        $date = date('M d, Y', strtotime($row['date']));
    } else {
        echo "Blog post not found.";
        exit;
    }
    ?>
  
  ?>

    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">
        <!-- DISPLAY NAVBAR -->
        <?php include ("includes/navbar.php") ?>
        <div class="container-fluid bg-primary py-1 mb-5 hero-header" style="background-image: linear-gradient(rgba(20, 20, 31, .4), rgba(20, 20, 31, .4)), url(assets/img/sinlge-blog.jpg); background-repeat: no-repeat; background-size: cover;">
            <div class="container py-5">
                <div class="row justify-content-center py-5">
                    <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                        <h1 class="display-3 text-white animated slideInDown" style="font-weight: 700;">Continue <span class="span">Reading</span></h1>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
    <!-- Navbar & Hero End -->

    <div class="container-xxl py-5">
        <div class="container">
            <!-- Blog Image -->
            <div class="blog-image">
                <img src="./dashboard/assets/img/<?php echo $image?>" alt="How to Travel with a Pocket-Friendly Amount" style="margin-bottom: 2rem; width: 100%;">
            </div>
            <!-- Blog Content -->
            <div class="content text-dark">
                <h1 class="fw-bolder"><?php echo $title ?></h1>
                <div class="meta" style="color: grey; margin-bottom: 2rem;">
                    <span>By Demop Studios</span> | <span><?php echo $date ?></span>
                </div>
                <div class="details" style="font-size: 19px;">
                    <?php 
                        // Echo the blog content
                        echo nl2br($content); // Use nl2br to preserve line breaks from the database
                    ?>
                </div>
                
                <!-- Read More Section -->
                <div class="read-more">
                    <a href="blog">Explore More Blogs</a>
                </div>
            </div>
            </div>
        </div> 
    </div>
    <!-- OUR BLOG End -->
<?php include ("includes/footer.php") ?>