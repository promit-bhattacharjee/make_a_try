<?php
session_start();
include('../connections/database.php');

class UserProfileEditor
{
    private $connect;
    private $currentUserEmail;
    private $userName = "";
    private $userAdress = "";
    private $gender = "";
    private $checkMale = '';
    private $checkFemale = '';
    private $errors = [];

    public function __construct($connection)
    {
        $this->connect = $connection;
    }

    public function displayProfileForm()
    {
        if (isset($_SESSION['user_id'])) {
            $this->currentUserEmail = $_SESSION['user_id'];
            $query = "SELECT * FROM `users` WHERE `user_id`='$this->currentUserEmail' LIMIT 1";
            $data = mysqli_query($this->connect, $query);

            if ($data) {
                while ($row = mysqli_fetch_array($data)) {
                    $this->userName = $row['user_name'];
                    $this->userAdress = $row['user_address'];
                    $this->gender = $row['user_gender'];

                    if ($this->gender === 'male') {
                        $this->checkMale = "checked";
                    } elseif ($this->gender === 'female') {
                        $this->checkFemale = "checked";
                    }
                }

                echo "" ?>
                <!DOCTYPE html>
                <html lang='en'>

                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' rel='stylesheet'
                        integrity='sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC' crossorigin='anonymous'>
                    <link rel='stylesheet' href='color.css'>
                    <style>
                        body {
                            background-color: white;
                        }
                    </style>
                    <title>Edit Profile</title>
                </head>

                <body>
                    <section class='container mt-5'>
                        <div class='row justify-content-center'>
                            <form action='editProfileAction.php' class='col-md-6 border border-white p-4' method='post'>
                                <h4 class='text-light text-center mb-4'>Update Data</h4>

                                <!-- Name -->
                                <div class='mb-3'>
                                    <div class='input-group'>
                                        <span class='input-group-text' id='userName-addon'>Name</span>
                                        <input id='userName' type='text' class='form-control' aria-describedby='userName-addon'
                                            name='userName' value='<?php echo $this->userName; ?>'>
                                    </div>
                                </div>

                                <!-- Address -->
                                <div class='mb-3'>
                                    <div class='input-group'>
                                        <span class='input-group-text' id='userAddress-addon'>Address</span>
                                        <input type='text' id='userAdress' name='userAdress' class='form-control'
                                            aria-describedby='userAddress-addon' value='<?php echo $this->userAdress; ?>'>
                                    </div>
                                </div>

                                <!-- Gender -->
                                <div class='mb-3'>
                                    <div class='input-group'>
                                        <span class='input-group-text' id='userGender-addon'>Gender</span>
                                        <div class='form-check form-check-inline'>
                                            <input class='form-check-input' type='radio' name='userGender' id='maleRadio' value='male'
                                                <?php echo $this->checkMale; ?>>
                                            <label class='form-check-label' for='maleRadio'>Male</label>
                                        </div>
                                        <div class='form-check form-check-inline'>
                                            <input class='form-check-input' type='radio' name='userGender' id='femaleRadio'
                                                value='female' <?php echo $this->checkFemale; ?>>
                                            <label class='form-check-label' for='femaleRadio'>Female</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Display Errors -->
                                <?php if (!empty($this->errors)): ?>
                                    <div class='alert alert-danger'>
                                        <ul>
                                            <?php foreach ($this->errors as $error): ?>
                                                <li>
                                                    <?php echo $error; ?>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>

                                <!-- Submit Button -->
                                <div class='mb-3'>
                                    <button type='submit' class='btn btn-outline-dark'>Update</button>
                                </div>
                            </form>
                        </div>
                    </section>
                </body>

                </html>
                <?php ;
            } else {
                echo "Query Error: " . mysqli_error($this->connect);
            }
        } else {
            echo "Login First";
        }
    }
}

// Create an instance of the class
$userProfileEditor = new UserProfileEditor($connect);

// Call the method to display the profile form
$userProfileEditor->displayProfileForm();
?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var form = document.querySelector('form');

        // Regex patterns
        var nameRegex = /^[A-Za-z.\s]{1,30}$/;
        var addressRegex = /^[A-Za-z\d\/\d,-\s]+$/;

        // Function to validate the form fields
        function validateForm() {
            // Reset alert messages
            resetAlerts();

            // Flag to track if the form is valid
            var isValid = true;

            // Validate Name
            if (!nameRegex.test(form.userName.value.trim())) {
                showValidationError('userNameAlertText', 'Invalid name. Should contain only letters and be less than 30 characters.', true);
                isValid = false;
            }

            // Validate Address
            if (!addressRegex.test(form.userAdress.value.trim())) {
                showValidationError('userAddressAlertText', 'Invalid address. Should contain only letters, digits, spaces, commas, hyphens, and slashes.', true);
                isValid = false;
            }

            // Validate Gender
            var genderOptions = form.querySelectorAll('input[name="userGender"]');
            var selectedGender = Array.from(genderOptions).find(option => option.checked);

            if (!selectedGender) {
                showValidationError('userGenderAlertText', 'Please select a gender.', true);
                isValid = false;
            }

            return isValid;
        }

        // Function to reset alert messages
        function resetAlerts() {
            var alertElements = document.querySelectorAll('.alert-danger');
            alertElements.forEach(function (element) {
                element.textContent = '';
            });
        }

        // Function to show validation error
        function showValidationError(alertElementId, message, isError) {
            var alertElement = document.getElementById(alertElementId);
            alertElement.textContent = message.charAt(0).toUpperCase() + message.slice(1) + '.';
            alertElement.style.color = isError ? 'red' : '';
        }

        // Attach input event listener to the address field
        form.userAdress.addEventListener('input', function () {
            validateForm();
        });

        // Attach form submission event listener
        form.addEventListener('submit', function (event) {
            if (!validateForm()) {
                // Prevent the default form submission if validation fails
                event.preventDefault();
            }
        });

        // Helper function to check if a string is empty
        function isEmpty(str) {
            return str.trim() === '';
        }
    });


</script>