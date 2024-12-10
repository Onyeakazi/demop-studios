<?php include "includes/header.php" ?>

  <?php include "includes/navbar.php" ?>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

      <img src="assets/img/hero-bg.jpg" alt="" data-aos="fade-in">

      <div class="container">
        <div class="row justify-content-center text-center" data-aos="fade-up" data-aos-delay="100">
          <div class="col-xl-9 col-lg-8">
            <h2>Exceptional Design Drives Exceptional Results</h2>
            <p>We don’t just create visuals; we craft immersive experiences that captivate & inspire. From concept to completion, our creative journey is tailored to bring your vision to life.</p>
          </div>
        </div>
        <div data-aos="fade-down" data-aos-delay="100">
          <a class="btn-hero" href="https://wa.me/message/XPYMUZXOJWTKB1">LET'S WORK <i class="bi bi-chat-dots"></i></a>
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- Services Section -->
    <section id="services" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <p>Check out our Portfolios</p>
      </div><!-- End Section Title -->

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="bi bi-images"></i>
              </div>
              <a href="social_media" class="stretched-link">
                <h3>Social Media Designs</h3>
              </a>
              <p>Boost your online presence with stunning, engaging social media graphics that capture attention and amplify your brand's message.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="bi bi-file-earmark-play"></i>
              </div>
              <a href="event" class="stretched-link">
                <h3>Event, Movie & Party Posters</h3>
              </a>
              <p>Make a memorable impact with eye-catching posters for any occasion, from events to movies and parties, designed to stand out.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="bi bi-journal-bookmark"></i>
              </div>
              <a href="church" class="stretched-link">
                <h3>Church Designs</h3>
              </a>
              <p>Communicate your faith and church events effectively with beautiful and respectful designs that resonate with your audience.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="bi bi-palette"></i>
              </div>
              <a href="https://www.behance.net/gallery/211508083/Pyrex-Couture-Brand-Identity-Design-(Fashion-Brand)" class="stretched-link">
                <h3>Brand Identity & Logo Design</h3>
              </a>
              <p>Build a strong brand presence with a unique and recognizable logo and brand identity tailored to represent your core values.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="bi bi-film"></i>
              </div>
              <a href="video_editing" class="stretched-link">
                <h3>Video Editing</h3>
              </a>
              <p>Transform your raw footage into compelling stories with our professional video editing services that bring your vision to life.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="bi bi-printer"></i>
              </div>
              <a href="prints" class="stretched-link">
                <h3>Prints</h3>
              </a>
              <p>High-quality prints for all your needs, from business cards to banners, ensuring vibrant and durable results every time.</p>
            </div>
          </div><!-- End Service Item -->
        </div>
      </div>
    </section><!-- /Services Section -->
    
    <!-- Clients Section -->
    <section id="clients" class="clients section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
                "loop": true,
                "speed": 600,
                "autoplay": {
                    "delay": 5000
                },
                "slidesPerView": "auto",
                "pagination": {
                    "el": ".swiper-pagination",
                    "type": "bullets",
                    "clickable": true
                },
                "breakpoints": {
                    "320": {
                        "slidesPerView": 2,
                        "spaceBetween": 40
                    },
                    "480": {
                        "slidesPerView": 3,
                        "spaceBetween": 60
                    },
                    "640": {
                        "slidesPerView": 4,
                        "spaceBetween": 80
                    },
                    "992": {
                        "slidesPerView": 6,
                        "spaceBetween": 120
                    }
                }
            }
          </script>

          <div class="swiper-wrapper align-items-center">
              <?php
                  $query = "SELECT * FROM client_logo";
                  $result = mysqli_query($connection, $query);

                  while($row = mysqli_fetch_assoc($result)) {
                      $image = $row['image']; // Assuming 'image' is the column name in your database
              ?>
                  <div class="swiper-slide">
                      <img src="./dashboard/assets/img/<?php echo htmlspecialchars($image); ?>" class="img-fluid" alt="Client Logo">
                  </div>
              <?php 
                  }
              ?>
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </section><!-- /Clients Section -->

    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section dark-background">

      <img src="assets/img/cta-bg.jpg" alt="">

      <div class="container">
        <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
          <div class="col-xl-10">
            <div class="text-center">
              <h3>Our creative process involves you at every step, ensuring the final result perfectly aligns with your vision and goals.</h3>
              <a class="cta-btn" href="https://wa.me/message/XPYMUZXOJWTKB1">I NEED A DESIGN</a>
            </div>
          </div>
        </div>
      </div>

    </section><!-- /Call To Action Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">
          <div class="col-lg-6 order-1 order-lg-2">
            <img src="assets/img/david1.jpg" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 order-2 order-lg-1 content">
            <h3>About Us</h3>
            <p class="fst-italic">
              DEMOP STUDIOS exists to bring your brand’s unique story to life. We are a full-service creative studio specializing in graphic design, brand identity, video editing, and printing. Our goal is to help you communicate your brand’s vision with clarity and impact, creating designs that not only capture attention but also drive action.
            </p>
            <p>
              With our team’s dedication and expertise, we go beyond simply delivering services; we focus on achieving results that align with your brand's mission and values. Our approach to creative design and branding is comprehensive, covering every step from initial concept to the final product. At DEMOPSTUDIOS, we take pride in crafting impactful visual solutions tailored to your unique goals.
            </p>
          </div>
        </div>

      </div>

    </section><!-- /About Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section dark-background">

      <img src="assets/img/testimonials-bg.jpg" class="testimonials-bg" alt="">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <?php
        // Assuming you have a database connection established as $connection
        $query = "SELECT * FROM testimonial";  // Replace 'testimonials' with your actual table name
        $result = mysqli_query($connection, $query);
        ?>

        <div class="swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              }
            }
          </script>
          <div class="swiper-wrapper">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
              <div class="swiper-slide" mb-0>
                <div class="testimonial-item">
                  <!-- Display image from the database or use a default placeholder -->
                  <img src="./dashboard/assets/img/<?php echo htmlspecialchars($row['image']); ?>" class="testimonial-img" alt="Client Image">
                  
                  <!-- Display name and role -->
                  <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                  <h4><?php echo htmlspecialchars($row['job']); ?></h4>
                  
                  <!-- Display stars based on rating from the database -->
                  <div class="stars">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                  </div>
                  
                  <!-- Display testimonial text -->
                  <p>
                    <i class="bi bi-quote quote-icon-left"></i>
                    <span><?php echo htmlspecialchars($row['message']); ?></span>
                    <i class="bi bi-quote quote-icon-right"></i>
                  </p>
                </div>
              </div>
            <?php } ?>
          </div>
          <div class="swiper-pagination"></div>
        </div>


      </div>

    </section><!-- /Testimonials Section -->

    <!-- Team Section -->
    <section id="team" class="team section">
      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Team</h2>
        <p>our Team</p>
      </div><!-- End Section Title -->
      <div class="container">
        <div class="row gy-4">

        <?php
          $query = "SELECT * FROM team";
          $result = mysqli_query($connection, $query);

          if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                  $name = htmlspecialchars($row['name']);
                  $job = htmlspecialchars($row['job']);
                  $image = htmlspecialchars($row['image']);
                  $facebook = htmlspecialchars($row['facebook']);
                  $x = htmlspecialchars($row['x']);
                  $instagram = htmlspecialchars($row['instagram']);
                  $linkedin = htmlspecialchars($row['linkedin']);

                  echo '
                  <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                      <div class="team-member">
                          <div class="member-img">
                              <img src="./dashboard/assets/img/' . $image . '" class="img-fluid" alt="' . $name . '">
                              <div class="social">
                                  <a href="' . $x . '" target="_blank"><i class="bi bi-twitter"></i></a>
                                  <a href="' . $facebook . '" target="_blank"><i class="bi bi-facebook"></i></a>
                                  <a href="' . $instagram . '" target="_blank"><i class="bi bi-instagram"></i></a>
                                  <a href="' . $linkedin . '" target="_blank"><i class="bi bi-linkedin"></i></a>
                              </div>
                          </div>
                          <div class="member-info">
                              <h4>' . $name . '</h4>
                              <span>' . $job . '</span>
                          </div>
                      </div>
                  </div>
                  ';
              }
          } else {
              echo "<p>No team members found.</p>";
          }
        ?>
        </div>

      </div>

    </section><!-- /Team Section -->

    <!-- OUR BLOG Start -->
    <div class="container-xxl py-5">
      <div class="container">
        <div class="title text-center wow fadeInUp" data-wow-delay="0.1s">
          <h6 class="bg-white text-center text-primary px-3">OUR BLOG</h6>
          <h1 class="mb-5" style="margin-bottom: 46px;">Read Our Latest News</h1>
        </div>
        <div class="row g-4 justify-content-center">
          <?php 
            $query = "SELECT * FROM blog LIMIT 3";
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
                      <a href="#" class="text-dark" style="text-decoration: none; font-weight: 700;"><?php echo $title?></a>
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

    <!-- FAQ Section -->
    <section id="faq" class="faq-section">
      <div class="container">
        <h2>Frequently Asked Questions</h2>

        <?php 
          $query = "SELECT * FROM faq ";
          $result = mysqli_query($connection, $query);

          while($row = mysqli_fetch_assoc($result)) {
            $title = $row['title'];
            $details = $row['details'];
        ?>
        
        <div class="faq-item">
          <button class="faq-question"><?php echo $title ?> <span class="icon">+</span></button>
          <div class="faq-answer">
            <p><?php echo $details ?></p>
          </div>
        </div>

        <?php } ?>

      </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p>Contact Us</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="mb-4" data-aos="fade-up" data-aos-delay="200">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127083.59928836353!2d6.9909782973788825!3d5.513096087676841!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x104259980202a4a1%3A0x2b97fd8924660eb1!2sOwerri%2C%20Imo!5e0!3m2!1sen!2sng!4v1730908905037!5m2!1sen!2sng" width= "100%;" height= "500px;" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div><!-- End Google Maps -->

        <div class="row gy-4">

          <div class="col-lg-4">
            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-geo-alt flex-shrink-0"></i>
              <div>
                <h3>Address</h3>
                <p>Owerri, Imo State Nigeria.</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
              <i class="bi bi-telephone flex-shrink-0"></i>
              <div>
                <h3>Call Us</h3>
                <p>09043524941</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
              <i class="bi bi-envelope flex-shrink-0"></i>
              <div>
                <h3>Email Us</h3>
                <p>demopstudios@gmail.com</p>
              </div>
            </div><!-- End Info Item -->

          </div>

          <div class="col-lg-8">
            <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                </div>

                <div class="col-md-6 ">
                  <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>

                  <button type="submit">Send Message</button>
                </div>

              </div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact Section -->

  </main>

<?php include "includes/footer.php" ?>