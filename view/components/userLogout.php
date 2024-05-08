<?php
echo "<script>window.alert('usecessful Logout')</script>";
session_start();
session_unset();
session_destroy();
header("Location:../pages/home.php");
?>