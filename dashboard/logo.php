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
        case 'view_logo';
        include "includes/view_logo.php";
        break;

        case 'edit_logo';
        include "includes/edit_logo.php";
        break;

        case 'create_logo';
        include "includes/create_logo.php";
        break;

        default:
        include "includes/view_logo.php";
        break;
    }
?>
    

<?php include "includes/footer.php" ?>