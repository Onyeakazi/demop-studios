<?php 

setcookie('remember_me_email', '', time() - 3600, '/');
setcookie('remember_me_token', '', time() - 3600, '/');
session_destroy(); // Destroy the session
$_SESSION['user_id'] = null;

header("Location: login")

?>