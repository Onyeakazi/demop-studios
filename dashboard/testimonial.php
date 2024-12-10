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

            case 'create';
            include "includes/create_testimonial.php";
            break;

            case 'view_all';
            include "includes/view_testimonial.php";
            break;

            case 'edit';
            include "includes/edit_testimonial.php";
            break;

            default:
            include "includes/view_testimonial.php";
            break;
        }
        
    ?>

<?php include "includes/footer.php" ?>
