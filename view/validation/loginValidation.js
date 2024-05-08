document.addEventListener('DOMContentLoaded', function () {
    // Corrected the form ID to "loginForm"
    var form = document.getElementById('loginForm');
    var mobileRegex = /^\d{10}$/;
    var passwordRegex = /^[A-Za-z0-9*#]{4,12}$/;

    function validateForm() {
      resetAlerts();
      var isValid = true;

      if (!form.userPassword.value.trim()) {
        showValidationError('userLogPasswordAlertText', 'Password is required.', true);
        isValid = false;
      }

      if (!passwordRegex.test(form.userPassword.value.trim())) {
        showValidationError('userLogPasswordAlertText', 'Invalid password. Should contain letters and digits, between 4 and 12 characters.', true);
        isValid = false;
      }

      if (!mobileRegex.test(form.userMobile.value.trim())) {
        showValidationError('userLogEmailAlertText', 'Invalid mobile number. Should contain exactly 10 digits.', true);
        isValid = false;
      }

      return isValid;
    }

    function resetAlerts() {
      var alertElements = document.querySelectorAll('[id$="AlertText"]');
      alertElements.forEach(function (element) {
        element.textContent = '';
      });
    }

    // Function to show validation error
    function showValidationError(alertElementId, message, isError) {
      var alertElement = document.getElementById(alertElementId);
      alertElement.style.color = isError ? 'red' : ''; 
    }

    form.addEventListener('input', validateForm);

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