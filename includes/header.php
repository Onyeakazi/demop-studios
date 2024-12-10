<?php include "./dashboard/config/db.php" ?>
<?php ob_start() ?>
<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Basic Meta Tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Demop Studios</title>
<meta name="description" content="Explore Demop Studios' professional graphic design portfolio. Showcasing creativity, innovation, and expertise in branding, web design, logo design, and visual storytelling.">
<meta name="keywords" content="graphic design portfolio, Demop Studios, logo design, branding, web design, creative studio, visual storytelling, professional design services, digital art, graphic design in Nigeria, Demop creative works, UI/UX design, freelance graphic designer, designs, design, editing, graphics">
<meta name="author" content="Demop Studios">
<meta name="robots" content="index, follow">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Open Graph Meta Tags (For Social Media) -->
<meta property="og:title" content="Demop Studios">
<meta property="og:description" content="Discover Demop Studios' captivating graphic design projects. Specializing in branding, logos, digital art, and web design.">
<meta property="og:image" content="assets/img/demop logo.png"> <!-- Replace with portfolio image -->
<meta property="og:url" content="https://demopstudios.com.ng">
<meta property="og:type" content="website">
<meta property="og:site_name" content="Demop Studios">

<!-- Twitter Meta Tags -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Demop Studios">
<meta name="twitter:description" content="Explore the creativity and innovation of Demop Studios' graphic design projects.">
<meta name="twitter:image" content="assets/img/demop logo.png"> <!-- Replace with portfolio image URL -->

<!-- Favicon (For Branding) -->
<link rel="icon" href="assets/img/demop logo.png" type="image/x-icon"> <!-- Replace with your favicon URL -->

<!-- SEO Meta Tags -->
<meta name="theme-color" content="#000000">
<meta name="application-name" content="Demop Studios">
<meta name="msapplication-TileColor" content="#ffffff">

<!-- Structured Data (JSON-LD for Rich Results) -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Person",
  "name": "Demop Studios",
  "url": "https://demopstudios.com.ng",
  "image": "assets/img/demop logo.png",  <!-- Replace with portfolio owner profile image -->
  "sameAs": [
    "https://www.facebook.com/demopstudios",
    "https://www.instagram.com/demopstudios",
    "https://www.behance.net/demopstudios",
    "https://www.linkedin.com/in/demopstudios"
  ],
  "jobTitle": "Graphic Designer",
  "worksFor": {
    "@type": "Organization",
    "name": "Demop Studios"
  },
  "address": {
    "@type": "PostalAddress",
    "addressLocality": "Owerri",
    "addressRegion": "Imo State",
    "addressCountry": "Nigeria"
  }
}
</script>

  <!-- Favicons -->
  <link href="assets/img/demop logo.png" rel="icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <!-- SweetAlert CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.2/dist/sweetalert2.min.css">

  <!-- SweetAlert JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.2/dist/sweetalert2.min.js"></script>

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
</head>

<body class="index-page">