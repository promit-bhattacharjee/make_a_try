<?php
include("../components/loginChecker.php")
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profile Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <section class="">
        <button id="verifiedBtn" class="btn btn-primary m-auto" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling" disabled>Enable body scrolling</button>

        <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Offcanvas with body scrolling</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <p>Try scrolling the rest of the page to see this option in action.</p>
          </div>
        </div>
    </section>
    <section>   
      <?php
        include("../components/userDetalis.php");
      ?>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- Include Firebase SDK (version 8) -->
    <!-- <script src="https://www.gstatic.com/firebasejs/8.6.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.1/firebase-auth.js"></script>

    <script>


        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);

        // Check if the user's email is verified
        firebase.auth().onAuthStateChanged((user) => {
            const verifiedBtn = document.getElementById('verifiedBtn');

            if (user) {
                // User is signed in
                if (user.emailVerified) {
                    // Email is verified, enable the button
                    verifiedBtn.disabled = false;
                } else {
                    // Email is not verified, redirect to the verification page
                    window.location.href = 'path_to_verify_email_page';
                }
            } else {
                // User is signed out, redirect to the login page
                window.location.href = '/makeATry/home.php';
            }
        });
    </script> -->
</body>
</html>
