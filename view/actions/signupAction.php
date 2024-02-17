<?php
session_start();

class Signup
{
    private $connect;

    public function __construct()
    {
        // Establish database connection
        include("../connections/database.php");
        $this->connect = $connect;

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
            $this->insertUserData();
        }
    }

    private function insertUserData()
    {
        $userName = mysqli_real_escape_string($this->connect, $_POST['userName']);
        $userEmail = mysqli_real_escape_string($this->connect, $_POST['userEmail']);
        $userPassword = mysqli_real_escape_string($this->connect, $_POST['userPassword']);
        $userConfirmPassword = mysqli_real_escape_string($this->connect, $_POST['userConfirmPassword']);
        $userMobile = mysqli_real_escape_string($this->connect, $_POST['userMobile']);
        $userAddress = mysqli_real_escape_string($this->connect, $_POST['userAddress']);
        $userGender = mysqli_real_escape_string($this->connect, $_POST['userGender']);

        $isValid = true;

        // Add your validation logic here

        if ($isValid) {
            $checkEmailQuery = "SELECT `user_email` FROM `user` WHERE `user_email` = '$userEmail' AND `user_verification_status` IN ('email', 'both')";
            $checkMobileQuery = "SELECT `user_mobile` FROM `user` WHERE `user_mobile` = '$userMobile' AND `user_verification_status` IN ('mobile', 'both')";
            $emailExist = mysqli_query($this->connect, $checkEmailQuery);
            $mobileExist = mysqli_query($this->connect, $checkMobileQuery);

            if (mysqli_num_rows($emailExist) == 0 && mysqli_num_rows($mobileExist) == 0) {
                $insertQuery = "INSERT INTO `user`(`user_name`, `user_email`, `user_password`, `user_mobile`, `user_address`, `user_gender`, `user_verification_status`, `role`, `created_at`, `updated_at`) VALUES ('$userName', '$userEmail', '$userPassword', '$userMobile', '$userAddress', '$userGender', 'not_verified', 'user', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
                $results = mysqli_query($this->connect, $insertQuery);

                if ($results) {
                    echo "<script>window.alert('Success: Welcome!');</script>";
                    $this->setSession($userEmail);
                    header("location: ../../home.php");
                } else {
                    echo "<script>window.alert('Failed to insert user data.');</script>";
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
        $sessionQuery = "SELECT * FROM `user` WHERE `user_email` = '$userEmail' LIMIT 1";
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
