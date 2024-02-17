<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobile OTP Verification</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Mobile OTP Verification</h2>
        <form id="otpVerificationForm">
            <div class="form-group">
                <label for="phoneNumber">Enter Phone Number:</label>
                <input type="tel" class="form-control" id="phoneNumber" placeholder="Enter your phone number">
            </div>
            <button type="button" class="btn btn-primary" onclick="sendOtp()">Send OTP</button>
            <div class="form-group mt-3">
                <label for="otp">Enter OTP:</label>
                <input type="text" class="form-control" id="otp" placeholder="Enter the OTP received">
            </div>
            <button type="button" class="btn btn-success mt-3" onclick="verifyOtp()">Verify OTP</button>
        </form>
        <!-- Message display area -->
        <div id="messageArea" class="mt-3"></div>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!-- Include Firebase SDK (version 8) -->
    <script src="https://www.gstatic.com/firebasejs/8.6.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.1/firebase-auth.js"></script>
    <script src="../connections/firebaseConfig.js"></script>
    <script>
        // Initialize Firebase if not done already
        if (!firebase.apps.length) {
            firebase.initializeApp(firebaseConfig);
        }

        async function sendOtp() {
            try {
                const phoneNumber = document.getElementById('phoneNumber').value;
                const messageArea = document.getElementById('messageArea');

                // Check if user exists
                const userRecord = await isEmailPresent(phoneNumber);

                if (userRecord) {
                    // User exists, send OTP for verification
                    const confirmationResult = await firebase.auth().signInWithPhoneNumber(phoneNumber);
                    window.confirmationResult = confirmationResult;

                    messageArea.innerHTML = `<div class="alert alert-success" role="alert">OTP sent successfully</div>`;
                } else {
                    // User does not exist, create a new user
                    await firebase.auth().createUserWithEmailAndPassword(`${phoneNumber}@example.com`, 'defaultPassword');

                    // Send OTP for verification
                    const confirmationResult = await firebase.auth().signInWithPhoneNumber(phoneNumber);
                    window.confirmationResult = confirmationResult;

                    messageArea.innerHTML = `<div class="alert alert-success" role="alert">User created, OTP sent successfully</div>`;
                }
            } catch (error) {
                console.error('Error:', error);
                const messageArea = document.getElementById('messageArea');
                messageArea.innerHTML = `<div class="alert alert-danger" role="alert">${error.message || 'Error sending OTP'}</div>`;
            }
        }

        async function verifyOtp() {
            try {
                const otp = document.getElementById('otp').value;
                const messageArea = document.getElementById('messageArea');

                // Verify OTP
                const confirmationResult = window.confirmationResult;
                const userCredential = await confirmationResult.confirm(otp);

                // User is now verified
                messageArea.innerHTML = `<div class="alert alert-success" role="alert">OTP verification successful</div>`;
            } catch (error) {
                console.error('Error:', error);
                const messageArea = document.getElementById('messageArea');
                messageArea.innerHTML = `<div class="alert alert-danger" role="alert">${error.message || 'Error verifying OTP'}</div>`;
            }
        }

        async function isEmailPresent(email) {
            try {
                const userRecord = await firebase.auth().fetchSignInMethodsForEmail(email);
                return userRecord.length > 0;
            } catch (error) {
                if (error.code === 'auth/invalid-email') {
                    // Handle invalid email address
                    throw new Error('Invalid email address');
                } else {
                    throw error;
                }
            }
        }
    </script>
</body>

</html>
