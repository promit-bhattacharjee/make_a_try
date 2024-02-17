
<?php
session_start();

class Login
{
  function __construct()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['formsubmited'])) {
      $this->login();
    }
  }

  public function login(){
    $userEmail = $_POST['userEmail'];
    $userPassword = $_POST['userPassword'];

    include "/xampp/htdocs/makeATry/view/connections/database.php";
    
    $checkEmailQuery = "SELECT * FROM `user` WHERE `user_email`= '$userEmail' LIMIT 1";
    
    // Execute the query
    $ExistEmail = mysqli_query($connect, $checkEmailQuery);

    // Check for errors in the query execution
    if (!$ExistEmail) {
      die('Error executing query: ' . mysqli_error($connect));
    }

    // Fetch the result
    $row = mysqli_fetch_array($ExistEmail);

    if ($row && ($row['user_password']===$userPassword) && $row['role'] === "admin") {
      $_SESSION['admin'] = $userEmail;
      echo "<script>window.alert('Welcome, Admin');</script>";
    } elseif ($row && ($row['user_password']===$userPassword) && $row['role'] === "user") {
      $_SESSION['user_email'] = $row['user_email'];
      $_SESSION['user_id'] = $row['user_id'];
      echo "<script>window.alert('Welcome, User');</script>";
      echo "<script>window.location.href = '/makeATry/home.php';</script>";
      exit(); // Ensure that no further code is executed after the redirection
    } else {
      echo "<script>window.alert('Password Invalid');</script>";
    }
  }
}

new Login();
?>
