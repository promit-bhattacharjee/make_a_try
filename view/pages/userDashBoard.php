<?php include("../components/userLoginChecker.php") ?>
<?php
class UserDashBoard
{
    private $connect;
    private $userData=[];
    function __construct()
    {
        require("../connections/database.php");
        $this->connect = $connect;
    }

    function isVerified()
    {
        $userId = $_SESSION['user_id'];
        $sql = "SELECT * FROM users WHERE user_id = $userId";

        // Execute the query.
        $result = mysqli_query($this->connect, $sql);
        $data = mysqli_fetch_assoc($result);
        if ($data && $data['user_verification_status'] === 'verified') {
            $this->userData=$data;
            return true;
        } else {
            return false;
        }

    }
    public function getUserData()
    {
        return $this->userData;
    }
}

$userDashboard = new UserDashBoard();
$userVerified = $userDashboard->isVerified();
// $userData=$userDashboard->getUserData();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("../components/DomHeader.php");
    ?>
    <style>
        /* Add your custom styles here */
        /* .list-group-item {
            cursor: pointer;
        } */
    </style>
</head>

<body>
    <?php
    include("../components/navbar.php");
    ?>
    <main class="">
        <div class="c" style="height:150px"></div>
        <div class="container">
            <div class="row d-flex justify-content-evenly align-items-between ">
                <?php include("../connections/database.php");
                if ($userVerified) {
                    echo "" ?>
                    <a href="../components/userProfileUpdateModal.php"
                        class="btn btn-outline-dark btn-lg active col-xxl-5 col-xl-5 col-lg-5 col-md-8 col-sm-8 col-10 my-3"
                        data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="height:100px;">
                        <div class="container h-100 w-100 d-flex justify-content-center align-items-center">
                            <i class="fas fa-user align-middle me-2"></i>Update Profile
                        </div>
                    </a>
                <?php
                }
                ?>
                <?php
                include("../components/userProfileUpdateModal.php");
                if (!$userVerified) {
                    echo "" ?>
                    <a href="../pages/phoneOtp.php"
                        class="btn btn-outline-dark btn-lg active col-xxl-5 col-xl-5 col-lg-5 col-md-8 col-sm-8 col-10 my-3"
                        style="height:100px;">
                        <div class="container h-100 w-100 d-flex justify-content-center align-items-center">
                            <i class="fas fa-envelope  me-2"></i> Verify Account
                        </div>
                    </a>
                    <?php
                } else {
                    echo "" ?>
                    <a href="" class="btn btn-success btn-lg col-xxl-5 col-xl-5 col-lg-5 col-md-8 col-sm-8 col-10 my-3"
                        data-toggle="tab" style="height:100px;">
                        <div class="container h-100 w-100 d-flex justify-content-center align-items-center" disabled>
                            <i class="fas fa-check-circle me-2" disabled></i> Verified Account
                        </div>
                    </a>

                    <?php
                }
                ?>
                <a href="numbersOfOrders.php"
                    class="btn btn-outline-dark btn-lg active col-xxl-5 col-xl-5 col-lg-5 col-md-8 col-sm-8 col-10 my-3"
                    style="height:100px;">
                    <div class="container h-100 w-100 d-flex justify-content-center align-items-center">
                        <i class="fas fa-shopping-bag  me-2"></i> Number of Orders
                    </div>
                </a>
                <!-- <a href="phoneOtp.php"
                    class="btn btn-outline-dark btn-lg active col-xxl-5 col-xl-5 col-lg-5 col-md-8 col-sm-8 col-10 my-3"
                    data-toggle="tab" style="height:100px;">
                    
                    <div class="container display-block h-100 w-100 d-flex justify-content-center align-items-center">
                        <i class="fas fa-lock  me-2"></i> Change Password
                    </div>
                    
                </a> -->
                <button
                    class="btn btn-outline-dark btn-lg active col-xxl-5 col-xl-5 col-lg-5 col-md-8 col-sm-8 col-10 my-3"
                    onclick="redirectToPhoneOtp()" style="height:100px;">
                    <a class="btn btn-outline-dark btn-lg text-white h-100 w-100" data-toggle="tab">
                        <div
                            class="container display-block h-100 w-100 d-flex justify-content-center align-items-center">
                            <i class="fas fa-lock me-2"></i> Change Password
                        </div>
                    </a>
                </button>
                <script>
                    function redirectToPhoneOtp() {
                        <?php $_SESSION['random_code'] = "set"; ?>
                        window.location.href = 'phoneOtp.php';
                    }
                </script>



            </div>
        </div>
    </main>

    <!-- Include Bootstrap JS and jQuery -->
    <div class="fixed-bottom">
        <?php include("../components/footer.php"); ?>
    </div>
    <?php

    include("../components/DomFooter.php");

    ?>
    <!-- <script src="../validation/signupValidation.js"></script> -->

</body>

</html>