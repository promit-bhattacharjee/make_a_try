<?php
session_start();

class Login
{
    private $connect;

    function __construct()
    {
        include "../connections/database.php";
        $this->connect = $connect; // Initialize the $connect property

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['formsubmited'])) {
            $this->login();
        }
    }

    private function sanitizeInput($input)
    {
        // You can add more sanitization or validation as needed
        return mysqli_real_escape_string($this->connect, trim(htmlspecialchars(strtolower($input))));
    }

    public function login()
    {
        $userEmail = $this->sanitizeInput($_POST['userEmail']);
        $userPassword = $this->sanitizeInput($_POST['userPassword']);

        $checkEmailQuery = "SELECT * FROM `users` WHERE `user_email`= '$userEmail' LIMIT 1";

        // Execute the query
        $ExistEmail = mysqli_query($this->connect, $checkEmailQuery);

        // Check for errors in the query execution
        if (!$ExistEmail) {
            die('Error executing query: ' . mysqli_error($this->connect));
        }

        // Fetch the result
        $row = mysqli_fetch_array($ExistEmail);

        if ($row && ($row['user_password']===$userPassword) && $row['role'] === "admin") {
            $_SESSION['admin'] = $userEmail;
            echo "<script>window.alert('Welcome, Admin');</script>";
        } elseif ($row && ($row['user_password']===$userPassword) && $row['role'] === "users") {
            $_SESSION['user_email'] = $row['user_email'];
            $_SESSION['user_id'] = $row['user_id'];
            echo "<script>window.alert('Welcome, users');</script>";
            echo "<script>window.location.href = '../pages/home.php';</script>";
            exit(); // Ensure that no further code is executed after the redirection
        } else {
            echo "<script>window.alert('Password Invalid');</script>";
        }
    }
}

new Login();
?>
