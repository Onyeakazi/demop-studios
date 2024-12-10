<?php
include "config/db.php";
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login");
    exit();
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Get the user ID from the session

    // Write the DELETE query
    $query = "DELETE FROM user WHERE id = $user_id";

    // Execute the query directly
    if ($connection->query($query) === TRUE) {
        // If successful, log out the user and redirect
        session_destroy(); // Destroy the session
        header("Location: register"); // Redirect to login page
        exit();
    } else {
        echo "Error deleting account: " . $connection->error;
    }
}
?>
