<?php include "includes/header.php" ?>
    <?php include "includes/navbar.php" ?>

    <?php include "includes/sidebar.php" ?>

    <?php 
           
        if(isset($_GET['source'])) {
            $source = $_GET['source'];
        } else {
            $source = '';
        }

        switch($source) {

        case 'create_services';
        include "includes/create_services.php";
        break;

        case 'images';
        include "includes/images.php";
        break;

        case 'edit_graphics';
        include "includes/edit_graphics.php";
        break;

        case 'videos';
        include "includes/videos.php";
        break;

        case 'edit_video';
        include "includes/edit_video.php";
        break;

        default:
        include "includes/images.php";
        break;
        }
        
        
    ?>
    

<?php include "includes/footer.php" ?>