<?php
session_start();

if(isset($_SESSION['admin'])){

}
else{
  header("Location: home.html");
    exit();
}
include 'database.php';
$ID=$_GET["productID"];
$deleteQuery = "DELETE FROM `product` WHERE `id`='$ID'";
if(mysqli_query($connect, $deleteQuery)) {
  echo "<script>alert('Deleted successfully!')</script>";
}
header("Location:adminDashboard.php");
?>
<html>
</html>