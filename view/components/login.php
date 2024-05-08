<!-- Your HTML Code -->
<!-- <script src="../validation/loginValidation.js"></script> -->
<button type="button" class="btn primaryBgClr text-white py-2 ml-5" data-bs-toggle="modal"
  data-bs-target="#loginModal">
  Login
</button>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true"
  style="z-index: 2000;">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Login</h5>
        <button type="button" class="btn-close" id="btnClose" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <section class="d-flex justify-content-center">
          <!-- Your existing login form -->
          <form id="loginForm" action="../actions/loginAction.php" class="border-1 border border-white" method="post">
            <!-- Mobile -->
            <div class="container">
              <label for="userMobile">Mobile</label>
              <div class="input-group flex-nowrap mt-2 mb-2">
                <span class="input-group-text">+880</span>
                <input type="text" id="userMobile" class="form-control" aria-label="Username"
                  aria-describedby="addon-wrapping" name="userMobile">
              </div>
              <span id="userLogEmailAlertText" class="userAlertText"></span>
            </div>
            <!-- Password -->
            <div class="container">
              <label for="userLogPassword">Password</label>
              <div class="input-group flex-nowrap mt-2 mb-2">
                <input type="password" id="userLogPassword" class="form-control" aria-label="Password"
                  aria-describedby="addon-wrapping" name="userPassword">
              </div>
              <span id="userLogPasswordAlertText" class="userAlertText"></span>
            </div>

            <div class="container d-flex justify-content-between">
              <button type="submit" id="submitBtn" value="set" name="formsubmited" class="btn btn-success mt-2">
                Join
              </button>
              <a href="#" class="container m-2" id="forgetPasswordBtn">Forget Password</a>
            </div>
          </form>
        </section>
      </div>
    </div>
  </div>
</div>

<!-- Number Input Modal -->
<div class="modal fade" id="numberModal" tabindex="-1" aria-labelledby="numberModalLabel" aria-hidden="true"
  style="z-index: 2000;">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="numberModalLabel">Enter Your Mobile Number</h5>
        <button type="button" class="btn-close" id="btnCloseNumber" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <section class="d-flex justify-content-center">
          <form id="numberForm" action="../pages/phoneOtp2.php" class="border-1 border border-white" method="get">
            <div class="container">
              <label for="userMobileNumber">Mobile Number</label>
              <div class="input-group flex-nowrap mt-2 mb-2">
                <span class="input-group-text">+880</span>
                <input type="text" id="userMobileNumber" class="form-control" aria-label="Mobile Number"
                  aria-describedby="addon-wrapping" name="random_code">
              </div>
              <span id="userMobileNumberAlertText" class="userAlertText"></span>
            </div>

            <div class="container d-flex justify-content-between">
              <button type="submit" id="submitNumberBtn" value="" name="" class="btn btn-success mt-2">
                Submit
              </button>
            </div>
          </form>
        </section>
      </div>
    </div>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var form = document.getElementById('loginForm');
    var mobileRegex = /^\d{10}$/;
    var passwordRegex = /^[A-Za-z0-9*#]{4,12}$/;

    function validateForm() {
      resetAlerts();
      var isValid = true;

      if (!form.userPassword.value.trim()) {
        showValidationError('userLogPasswordAlertText', 'Password is required.', true);
        isValid = false;
      } else if (!passwordRegex.test(form.userPassword.value.trim())) {
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
    function showValidationError(alertElementId, message, isError) {
      var alertElement = document.getElementById(alertElementId);
      alertElement.textContent = message;
      alertElement.style.color = isError ? 'red' : '';
    }

    form.addEventListener('input', validateForm);

    form.addEventListener('submit', function (event) {
      if (!validateForm()) {
        event.preventDefault();
      }
    });
    function isEmpty(str) {
      return str.trim() === '';
    }
  });
</script>

<!-- Additional Script -->
<script>
  // JavaScript to handle the "Forget Password" link click
  document.getElementById("forgetPasswordBtn").addEventListener("click", function () {
    // Close the login modal
    $('#loginModal').modal('hide');

    // Open the number input modal
    $('#numberModal').modal('show');
  });

  // JavaScript to close the number input modal
  document.getElementById("btnCloseNumber").addEventListener("click", function () {
    // Close the number input modal
    $('#numberModal').modal('hide');

    // Reopen the login modal
    $('#loginModal').modal('show');
  });
</script>
