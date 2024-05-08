<?php
session_start();

class UpdateUser
{
    private $connect;

    public function __construct()
    {
        include("../connections/database.php");
        $this->connect = $connect;

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
            $this->updateUserData();
        }
    }

    private function validateInput($input)
    {
        // Basic validation, you can customize it based on your needs
        $input = trim($input);
        $input = mysqli_real_escape_string($this->connect, $input);
        return $input;
    }

    private function updateUserData()
    {
        if (isset($_SESSION['user_id'])) {
            $currentUserId = $_SESSION['user_id'];

            $userName = $this->validateInput($_POST['userName']);
            $userEmail = $this->validateInput($_POST['userEmail']);
            $userAddress = $this->validateInput($_POST['userAddress']);
            $userGender = $this->validateInput($_POST['userGender']);

            $isValid = true;

            // Add your validation logic here if needed

            if ($isValid) {
                $updateQuery = "UPDATE `users` SET 
                    `user_name` = '$userName',
                    `user_email` = '$userEmail',
                    `user_address` = '$userAddress',
                    `user_gender` = '$userGender'
                    WHERE `user_id` = '$currentUserId'";

                $results = mysqli_query($this->connect, $updateQuery);

                if ($results) {
                    $this->alertMessage('Success: User data updated!');
                    echo '<script>window.location.href = "../pages/home.php";</script>';
                    exit;
                } else {
                    $this->alertMessage('Failed to update user data: ' . mysqli_error($this->connect));
                }
            }
        } else {
            $this->alertMessage('User not logged in');
        }
    }

    private function alertMessage($content)
    {
        echo "<script>window.alert('$content');</script>";
        echo '<script>window.location.href = "../pages/home.php";</script>';
        exit;
    }
}

new UpdateUser();
?>
