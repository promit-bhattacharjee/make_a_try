<?php
include('../connections/database.php');

// Fetch user data
if (isset($_SESSION['user_id'])) {
    $currentUserId = $_SESSION['user_id'];

    $query = "SELECT user_name, user_email, user_address, user_gender FROM users WHERE user_id='$currentUserId' LIMIT 1";
    $result = mysqli_query($connect, $query);

    if ($result) {
        $userData = mysqli_fetch_assoc($result);
    } else {
        $userData = [];
        $error = 'Query Error: ' . mysqli_error($connect);
    }
} else {
    $userData = [];
    $error = 'User not logged in';
}
?>
<script src="../validation/updateValidation.js"></script>

<!-- Trigger Button -->
<script src="../validation/signupValidation.js"></script>
<button type="button" class="btn d-none btn-outline-light py-0 my-0" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Sign Up
</button>

<!-- Signup Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title align-self-center" id="staticBackdropLabel">Update Account</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Signup Form -->
        <section class="d-flex container justify-content-center">
          <div class="row">
            <form action="../actions/userDetailsUpdateAction.php" id="signupForm" class="border-1 border border-white"
              method="post">
              <!-- Name -->
              <div class="container">
                <label for="userName">Name </label>
                <div class="input-group d-flex mb-2">
                  <input id="userName" type="text" class="form-control" aria-label="Username"
                    aria-describedby="addon-wrapping" name="userName" value="<?php echo $userData['user_name']; ?>">
                </div>
                <span id="userNameAlertText" class="d-block"></span>
              </div>

              <!-- Email -->
              <div class="container">
                <label for="userEmail">Email (Optional) </label>
                <div class="input-group flex-nowrap mb-2">
                  <input type="text" id="userEmail" class="form-control" aria-label="Username"
                    aria-describedby="addon-wrapping" name="userEmail" value="<?php echo $userData['user_email']; ?>">
                </div>
                <span id="userEmailAlertText" class=""></span>
              </div>

              <!-- Address -->
              <div class="container">
                <label for="userAddress">Address </label>
                <div class="input-group flex-nowrap mt-2 mb-2">
                  <input type="text" id="userAddress" name="userAddress" class="form-control" aria-label="Username"
                    aria-describedby="addon-wrapping" value="<?php echo $userData['user_address']; ?>">
                </div>
                <span id="userAddressAlertText" class=""></span>
              </div>

              <!-- Gender -->
              <div class="container mt-3">
                <div class="border p-1 rounded">
                  <label class="text-center">Gender</label>
                  <div class="input-group flex-nowrap mt-2 mb-2">
                    <div class="w-100 bg-white d-flex align-items-center justify-content-evenly">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="userGender" id="exampleRadios1" value="male"
                          <?php echo ($userData['user_gender'] === 'male') ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="exampleRadios1">Male</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="userGender" id="exampleRadios2"
                          value="female" <?php echo ($userData['user_gender'] === 'female') ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="exampleRadios2">Female</label>
                      </div>
                    </div>
                  </div>
                  <span id="userGenderAlertText" class=""></span>
                </div>
              </div>

              <!-- Submit Button -->
              <div class="container d-flex justify-content-between mt-5">
                <button type="submit" id="submitBtn" value="1" name="submit" class="btn btn-dark">Update Data</button>
              </div>
              
            </form>
          </div>
        </section>
      </div>
    </div>
  </div>
</div>

<!-- Include external JavaScript file -->
<script src="../validation/updateValidation.js"></script>

<!-- Script to trigger the modal on page load -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    var form = document.getElementById('signupForm');

    // Regex patterns
    var nameRegex = /^[A-Za-z.\s]{1,30}$/;
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]{0,30}$/;
    var addressRegex = /^[A-Za-z\d\/\d,-]{1,100}$/;

    // Function to validate the form fields
    function validateForm() {
      // Reset alert messages
      resetAlerts();

      // Flag to track if the form is valid
      var isValid = true;

      // Validate each field
      if (!nameRegex.test(form.userName.value.trim())) {
        showValidationError('userNameAlertText', 'Invalid name. Should contain only letters and be less than 20 characters.', true);
        isValid = false;
      }

      // Check if email has a value before applying regex
      if (!isEmpty(form.userEmail.value.trim())) {
        if (!emailRegex.test(form.userEmail.value.trim())) {
          showValidationError('userEmailAlertText', 'Invalid email address. Should be less than 30 characters.', true);
          isValid = false;
        }
      }


      if (!addressRegex.test(form.userAddress.value.trim())) {
        showValidationError('userAddressAlertText', 'Invalid address. Should contain only "/", ",", "-", digits, and letters.', true);
        isValid = false;
      }

      if (!form.userGender.value) {
        showValidationError('userGenderAlertText', 'Please select a gender.', true);
        isValid = false;
      }

      return isValid;
    }

    // Function to reset alert messages
    function resetAlerts() {
      var alertElements = document.querySelectorAll('[id$="AlertText"]');
      alertElements.forEach(function (element) {
        element.textContent = '';
      });
    }

    // Function to show validation error
    function showValidationError(alertElementId, message, isError) {
      var alertElement = document.getElementById(alertElementId);
      // alertElement.textContent = message.charAt(0).toUpperCase() + message.slice(1) + '.'; // Capitalize first letter
      alertElement.style.color = isError ? 'red' : ''; 
    }

    // Attach input event listeners to form fields for live validation
    form.addEventListener('input', validateForm);

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
