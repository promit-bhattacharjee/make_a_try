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
        // Basic validation, you can customize it based on your needs
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

        // Add your validation logic here
        if (empty($userName) || empty($userEmail) || empty($userPassword) || empty($userConfirmPassword) || empty($userMobile) || empty($userAddress) || empty($userGender)) {
            $isValid = false;
            echo "<script>window.alert('All fields are required.');</script>";
        } elseif (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
            $isValid = false;
            echo "<script>window.alert('Invalid email format.');</script>";
        } elseif ($userPassword !== $userConfirmPassword) {
            $isValid = false;
            echo "<script>window.alert('Passwords do not match.');</script>";
        }

        if ($isValid) {
            $checkEmailQuery = "SELECT `user_email` FROM `users` WHERE `user_email` = '$userEmail' AND `user_verification_status` IN ('email', 'both')";
            $checkMobileQuery = "SELECT `user_mobile` FROM `users` WHERE `user_mobile` = '$userMobile' AND `user_verification_status` IN ('mobile', 'both')";
            $emailExist = mysqli_query($this->connect, $checkEmailQuery);
            $mobileExist = mysqli_query($this->connect, $checkMobileQuery);

            if (mysqli_num_rows($emailExist) == 0 && mysqli_num_rows($mobileExist) == 0) {
                $insertQuery = "INSERT INTO `users`(`user_name`, `user_email`, `user_password`, `user_mobile`, `user_address`, `user_gender`, `user_verification_status`, `role`, `created_at`, `updated_at`) VALUES ('$userName', '$userEmail', '$userPassword', '$userMobile', '$userAddress', '$userGender', 'not_verified', 'users', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
                $results = mysqli_query($this->connect, $insertQuery);

                if ($results) {
                    echo "<script>window.alert('Success: Welcome!');</script>";
                    $this->setSession($userEmail);
                    header("location: ../pages/home.php");
                    exit;
                } else {
                    echo "<script>window.alert('Failed to insert users data.');</script>";
                    $this->clearData();
                }
            } else {
                $this->alertMessage("Email or mobile already exists", "Failed");
            }
        }
    }

    private function clearData()
    {
        echo "<script>
              function clearForm() {
                  document.getElementById('yourFormId').reset(); // Replace 'yourFormId' with the actual ID of your form
              }
              clearForm();
          </script>";
        // echo '<script>window.location.href = window.location.href;</script>';
        // exit;
    }

    private function alertMessage($title, $content)
    {
        echo "<script>window.alert('$content');</script>";
        // exit;
    }

    private function setSession($userEmail)
    {
        $sessionQuery = "SELECT * FROM `users` WHERE `user_email` = '$userEmail' LIMIT 1";
        $sessionResult = mysqli_query($this->connect, $sessionQuery);

        if ($sessionResult) {
            $row = mysqli_fetch_assoc($sessionResult);
            $_SESSION['user_email'] = $row['user_email'];
            $_SESSION['user_id'] = $row['user_id'];
        }
    }
}

new Signup();
?>
