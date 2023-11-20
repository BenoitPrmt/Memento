<?php
session_start();

unset($_SESSION['user']);

header('location: index.php');

?>

<?php include 'header.php' ?>

<a href="index.php">Home</a>
<a href="login.php">Login</a>
<a href="register.php">Register</a>

<?php include 'footer.php' ?>