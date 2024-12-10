<?php session_start() ?>
<?php 
    $query = "Select * from user";
    $result = mysqli_query($connection, $query);
    if($row = mysqli_fetch_assoc($result)) {
        $name = $row["name"];
        $about = $row["about"];
        $profile = $row["profile"];
    }
?>

<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
    <a href="index" class="logo d-flex align-items-center">
        <img src="assets/img/DEMOPLOGO.png" alt="">
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item dropdown pe-3">
            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                <img src="assets/img/<?php echo $profile ?>" alt="Profile" class="rounded-circle">
                <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION['name'] ?></span>
            </a><!-- End Profile Iamge Icon -->

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                <li class="dropdown-header">
                    <h6><?php echo $_SESSION['name'] ?></h6>
                    <span><?php echo $about ?></span>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center" href="users-profile">
                        <i class="bi bi-person"></i>
                        <span>My Profile</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center" href="logout">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Sign Out</span>
                    </a>
                </li>
                <!-- Add Delete Account Option -->
                <li>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);" onclick="confirmDeleteAccount()">
                        <i class="bi bi-trash"></i>
                        <span>Delete Account</span>
                    </a>
                </li>
            </ul><!-- End Profile Dropdown Items -->
    </nav><!-- End Icons Navigation -->
</header>

<script>
    // Function to show SweetAlert confirmation before deleting the account
    function confirmDeleteAccount() {
        Swal.fire({
            title: 'Are you sure?',
            text: "This action is permanent and will delete your account!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete my account!',
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, submit the delete form
                window.location.href = 'delete_account'; // Redirect to account deletion PHP script
            }
        });
    }
</script>