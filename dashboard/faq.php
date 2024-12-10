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
        case 'view_all';
        include "includes/view_faq.php";
        break;

        case 'edit';
        include "includes/edit_faq.php";
        break;

        case 'create';
        include "includes/add_faq.php";
        break;

        default:
        include "includes/view_faq.php";
        break;
    }
?>
    
<?php include "includes/footer.php" ?>
