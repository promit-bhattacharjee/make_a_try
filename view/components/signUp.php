<!-- Trigger Button -->
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
            <form action="../actions/signupAction.php" class="border-1 border border-white" method="post">
              <!-- Name -->
              <div class="container">
                <label for="userName">Name </label>
                <div class="input-group d-flex mb-2">
                  <input id="userName" type="text" class="form-control" aria-label="Username" aria-describedby="addon-wrapping" name="userName">
                </div>
                <span id="userNameAlertText" class="d-block"></span>
              </div>
              
              <!-- Email -->
              <div class="container">
                <label for="userEmail">Email </label>
                <div class="input-group flex-nowrap mb-2">
                  <input type="text" id="userEmail" class="form-control" aria-label="Username" aria-describedby="addon-wrapping" name="userEmail">
                </div>
                <span id="userEmailAlertText" class=""></span>
              </div>
              
              <!-- Password -->
              <div class="container">
                <label for="userPassword">Password </label>
                <div class="input-group flex-nowrap mb-2">
                  <input type="text" id="userPassword" class="form-control" aria-label="Username" aria-describedby="addon-wrapping" name="userPassword">
                </div>
                <span id="userPasswordAlertText" class=""></span>
              </div>
              
              <!-- Confirm Password -->
              <div class="container">
                <label for="userConfirmPassword">Confirm Password </label>
                <div class="input-group flex-nowrap mt-2 mb-2">
                  <input type="text" id="userConfirmPassword" class="form-control" aria-label="Username" aria-describedby="addon-wrapping" name="userConfirmPassword">
                </div>
                <span id="userConfirmPasswordAlertText" class=""></span>
              </div>
              
              <!-- Mobile -->
              <div class="container">
                <label for="userMobile">Mobile No </label>
                <div class="input-group flex-nowrap mt-2 mb-2">
                  <span class="input-group-text userMobileLabel" id="addon-wrapping">+880</span>
                  <input type="text" id="userMobile" name="userMobile" class="form-control" aria-label="Username" aria-describedby="addon-wrapping">
                </div>
                <span id="userMobileAlertText" class=""></span>
              </div>
              
              <!-- Address -->
              <div class="container">
                <label for="userAddress">Address </label>
                <div class="input-group flex-nowrap mt-2 mb-2">
                  <input type="text" id="userAddress" name="userAddress" class="form-control" aria-label="Username" aria-describedby="addon-wrapping">
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
                        <input class="form-check-input" type="radio" name="userGender" id="exampleRadios1" value="male" checked>
                        <label class="form-check-label" for="exampleRadios1">Male</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="userGender" id="exampleRadios2" value="female">
                        <label class="form-check-label" for="exampleRadios2">Female</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="userGender" id="exampleRadios3" value="other">
                        <label class="form-check-label" for="exampleRadios3">Other</label>
                      </div>
                    </div>
                  </div>
                  <span id="userGenderAlertText" class=""></span>
                </div>
              </div>
              
              <!-- Submit Button -->
              <div class="container d-flex justify-content-between mt-5">
                <button type="submit" value="1" name="submit" class="btn btn-dark">Create an Account</button>
              </div>
            </form>
          </div>
        </section>
      </div>
    </div>
  </div>
</div>
