<?php
session_start();

session_destroy();

// Redirect to login page after logging out
header("Location: index.php"); 
exit();
// Use echo if want button instead of automatic redirect
// echo "You have been logout. <a href='index.php'>Click</a> here to return"
?>