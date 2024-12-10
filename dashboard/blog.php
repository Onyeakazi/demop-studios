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
        case 'view_blog';
        include "includes/view_blog.php";
        break;

        case 'edit';
        include "includes/edit_blog.php";
        break;

        case 'create';
        include "includes/create_blog.php";
        break;

        default:
        include "includes/view_blog.php";
        break;
    }
?>
    
<?php include "includes/footer.php" ?>
