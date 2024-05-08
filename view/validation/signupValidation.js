document.addEventListener('DOMContentLoaded', function () {
    var form = document.getElementById('signupForm');

    // Regex patterns
    var nameRegex = /^[A-Za-z.\s]{1,30}$/;
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]{0,30}$/;
    var addressRegex = /^[A-Za-z\d\/\d,-]{1,100}$/;
    var mobileRegex = /^\d{10}$/;
    var passwordRegex = /^[A-Za-z0-9*#]{4,12}$/;

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

      if (!form.userPassword.value.trim()) {
        showValidationError('userPasswordAlertText', 'Password is required.', true);
        isValid = false;
      }

      if (!passwordRegex.test(form.userPassword.value.trim())) {
        showValidationError('userPasswordAlertText', 'Invalid password. Should contain letters and digits, between 4 and 12 characters.', true);
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