<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("../components/DomHeader.php");
    ?>
    <style>
        /* Add your custom styles here */
        .list-group-item {
            cursor: pointer;
        }
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

                <a href="#updateProfile" class="btn btn-outline-dark btn-lg active col-xxl-5 col-xl-5 col-lg-5 col-md-8 col-sm-8 col-10 my-3" data-toggle="tab" style="height:100px;">
                    <div class="container h-100 w-100 d-flex justify-content-center align-items-center">
                        <i class="fas fa-user align-middle me-2"></i>Update Profile
                    </div>
                </a>
                <a href="#updateProfile" class="btn btn-outline-dark btn-lg active col-xxl-5 col-xl-5 col-lg-5 col-md-8 col-sm-8 col-10 my-3" data-toggle="tab" style="height:100px;">
                    <div class="container h-100 w-100 d-flex justify-content-center align-items-center">
                    <i class="fas fa-envelope  me-2"></i> Verify Account
                    </div>
                </a>
                <a href="#updateProfile" class="btn btn-outline-dark btn-lg active col-xxl-5 col-xl-5 col-lg-5 col-md-8 col-sm-8 col-10 my-3" data-toggle="tab" style="height:100px;">
                    <div class="container h-100 w-100 d-flex justify-content-center align-items-center">
                    <i class="fas fa-shopping-bag  me-2"></i> Number of Orders
                    </div>
                </a>
                <a href="#updateProfile" class="btn btn-outline-dark btn-lg active col-xxl-5 col-xl-5 col-lg-5 col-md-8 col-sm-8 col-10 my-3" data-toggle="tab" style="height:100px;">
                    <div class="container h-100 w-100 d-flex justify-content-center align-items-center">
                    <i class="fas fa-lock  me-2"></i> Change Password
                    </div>
                </a>

        </div>
    </div>
</main>

    <!-- Include Bootstrap JS and jQuery -->
    <div class="fixed-bottom">
        <?php include("../components/footer.php");?>
    </div>
    <?php
    
    include("../components/DomFooter.php");

    ?>
</body>

</html>