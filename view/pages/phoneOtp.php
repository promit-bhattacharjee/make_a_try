<?php
session_start();
class getUserData
{
    private $connect;

    function __construct()
    {
        require("../connections/database.php");
        $this->connect = $connect;
    }

    public function getUserData()
    {
        $sql = "SELECT * FROM users WHERE user_id={$_SESSION['user_id']} LIMIT 1";
        $result = mysqli_query($this->connect, $sql);

        if ($result) {
            $user_data = mysqli_fetch_assoc($result);
            mysqli_free_result($result);
            return (string) $user_data["user_mobile"];
        } else {
            echo "Query error: " . mysqli_error($this->connect);
        }
    }

    public function updateVerificationStatus()
    {
        // Check the current verification status
        $checkQuery = "SELECT user_verification_status FROM users WHERE user_id=$_SESSION[user_id] LIMIT 1";
        $checkResult = mysqli_query($this->connect, $checkQuery);
        $q = mysqli_fetch_assoc($checkResult);
        if ($q["user_verification_status"] == "verified") {
            header("location:forgetPassword.php");
            exit;
        } else {
            $updateQuery = "UPDATE users SET user_verification_status='verified' WHERE user_id={$_SESSION['user_id']} LIMIT 1";
            $updateResult = mysqli_query($this->connect, $updateQuery);
            if ($updateResult) {
                return true;
            } else {
                echo "Query error: " . mysqli_error($this->connect);
                return false;
            }
        }


    }

}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $nl = new getUserData();
    $verificationStatus = $nl->updateVerificationStatus();

    if ($verificationStatus) {
        echo "<script>window.alert('Verification Successful')</script>";
        header('Location:userDashBoard.php');
        exit;
    } else {
        echo "<script>window.alert('Verification Failed')</script>";
        header('Location:userDashBoard.php');
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
                <input type="text" id="number" name="number" class="form-control" value="<?php $obj = new getUserData();
                echo "+880" . $obj->getUserData() ?>">
            </div>
            <div class="form-group m-3 d-none" id="verifyGroup">
                <label for="verification">Enter Verification Number:</label>
                <input type="text" id="verification" name="verification" class="form-control">
            </div>
            <!-- reCAPTCHA container -->
            <div id="recaptcha-container" class="m-3"></div>
            <button type="button" class="btn btn-primary m-3" id="submitBtn" onclick="phoneAuth()">Send OTP</button>
            <button type="button" class="btn btn-primary m-3 d-none" id="verifyBtn"
                onclick="codeverify()">Verify</button>
            <button type="button" class="btn btn-primary m-3 d-none" id="resetForm" onclick="resetVerification()">Resend
                Code</button>
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
            firebase.auth(app).signInWithPhoneNumber(number, window.recaptchaVerifier).then(function (
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