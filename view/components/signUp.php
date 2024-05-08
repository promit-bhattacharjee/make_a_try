<!-- Trigger Button -->
<script src="../validation/signupValidation.js"></script>

<button type="button" class="btn btn-outline-light py-0 my-0" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Sign Up
</button>

<!-- Signup Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title align-self-center" id="staticBackdropLabel">Create Account</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Signup Form -->
        <section class="d-flex container justify-content-center">
          <div class="row">
            <form action="../actions/signupAction.php" id="signupForm" class="border-1 border border-white"
              method="post">
              <!-- Name -->
              <div class="container">
                <label for="userName">Name </label>
                <div class="input-group d-flex mb-2">
                  <input id="userName" type="text" class="form-control" aria-label="Username"
                    aria-describedby="addon-wrapping" name="userName">
                </div>
                <span id="userNameAlertText" class="d-block"></span>
              </div>

              <!-- Email -->
              <div class="container">
                <label for="userEmail">Email (Optional) </label>
                <div class="input-group flex-nowrap mb-2">
                  <input type="text" id="userEmail" class="form-control" aria-label="Username"
                    aria-describedby="addon-wrapping" name="userEmail">
                </div>
                <span id="userEmailAlertText" class=""></span>
              </div>

              <!-- Password -->
              <div class="container">
                <label for="userPassword">Password </label>
                <div class="input-group flex-nowrap mb-2">
                  <input type="text" id="userPassword" class="form-control" aria-label="Username"
                    aria-describedby="addon-wrapping" name="userPassword">
                </div>
                <span id="userPasswordAlertText" class=""></span>
              </div>

              <!-- Confirm Password -->
              <div class="container">
                <label for="userConfirmPassword">Confirm Password </label>
                <div class="input-group flex-nowrap mt-2 mb-2">
                  <input type="text" id="userConfirmPassword" class="form-control" aria-label="Username"
                    aria-describedby="addon-wrapping" name="userConfirmPassword">
                </div>
                <span id="userConfirmPasswordAlertText" class=""></span>
              </div>

              <!-- Mobile -->
              <div class="container">
                <label for="userMobile">Mobile No </label>
                <div class="input-group flex-nowrap mt-2 mb-2">
                  <span class="input-group-text userMobileLabel" id="addon-wrapping">+880</span>
                  <input type="text" id="userMobile" name="userMobile" class="form-control" aria-label="Username"
                    aria-describedby="addon-wrapping">
                </div>
                <span id="userMobileAlertText" class=""></span>
              </div>

              <!-- Address -->
              <div class="container">
                <label for="userAddress">Address </label>
                <div class="input-group flex-nowrap mt-2 mb-2">
                  <input type="text" id="userAddress" name="userAddress" class="form-control" aria-label="Username"
                    aria-describedby="addon-wrapping">
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
                          checked>
                        <label class="form-check-label" for="exampleRadios1">Male</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="userGender" id="exampleRadios2"
                          value="female">
                        <label class="form-check-label" for="exampleRadios2">Female</label>
                      </div>
                    </div>
                  </div>
                  <span id="userGenderAlertText" class=""></span>
                </div>
              </div>

              <!-- Submit Button -->
              <div class="container d-flex justify-content-between mt-5">
                <button type="submit" id="submitBtn" value="1" name="submit" class="btn btn-dark">Create an Account</button>
              </div>
              
            </form>
          </div>
        </section>
      </div>
    </div>
  </div>
</div>

<!-- <script src="../validation/signupValidation.js"></script> -->

<script>
  document.addEventListener('DOMContentLoaded', function () {
    var form = document.getElementById('signupForm');

    // Regex patterns
    var nameRegex = /^[A-Za-z\s]{1,30}$/;
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]{0,30}$/;
    var addressRegex = /^[A-Za-z\d\/\d,-]{1,100}$/;
    var mobileRegex = /^\d{10}$/;
    var passwordRegex = /^[A-Za-z0-9*#]{6,12}$/;

    // Function to validate the form fields
    function validateForm() {
      // Reset alert messages
      resetAlerts();

      // Flag to track if the form is valid
      var isValid = true;

      // Validate each field
      if (!nameRegex.test(form.userName.value.trim())) {
        showValidationError('userNameAlertText', 'Invalid name. Should contain only letters and be less than 30 characters.', true);
        isValid = false;
      }

      // Check if email has a value before applying regex
      if (!isEmpty(form.userEmail.value.trim())) {
        if (!emailRegex.test(form.userEmail.value.trim())) {
          showValidationError('userEmailAlertText', 'Invalid email address. Should be less than 30 characters.', true);
          isValid = false;
        }
      }

      if (!form.userPassword.value.trim()) {
        showValidationError('userPasswordAlertText', 'Password is required.', true);
        isValid = false;
      }

      if (!passwordRegex.test(form.userPassword.value.trim())) {
        showValidationError('userPasswordAlertText', 'Invalid password. Should contain letters and digits, between 6 and 12 characters.', true);
        isValid = false;
      }

      if (form.userPassword.value.trim() !== form.userConfirmPassword.value.trim()) {
        showValidationError('userConfirmPasswordAlertText', 'Passwords do not match.', true);
        isValid = false;
      }

      if (!mobileRegex.test(form.userMobile.value.trim())) {
        showValidationError('userMobileAlertText', 'Invalid mobile number. Should contain exactly 10 digits.', true);
        isValid = false;
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
      alertElement.textContent = message;
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

