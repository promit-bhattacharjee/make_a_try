<?php
session_start();

class Signup
{
    private $connect;

    public function __construct()
    {
        include("../connections/database.php");
        $this->connect = $connect;

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
            $this->insertUserData();
        }
    }

    private function validateInput($input)
    {
        $input = trim($input);
        $input = strtolower($input);
        $input = mysqli_real_escape_string($this->connect, $input);
        return $input;
    }

    private function insertUserData()
    {
        $userName = $this->validateInput($_POST['userName']);
        $userEmail = $this->validateInput($_POST['userEmail']);
        $userPassword = $this->validateInput($_POST['userPassword']);
        $userConfirmPassword = $this->validateInput($_POST['userConfirmPassword']);
        $userMobile = $this->validateInput($_POST['userMobile']);
        $userAddress = $this->validateInput($_POST['userAddress']);
        $userGender = $this->validateInput($_POST['userGender']);
        $isValid = true;

        if (empty($userName) || empty($userPassword) || empty($userConfirmPassword) || empty($userMobile) || empty($userAddress) || empty($userGender)) {
            $isValid = false;
            $this->alertMessage('All fields are required.');
            echo '<script>window.location.href = "../pages/home.php";</script>';
            exit;
        }
        //  elseif (!empty($userEmail) && !filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        //     $isValid = false;
        //     $this->alertMessage('Invalid email format.');
        // } 
        elseif ($userPassword !== $userConfirmPassword) {
            $isValid = false;
            $this->alertMessage('Passwords do not match.');
            echo '<script>window.location.href = "../pages/home.php";</script>';
            exit;
        }
        elseif ($this->isMobileNumberExists($userMobile)) {
            // Check if the mobile number already exists in the database
            $isValid = false;
            $this->alertMessage('Mobile number already exists. Please use a different mobile number.');
            echo '<script>window.location.href = "../pages/home.php";</script>';
            exit;
        }

        if ($isValid) {

            $insertQuery = "INSERT INTO `users`(`user_name`, `user_email`, `user_password`, `user_mobile`, `user_address`, `user_gender`, `user_verification_status`, `role`, `created_at`, `updated_at`)
            VALUES ('$userName', '$userEmail', '$userPassword', '$userMobile', '$userAddress', '$userGender', 'not_verified', 'users', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
                        $results = mysqli_query($this->connect, $insertQuery);

            if ($results) {
                $this->alertMessage('Success: Welcome!');
                $this->setSession($userMobile);
                echo '<script>window.location.href = "../pages/phoneOtp.php";</script>';
                exit;
            } else {
                $this->alertMessage('Failed to insert users data: ' . mysqli_error($this->connect));
                echo '<script>window.location.href = "../pages/home.php";</script>';
                exit;
            }
        }            
    }
    private function isMobileNumberExists($userMobile)
{
    $checkQuery = "SELECT * FROM `users` WHERE `user_mobile` = '$userMobile'";
    $result = mysqli_query($this->connect, $checkQuery);

    if ($result && mysqli_num_rows($result) > 0) {
        return true; 
    }

    return false;
}

    private function alertMessage($content)
    {
        echo "<script>window.alert('$content');</script>";
    }

    private function setSession($userMobile)
    {
        $sessionQuery = "SELECT * FROM `users` WHERE `user_mobile` = '$userMobile' LIMIT 1";
        $sessionResult = mysqli_query($this->connect, $sessionQuery);

        if ($sessionResult) {
            $row = mysqli_fetch_assoc($sessionResult);
            $_SESSION['user_mobile'] = $row['user_mobile'];
            $_SESSION['user_id'] = $row['user_id'];
        }
        else{
            echo"eoor";
        }
    }
}

new Signup();
?>
