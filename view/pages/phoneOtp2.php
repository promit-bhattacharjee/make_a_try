<?php
session_start();
$userMobile = '';
require("../connections/database.php");
if ($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['random_code'])) {
    $userMobile = mysqli_real_escape_string($connect, $_GET['random_code']);

    $sql = "SELECT * FROM users WHERE user_mobile='" . mysqli_real_escape_string($connect, $userMobile) . "' LIMIT 1";
    $result = mysqli_query($connect, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        $userMobile = htmlspecialchars(trim($user_data["user_mobile"]));
    } else {
        // Handle the case where no user is found
        // echo "<script>alert('Your verification was not successful!'); window.location.href = '../pages/home.php';</script>";
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['number'])) {
    $userMobile = mysqli_real_escape_string($connect, $_POST['number']);

    $sql = "SELECT * FROM users WHERE user_mobile='" . mysqli_real_escape_string($connect, $userMobile) . "' LIMIT 1";
    $result = mysqli_query($connect, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
        $_SESSION['user_mobile'] = $user_data['user_mobile']; 
        $_SESSION['user_id'] = $user_data['user_id']; 
        // echo"get";
        echo "<script>alert('Your verification was successful!'); window.location.href = '../pages/forgetPassword.php';</script>";

        $userMobile = '';  // Reset $userMobile after successful verification
    } else {
        // Handle the case where no user is found
        echo "<script>alert('Your verification was not successful!'); window.location.href = '../pages/home.php';</script>";
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Firebase Phone Authentication</title>
    <?php include("../components/DomHeader.php") ?>
    <script src="https://www.gstatic.com/firebasejs/10.8.0/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/10.8.0/firebase-auth-compat.js"></script>
</head>

<body>
    <?php include("../components/navbar.php") ?>
    <div class="container" style="height: 100px;"></div>
    <div class="container d-flex justify-content-center">
        <form action="" method="post" id="form">
            <div class="form-group m-3 d-flex">
                <label for="number"></label>
                <input type="text" id="number" name="number" class="form-control" value="<?php echo htmlspecialchars($userMobile);?>" readonly>
            </div>
            <div class="form-group m-3 d-none" id="verifyGroup">
                <label for="verification">Enter Verification Number:</label>
                <input type="text" id="verification" name="verification" class="form-control">
            </div>
            <!-- reCAPTCHA container -->
            <div id="recaptcha-container" class="m-3"></div>
            <button type="button" class="btn btn-primary m-3" id="submitBtn" onclick="phoneAuth()">Send OTP</button>
            <button type="button" class="btn btn-primary m-3 " id="verifyBtn" onclick="codeverify()">Verify</button>
            <button type="button" class="btn btn-primary m-3 d-none" id="resetForm" onclick="resetVerification()">Resend Code</button>
        </form>
    </div>

    <?php include("../components/DomFooter.php") ?>
    <script>
        const firebaseConfig = {
            apiKey: "AIzaSyCLFFkk33kRY9AJGHZexYJQO50_DBuqcDQ",
            authDomain: "ookd-3a7f7.firebaseapp.com",
            projectId: "ookd-3a7f7",
            storageBucket: "ookd-3a7f7.appspot.com",
            messagingSenderId: "604409529374",
            appId: "1:604409529374:web:c120ae3d486d1347b7da0f"
        };
        var app = firebase.initializeApp(firebaseConfig);
        var auth = firebase.auth(app);

        function render() {
            window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
            recaptchaVerifier.render();
        }

        var number = document.getElementById('number')
        var verify = document.getElementById('verification')
        var submitBtn = document.getElementById('submitBtn')
        var verifyBtn = document.getElementById('verifyBtn')
        var verifyGroup = document.getElementById('verifyGroup')
        var recaptchaContainer = document.getElementById('recaptcha-container')
        var resetForm = document.getElementById('resetForm')

        function phoneAuth() {
            var number = document.getElementById('number').value;
            firebase.auth(app).signInWithPhoneNumber("+880"+number, window.recaptchaVerifier).then(function (
                confirmationResult) {
                window.confirmationResult = confirmationResult;
                coderesult = confirmationResult;
                alert("OTP Sent");
                verifyGroup.classList.remove("d-none")
                verifyGroup.classList.add("d-block")
                verifyBtn.classList.remove("d-none")
                verifyBtn.classList.add("d-block")
                resetForm.classList.remove("d-none")
                resetForm.classList.add("d-block")
                recaptchaContainer.classList.add("d-none")
                submitBtn.classList.add('d-none')
            }).catch(function (error) {
                alert("error:" + error.message);
                resetForm.classList.remove("d-none")
                resetForm.classList.add("d-block")
            });
        }

        resetForm.addEventListener('click', function () {
            resetVerification();
        });

        function resetVerification() {
            verifyGroup.classList.add("d-none")
            verifyGroup.classList.remove("d-block")
            verifyBtn.classList.add("d-none")
            verifyBtn.classList.remove("d-block")
            recaptchaContainer.classList.remove("d-none")
            submitBtn.classList.remove('d-none')
        }

        function codeverify() {
            var code = document.getElementById('verification').value;
            coderesult.confirm(code).then(function () {
                alert('OTP Verified');
                check = true;
                document.getElementById('form').submit();
            }).catch(function () {
                alert('OTP Not correct');
                code.value = '';
                check = false;
            })
        }

        document.addEventListener('DOMContentLoaded', render);
    </script>
</body>

</html>
