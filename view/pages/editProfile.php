<?php
session_start();
include 'database.php';
$userName;
$userAdress;
$gender;
// $userImage='';
$checkMale='';
$checkFemale='';
$checkOther='';
if(isset($_SESSION['user'])) {
    $currentUserEmail = $_SESSION['user'];
    $query = "SELECT * FROM `user` WHERE `email`='$currentUserEmail' LIMIT 1";
    $data = mysqli_query($connect, $query);
    if ($data) {
        while ($row = mysqli_fetch_array($data)) {
            $userName=$row['name'];
            $userAdress=$row['adress'];
            $gender=$row['gender'];
            $userImage=$row['image'];
            if ($gender === 'male') {
                $checkMale = "checked";
            }
            if ($gender === 'female'){
                $checkFemale="checked";
            }
            if ($gender === 'both'){
                
                $checkOther="checked";
            }
            echo "<section class='d-flex container justify-content-center' onload='signup.js'>
            <div class='row'>
                <form action='editProfileAction.php' class='border-1 botder border-white' enctype='multipart/form-data' method='post'>
                    <h4 class='text-light text-center'>UpdateData</h4>
                    <!-- Images -->
                    <div class='container col-sm-12'>
                        <div class='input-group mt-2 mb-2 '>
                            <input type='file' class='form-control img-fluid' id='userImage' name='userImage' hidden
                                accept='Image/*' onChange='imgs()' value='$userImage'>
                            <img id='imagePreview' src='$userImage' class='w-100 d-block rounded-circle'
                                style='display: none;max-height: 300px; object-fit: fill;' style='d-block'>
                        </div>
                        <!-- <span id='userAdressAlertText' class=''> -->
                        <h5 class='btn btn-light container w-100' id='imageBtn' onClick='userImage.click()'>Upload Image</h5>
                        <script>
                            function imgs(){
                                let preview = document.getElementById('imagePreview');
                                let imgInput = document.getElementById('userImage');
                                if (imgInput.files && imgInput.files[0]) {
                                    preview.src = URL.createObjectURL(imgInput.files[0]);
                                    preview.style.display = 'inline-block';
                                }
                            }
                        </script>
                    </div>
                    <!-- name -->
                    <div class='container'>
                        <div class='input-group d-flex mb-2'>
                            <span class='input-group-text userNameLabel' id='addon-wrapping'>Name</span>
                            <input id='userName' type='text' class='form-control' aria-label='Username'
                                aria-describedby='addon-wrapping' name='userName' value='$userName'>
                        </div>
                        <span id='userNameAlertText' class='d-block'>
                        </span>
                    </div>
                    <!-- email -->
                    <!-- <div class='container'>
                        <div class='input-group flex-nowrap mt-2 mb-2'>
                            <span class='input-group-text userEmailLabel' id='addon-wrapping'>Email</span>
                            <input type='text' id='userEmail' class='form-control' aria-label='Username'
                                aria-describedby='addon-wrapping' name='userEmail'>
                        </div>
                        <span id='userEmailAlertText' class=''>
                    </div> -->
                    <!-- password -->
                    <!-- <div class='container'>
                        <div class='input-group flex-nowrap mt-2 mb-2'>
                            <span class='input-group-text userPasswordLabel' id='addon-wrapping'>Password</span>
                            <input type='text' id='userPassword' class='form-control' aria-label='Username'
                                aria-describedby='addon-wrapping' name='userPassword'>
                        </div>
                        <span id='userPasswordAlertText' class=''>
                    </div> -->
                    <!--Confirm password -->
                    <!-- <div class='container'>
                        <div class='input-group flex-nowrap mt-2 mb-2'>
                            <span class='input-group-text userConfirmPasswordLabel' id='addon-wrapping'>Confirm
                                Password</span>
                            <input type='text' id='userConfirmPassword' class='form-control' aria-label='Username'
                                aria-describedby='addon-wrapping' name='userConfirmPassword'>
                        </div>
                        <span id='userConfirmPasswordAlertText' class=''>
                    </div> -->
                    <!--mobile-->
                    <!-- <div class='container'>
                        <div class='input-group flex-nowrap mt-2 mb-2'>
                            <span class='input-group-text userMobileLabel' id='addon-wrapping'>Mobile</span>
                            <input type='text' id='userMobile' name='userMobile' class='form-control' aria-label='Username'
                                aria-describedby='addon-wrapping'>
                        </div>
                        <span id='userMobileAlertText' class=''>
                    </div> -->
                    <!-- Adress -->
                    <div class='container'>
                        <div class='input-group flex-nowrap mt-2 mb-2'>
                            <span class='input-group-text userAdressLabel' id='addon-wrapping'>Adress</span>
                            <input type='text' id='userAdress' name='userAdress' class='form-control' aria-label='Username'
                                aria-describedby='addon-wrapping' value='$userAdress'>
                        </div>
                        <span id='userAdressAlertText' class=''>
                    </div>
                    <!-- gender -->
                    <div class='container'>
                        <div class='input-group flex-nowrap mt-2 mb-2 rounded-3'>
                            <span class='input-group-text userAdressLabel' id='addon-wrapping'>Gender</span>
                            <div class='w-100 bg-white d-flex align-items-center justify-content-evenly '>
                                <div class='form-check'>
                                    <input class='form-check-input' type='radio' name='userGender' id='exampleRadios1'
                                        value='male' $checkMale>
                                    <label class='form-check-label' for='exampleRadios1'>
                                        Male
                                    </label>
                                </div>
                                <div class='form-check'>
                                    <input class='form-check-input' type='radio' name='userGender' id='exampleRadios2'
                                        value='female' $checkFemale>
                                    <label class='form-check-label' for='exampleRadios2' >
                                        Female
                                    </label>
                                </div>
                                <div class='form-check'>
                                    <input class='form-check-input' type='radio' name='userGender' id='exampleRadios2'
                                        value='other' $checkOther>
                                    <label class='form-check-label' for='exampleRadios2'>
                                        Other
                                    </label>
                                </div>
                            </div>
                        </div>
                        <span id='userAdressAlertText' class=''>
                    </div>
                    <div class='container d-flex justify-content-between'>
                        <button type='submit' class='btn btn-outline-light'> Update
                        </button>
                    </div>
                </form>
            </div>
        </section>
        ";
        }
    } else {
        echo "Query Error: " . mysqli_error($connect);
    }
} 
else {
    echo "Login First";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="color.css">
    <title>edit</title>
</head>

<body class="primaryBgClr">
    </header>
    
    <script src="signup.js"></script>
    <!-- <script src="firebase.js"></script> -->
</body>
</html>