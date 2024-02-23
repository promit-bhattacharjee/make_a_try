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
        $sql = "SELECT * FROM users WHERE user_id={$_SESSION['user_id']} AND user_email='{$_SESSION['user_email']}' LIMIT 1";
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
        $sql = "UPDATE users SET user_verification_status='verified' WHERE user_id={$_SESSION['user_id']} AND user_email='{$_SESSION['user_email']}' LIMIT 1";
        $result = mysqli_query($this->connect, $sql);

        if ($result) {
            // Update successful, do any additional actions if needed
            return true;

        } else {
            echo "Query error: " . mysqli_error($this->connect);
            return false;
        }

    }

}
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $nl = new getUserData();
    $verificationStatus = $nl->updateVerificationStatus();

    if ($verificationStatus) {
        // Verification successful, you can redirect or perform additional actions
        // For now, let's just echo a success message
        echo "Verification successful!";
        exit;
    } else {
        // Verification failed, you might want to handle this case
        echo "Verification failed!";
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
            <div class="form-group m-3">
                <label for="verification">Enter Verification Number:</label>
                <input type="text" id="verification" name="verification" class="form-control">
            </div>
            <!-- reCAPTCHA container -->
            <div id="recaptcha-container" class="m-3"></div>
            <button type="button" class="btn btn-primary m-3" id="submitBtn" onclick="phoneAuth()">Send OTP</button>
            <button type="button" class="btn btn-primary m-3" id="verifyBtn"
                onclick="codeverify()">Verify</button>
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
        // Render reCAPTCHA verifier
        function render() {
            window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
            recaptchaVerifier.render();
        }
        var number = document.getElementById('number')
        var verify = document.getElementById('verification')
        var submitBtn = document.getElementById('submitBtn')
        var verifyBtn = document.getElementById('verifyBtn')
        function phoneAuth() {
            var number = document.getElementById('number').value;
            firebase.auth(app).signInWithPhoneNumber(number, window.recaptchaVerifier).then(function (confirmationResult) {
                window.confirmationResult = confirmationResult;
                coderesult = confirmationResult;
                alert("OTP Sent");
            }).catch(function (error) {
                alert("error:" + error.message);

            });
        }
        let check=false
        function codeverify() {
            var code = document.getElementById('verification').value;
            coderesult.confirm(code).then(function () {
                alert('OTP Verified');
                check= true;
                document.getElementById('form').submit();
            }).catch(function () {
                alert('OTP Not correct');
                code.value = '';
                check =false;


            })
        }
        document.addEventListener('DOMContentLoaded', render);
    </script>
</body>

</html>