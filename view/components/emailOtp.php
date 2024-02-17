<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send OTP or Verification Code</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Send OTP or Verification Code</h2>
        <form id="emailVerificationForm">
            <div class="form-group">
                <label for="email">Enter Email Address:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter your email address">
            </div>
            <button type="button" class="btn btn-primary" onclick="sendCode()">Send Code</button>
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
        async function sendCode() {
            try {
                // Initialize Firebase if not done already
                if (!firebase.apps.length) {
                    firebase.initializeApp(firebaseConfig);
                }

                const email = document.getElementById('email').value;
                const messageArea = document.getElementById('messageArea');

                const userRecord = await isEmailPresent(email);

                if (userRecord) {
                    const emailVerified = await isEmailVerified(email);
                    
                    if (emailVerified) {
                        // Email is present and verified
                        messageArea.innerHTML = `<div class="alert alert-success" role="alert">Email is present and verified</div>`;
                    } else {
                        // Email is present but not verified, send OTP logic goes here
                        messageArea.innerHTML = `<div class="alert alert-warning" role="alert">Email is present but not verified. Send OTP logic here.</div>`;
                    }
                } else {
                    // Email is not present, create a user without a password and send email for verification
                    await createUserAndSendVerificationEmail(email);
                    messageArea.innerHTML = `<div class="alert alert-info" role="alert">User created without password. Verification email sent.</div>`;
                }
            } catch (error) {
                console.error('Error:', error);
                const messageArea = document.getElementById('messageArea');
                if (error.code === 'auth/email-already-in-use') {
                    messageArea.innerHTML = `<div class="alert alert-danger" role="alert">The email address is already in use by another account.</div>`;
                } else {
                    messageArea.innerHTML = `<div class="alert alert-danger" role="alert">${error.message || 'Error checking email presence'}</div>`;
                }
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

        async function isEmailVerified(email) {
            try {
                const user = await firebase.auth().getUserByEmail(email);
                return user.emailVerified;
            } catch (error) {
                throw error;
            }
        }

        async function createUserAndSendVerificationEmail(email) {
            try {
                const password = generateTemporaryPassword(); // Generate a temporary password
                const userCredential = await firebase.auth().createUserWithEmailAndPassword(email, password);
                await userCredential.user.sendEmailVerification();

                // Optional: Update the user's password after email verification
                await userCredential.user.updatePassword(''); // Update with an empty string or a new password
            } catch (error) {
                throw error;
            }
        }

        function generateTemporaryPassword() {
            // Replace this with your logic to generate a temporary password
            return 'temporaryPassword123';
        }
    </script>
</body>

</html>
