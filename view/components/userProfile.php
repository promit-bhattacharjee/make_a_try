<?php
class userProfile
{
  function __construct()
  {
    $this->insertUserData();
  }
  private function insertUserData()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
      $userName = $_POST['userName'];
      $userEmail = $_POST['userEmail'];
      $userPassword = $_POST['userPassword'];
      $userConfirmPassword = $_POST['userConfirmPassword'];
      $userMobile = $_POST['userMobile'];
      $userAddress = $_POST['userAddress'];
      $userGender = $_POST['userGender'];
      $isValid = true;
      if (!preg_match('/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/', $userEmail)) {
        $isValid = false;
        echo "<script>window.alert('Please enter a valid email address.');";
        exit;
      }
      // $passwordPattern = '/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@#])[A-Za-z\d@#]+$/';

      // if (!preg_match($passwordPattern, $userPassword)) {
      //   $isValid = false;
      //   echo "<script>window.alert('Password must contain at least one letter, one number, and one of the special characters @ or #.');";
      //   exit;
      // }



      if ($userPassword !== $userConfirmPassword) {
        $isValid = false;
        echo "<script>window.alert('Passwords do not match.');";
        exit;
      }

      if (!preg_match('/^\d{10}$/', $userMobile)) {
        $isValid = false;
        echo "<script>window.alert('Please enter a valid mobile number 10 digits only.');";
        exit;
      }

      // if (!preg_match('/^[a-zA-Z0-9\s\.,\-/#()\']+$/', $userAddress)) {
      //     $isValid = false;
      //     echo "<script>window.alert('Please enter a valid address.');location.href='home.html'</script>";
      // }

      if (!preg_match('/^[a-zA-Z]{3,20}$/', $userName)) {
        $isValid = false;
        echo "<script>window.alert('Please enter a valid name (3 to 20 characters, alphabetic only).');";
      }
      if ($isValid) {

        if (isset($_SESSION['user'])) {
          echo "<script>window.alert('Please Logout First')";
          exit;
        }
        include("/xampp/htdocs/makeATry/view/connections/database.php");
        $checkEmailQuery = "SELECT `user_email` FROM `user` WHERE `user_email` = '$userEmail' AND `user_verification_status` IN ('email', 'both')";
        $checkMobileQuery = "SELECT `user_mobile` FROM `user` WHERE `user_mobile` = '$userMobile' AND `user_verification_status` IN ('mobile', 'both')";
        $emailExist = mysqli_query($connect, $checkEmailQuery);
        $mobileExist = mysqli_query($connect, $checkMobileQuery);
        if (mysqli_num_rows($emailExist) == 0 && mysqli_num_rows($mobileExist) == 0) {
          $insertQuery = "INSERT INTO `user`(`user_name`, `user_email`, `user_password`, `user_mobile`, `user_address`, `user_gender`, `user_verification_status`, `role`, `created_at`, `updated_at`) VALUES ('$userName', '$userEmail', '$userPassword', '$userMobile', '$userAddress', '$userGender', 'not_verified', 'user', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
          $results=mysqli_query($connect, $insertQuery);
          echo $results;
          $_SESSION['user'] = $userEmail;
          echo "<script>window.alert('Welcome');";
          exit;
        } else {
          echo "<script>window.alert('Email or Mobile Number already exists  ');";
        }
      }
    }
  }}
new userProfile();
?>
<button type="button" class="btn btn-outline-light py-0 my-0" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  SignUp
</button>
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title align-self-center" id="staticBackdropLabel">Create Account</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- signIN -->
        <section class="d-flex container justify-content-center">
          <div class="row">
            <form action="" class="border-1 botder border-white" method="post">
              <!-- name -->
              <div class="container">
                <label for="userName">Name </label>
                <div class="input-group d-flex mb-2">
                  <input id="userName" type="text" class="form-control" aria-label="Username"
                    aria-describedby="addon-wrapping" name="userName">
                </div>
                <span id="userNameAlertText" class="d-block">
                </span>
              </div>
              <!-- email -->
              <div class="container">
                <label for="userEmail">Email </label>
                <div class="input-group flex-nowrap mb-2">
                  <input type="text" id="userEmail" class="form-control" aria-label="Username"
                    aria-describedby="addon-wrapping" name="userEmail">
                </div>
                <span id="userEmailAlertText" class="">
              </div>
              <!-- password -->
              <div class="container">
                <label for="userPassword">Password </label>
                <div class="input-group flex-nowrap mb-2">
                  <input type="text" id="userPassword" class="form-control" aria-label="Username"
                    aria-describedby="addon-wrapping" name="userPassword">
                </div>
                <span id="userPasswordAlertText" class="">
              </div>
              <!--Confirm password -->
              <div class="container">
                <label for="userConfirmPassword">Confirm Password </label>
                <div class="input-group flex-nowrap mt-2 mb-2">
                  <input type="text" id="userConfirmPassword" class="form-control" aria-label="Username"
                    aria-describedby="addon-wrapping" name="userConfirmPassword">
                </div>
                <span id="userConfirmPasswordAlertText" class="">
              </div>
              <!--mobile-->
              <div class="container">
                <label for="userMobile">Mobile No </label>
                <div class="input-group flex-nowrap mt-2 mb-2">
                  <span class="input-group-text userMobileLabel" id="addon-wrapping">+880</span>
                  <input type="text" id="userMobile" name="userMobile" class="form-control" aria-label="Username"
                    aria-describedby="addon-wrapping">
                </div>
                <span id="userMobileAlertText" class="">
              </div>
              <!-- Adress -->
              <div class="container">
                <label for="userAddress">Address </label>
                <div class="input-group flex-nowrap mt-2 mb-2">
                  <input type="text" id="userAddress" name="userAddress" class="form-control" aria-label="Username"
                    aria-describedby="addon-wrapping">
                </div>
                <span id="userAddressAlertText" class="">
              </div>
              <!-- gender -->
              <div class="container mt-3">
                <div class="border p-1 rounded"> <label class="text-center" id="">Gender</label>
                  <div class="input-group flex-nowrap mt-2 mb-2">
                    <div class="w-100 bg-white d-flex align-items-center justify-content-evenly">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="userGender" id="exampleRadios1" value="male"
                          checked>
                        <label class="form-check-label" for="exampleRadios1">
                          Male
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="userGender" id="exampleRadios2"
                          value="female">
                        <label class="form-check-label" for="exampleRadios2">
                          Female
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="userGender" id="exampleRadios2"
                          value="other">
                        <label class="form-check-label" for="exampleRadios2">
                          Other
                        </label>
                      </div>
                    </div>
                  </div>
                  <span id="userAddressAlertText" class="">
                  </span>
                </div>
              </div>
              <!-- image -->
              <!-- <div class="container col-sm-12">
                <div class="input-group mt-2 mb-2 ">
                  <input type="file" class="form-control img-fluid" id="userImage" name="userImage" hidden
                    accept="Image/*">
                  <img id="imagePreview" class="w-100" style="display: none;max-height: 300px; object-fit: fill;">
                </div>
                <h5 class="btn btn-light container w-100" id="imageBtn">Upload Image</h5>
              </div> -->
              <div class="container d-flex justify-content-between mt-5">
                <button type="submit" value="1" name="submit" class="btn btn-dark"> Create a Acount
                </button>
              </div>
            </form>
          </div>
        </section>
      </div>
    </div>
  </div>
</div>
