<?php      
session_start();
 
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="../connections/color.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body class="primaryBgClr">
  <header class="SecondaryBgClr">
<?php
include("../components/navbar.php");
?>
    <div class="container-fluid pb-4"
      style="background-image: url('../assets/bg/headerBgRight.svg');background-repeat: no-repeat;background-size: cover; background-color: rgba(34, 23, 99,0.75);">
      <div class="row d-flex justify-content-around">
        <div class="align-self-center col-xs-10 col-12 col-xl-12 col-xxl-4">
          <h1 class="text-light display-1 fw-bold">Optical
            Reality</h1>
          <p class="text-light fw-light display-6">We provide an interactive experience in which a real world
            environment<br>
            enhanced with computer-generated visual elements</p>
            <div class="container d-flex justify-content-start">
            <!-- signUP -->
            <?php include("../components/signUp.php")?>
            <div class="col-1"></div>
            <!-- login -->
            <?php 
            if(!isset($_SESSION['user_email']) && !isset($_SESSION['user_id'])){
              include("../components/login.php");
             }
            ?>
          </div>
        </div>
        <img class="col-xs-6 col-xl-4 col-xxl-4 col-sm-12" src="assets/image/headerRightImage.svg" alt="">
      </div>
    </div>
  </header>
  <main>
    <!-- text and banner -->
    <section>
      <div class="container-fluid"
        style="background-image:url('../assets/bg/Oohapebg.svg');background-color: #221763;background-repeat: no-repeat;background-size: contain; background-position: right;">
        <div
          class="row justify-content-lg-start justify-content-md-start justify-content-lg-start justify-content-xl-around justify-content-xxl-around ">
          <!-- <div class="col-xxl-2 d-sm-none d-md-none d-lg-none d-xl-none d-xxl-block"></div> -->
          <div class="text-white text-xs-justify display-6 mt-5 col-md-12 col-lg-12 col-xl-3 col-xxl-3 pb-xl-4">
            Augmented reality is an
            interactive
            experience in which a real world environment is enhanced with computer-generated visual elements,
            sounds,
            and other stimuli. It can provide a user with a heightened, more immersive experience than they would
            experience otherwise that adds to the user's enjoyment or understanding.
          </div>
          <!-- <div class="col-xl-1 d-sm-none d-block d-xxl-block"></div> -->
          <img class="col-10 col-md-10 col-lg-10 h-auto col-xl-8 col-xxl-8" src="../assets/bg/tryOutBgMale.svg" alt=""
            style="object-fit: cover; overflow-x: visible;">
        </div>
      </div>
    </section>
    <!-- tryout -->
    <section>
      <div class="container-fluid d-flex justify-content-center align-items-center" id="tryout"
        style="height: 768px; background-image: url('../assets/bg/tryOutbg.svg');background-repeat: no-repeat; background-position: center;background-size:cover;">
        <butto class="btn text-white">
          <a href="faceEncoding.html" class="text-decoration-none display-1 fw-bolder text-white">TRY NOW</a>
          </button>
      </div>
    </section>
    <!-- catagory -->
    <section class="mt-5">
      <div class="container-fluid">
        <div class="row justify-content-around">
          <a class="btn col-xxl-3 col-xl-4 col-lg-5 col-md-5 col-sm-10 col-10" href="#">
            <div class="container">
              <img class="h-100 w-100" src="../assets/bg/glassBg.svg" alt="">
              <h1 class="text-center container bg-white pb-4">Optical</h1>
            </div>
          </a>
          <a class="btn col-xxl-3 col-xl-4 col-lg-5 col-md-5 col-sm-10 col-10" href="#">
            <div class="container">
              <img class="h-100 w-100" src="../assets/bg/glassBg.svg" alt="">
              <h1 class="text-center container bg-white pb-4">Fashion</h1>
            </div>
          </a>

          <a class="btn col-xxl-3 col-xl-4 col-lg-5 col-md-5 col-sm-10 col-10" href="#">
            <div class="container">
              <img class="h-100 w-100" src="../assets/bg/glassBg.svg" alt="">
              <h1 class="text-center container bg-white pb-4">Sunglass</h1>
            </div>
          </a>
          <a class="btn col-xxl-5 col-xl-4 col-lg-5 col-md-5 col-sm-10 col-10" href="#">
            <div class="container">
              <img class="h-100 w-100" src="../assets/bg/glassBg.svg" alt="">
              <h1 class="text-center container bg-white pb-4">Sports</h1>
            </div>
          </a>

        </div>
      </div>
    </section>
    <section class="position-fixed " style="bottom:20px;right:20px">
    <a class="btn btn-outline-dark p-3 " href="#">Cart <i class="fa-solid fa-cart-shopping"></i></a>
    </section>
  </main>
  <!-- footer -->
  <?php include("../components/footer.php") ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
  <script src="validate.js"></script>
</body>
</html>