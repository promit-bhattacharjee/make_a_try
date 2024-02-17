<?php
// session_start();

class UserDetails
{
    function getUserInfo()
    {
        include("../connections/database.php");
        $sql = "SELECT * FROM user WHERE `user_id`='$_SESSION[user_id]' AND `user_email`='$_SESSION[user_email]' LIMIT 1";
        $result = mysqli_query($connect, $sql);
        if (mysqli_num_rows($result) == 1) {
            return mysqli_fetch_assoc($result);
        } else {
            echo "Database error!";
            exit;
        }
    }
    function updateUserInfo()
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include("../connections/database.php");

            // Ensure the user is logged in
            if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {
                $userId = $_SESSION['user_id'];
                $userEmail = $_SESSION['user_email'];

                // Validate and sanitize inputs (you may need to customize this based on your requirements)
                $userMobile = isset($_POST['userMobile']) ? mysqli_real_escape_string($connect, $_POST['userMobile']) : '';
                $userAddress = isset($_POST['userAddress']) ? mysqli_real_escape_string($connect, $_POST['userAddress']) : '';

                // Update user details in the database
                $sql = "UPDATE user SET user_mobile='$userMobile', user_address='$userAddress' WHERE user_id='$userId' AND user_email='$userEmail'";
                $result = mysqli_query($connect, $sql);

                if ($result) {
                    // Update successful
                    // header("Location: profile.php"); // Redirect to the profile page
                    // exit;
                } else {
                    // Update failed
                    echo "Database error: " . mysqli_error($connect);
                    exit;
                }
            }
        }

    }
}

// Instantiate the UserDetails class
$userDetails = new UserDetails();
$userInfo = $userDetails->getUserInfo();
$userDetails->updateUserInfo();
?>

<div class="row">
    <div class="col-sm-11 col-md-11 col-12 col-xl-6 col-xxl-6 m-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Profile Information</h5>
            </div>
            <div class="card-body">
                <form id="profileForm" action="" method="post">
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="userEmail">Email</label>
                            <div class="d-flex">
                                <input type="text" class="form-control" id="userEmail" name="userEmail"
                                    value="<?php echo $userInfo['user_email']; ?>" readonly>
                                <button type="button" class="btn btn-success" id="userEmailVerificationBtn"
                                    onclick="" ><a href="../components/emailOtp.php">Verify</a></button>
                            </div>
                        </div>
                        <div class="form-group col">
                            <label for="userMobile">Mobile Number</label>
                            <div class="d-flex">
                                <input type="text" class="form-control" id="userMobile" name="userMobile"
                                    value="<?php echo $userInfo['user_mobile']; ?>">
                                <button type="button" class="btn btn-success" onclick="verifyMobile()">Verify</button>
                            </div>
                        </div>
                        <div class="form-group col">
                            <label for="userAddress">User Address</label>
                            <input type="text" class="form-control" id="userAddress" name="userAddress"
                                value="<?php echo $userInfo['user_address']; ?>">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://www.gstatic.com/firebasejs/8.6.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.6.1/firebase-auth.js"></script>
<script src="../connections/firebaseConfig.js"></script>
<script>
    firebase.initializeApp(firebaseConfig);
    function checkEmailStatus() {
        const userEmailVerificationBtn = document.getElementById('userEmailVerificationBtn');
        const email = document.getElementById('userEmail').value;
        if (email) {
            // Check if the email is already registered
            firebase.auth().fetchSignInMethodsForEmail(email)
                .then((providers) => {
                    if (providers && providers.length > 0) {
                        // Email is registered, check if it's verified
                        const user = firebase.auth().currentUser;
                        if (user && user.emailVerified) {
                            // Email is registered and verified
                            userEmailVerificationBtn.disabled = true;

                            // Update class and type attributes (optional)
                            userEmailVerificationBtn.classList.add('disabled'); // You can define a 'disabled' class in your CSS for styling
                            userEmailVerificationBtn.type = 'button';
                        } else {
                            // Email is registered but not verified
                            alert('Email is registered but not verified.');
                            // You can add logic here to send a verification email or handle as needed
                        }
                    } else {
                        // Email is not registered
                        alert('Email is not registered.');
                        // You can add logic here to handle as needed
                    }
                })
                .catch((error) => {
                    // Handle errors
                    console.error(error.message);
                    alert('Error checking email status.');
                });
        } else {
            alert('Please enter a valid email address.');
        }
    }
</script> -->