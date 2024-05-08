<?php
session_start();

class PasswordResetHandler
{
    private $connect;

    public function __construct($connection)
    {
        $this->connect = $connection;
    }

    public function resetPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['newPassword']) && isset($_POST['confirmPassword'])) {
                // Ensure user is logged in
                if (isset($_SESSION['user_id'])) {
                    $newPassword = mysqli_real_escape_string($this->connect, $_POST['newPassword']);
                    $confirmPassword = mysqli_real_escape_string($this->connect, $_POST['confirmPassword']);

                    // Validate if passwords match
                    if ($newPassword === $confirmPassword) {
                        // Validate password using regex
                        $passwordValidation = $this->validatePassword($newPassword);

                        if ($passwordValidation['isValid']) {
                            // Password is valid, update it in the database
                            $this->updateDatabasePassword($newPassword);

                            // Password update successful, you may redirect to a success page
                            echo "<script>window.alert('Password updated successfully')</script>";
                            header('Location: userDashBoard.php');
                            exit;
                        } else {
                            // Password does not meet requirements
                            echo "<script>window.alert('{$passwordValidation['errorMessage']}')</script>";
                        }
                    } else {
                        // Passwords do not match
                        echo "<script>window.alert('Passwords do not match')</script>";
                    }
                } else {
                    // User not logged in
                    echo "<script>window.alert('Invalid request')</script>";
                }
            } else {
                // Handle missing parameters
                echo "<script>window.alert('Invalid request')</script>";
            }
        }
    }

    private function validatePassword($password)
    {
        $validationResult = ['isValid' => true, 'errorMessage' => ''];

        // Use a regular expression to enforce password requirements
        $pattern = '/^[A-Za-z0-9*#]{4,12}$/';

        if (!preg_match($pattern, $password)) {
            $validationResult['isValid'] = false;
            $validationResult['errorMessage'] = "Password must contain only alphanumeric characters, '*', '#' and be between 4 to 12 characters long.";
        }

        return $validationResult;
    }

    private function updateDatabasePassword($password)
    {
        $userId = $_SESSION['user_id'];
        $escapedPassword = mysqli_real_escape_string($this->connect, $password);

        $updateSql = "UPDATE users SET user_password = '$escapedPassword' WHERE user_id = $userId";
        $updateResult = mysqli_query($this->connect, $updateSql);

        if (!$updateResult) {
            // Handle the case where the database update fails
            echo "<script>window.alert('Password update failed')</script>";
        }
    }
}

// Include your database connection file
require_once("../connections/database.php");
$resetHandler = new PasswordResetHandler($connect);

// Call the resetPassword method
$resetHandler->resetPassword();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("../components/DomHeader.php") ?>
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <!-- Forgot Password Form -->
                <form id="forgotPasswordForm" action="" method="post">
                    <h2 class="mb-4">forget Password</h2>

                    <!-- New Password -->
                    <div class="form-group">
                        <label for="newPassword">New Password</label>
                        <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                        <small id="newPasswordError" class="form-text text-danger"></small>
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                            required>
                        <small id="confirmPasswordError" class="form-text text-danger"></small>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary my-3">Reset Password</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Custom JavaScript for Real-time Password Matching Validation -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const newPasswordInput = document.getElementById('newPassword');
            const confirmPasswordInput = document.getElementById('confirmPassword');
            const newPasswordError = document.getElementById('newPasswordError');
            const confirmPasswordError = document.getElementById('confirmPasswordError');

            newPasswordInput.addEventListener('input', function () {
                validatePasswordMatch();
            });

            confirmPasswordInput.addEventListener('input', function () {
                validatePasswordMatch();
            });

            function validatePasswordMatch() {
                const newPassword = newPasswordInput.value;
                const confirmPassword = confirmPasswordInput.value;

                if (newPassword !== confirmPassword) {
                    newPasswordError.textContent = "Passwords do not match.";
                    confirmPasswordError.textContent = "Passwords do not match.";
                    confirmPasswordInput.classList.add('is-invalid');
                } else {
                    newPasswordError.textContent = "";
                    confirmPasswordError.textContent = "";
                    confirmPasswordInput.classList.remove('is-invalid');
                }
            }

            // Form submission event listener
            document.getElementById('forgotPasswordForm').addEventListener('submit', function (event) {
                validatePasswordMatch();

                if (newPasswordInput.value !== confirmPasswordInput.value) {
                    event.preventDefault();
                }
            });
        });
    </script>

</body>

</html>
