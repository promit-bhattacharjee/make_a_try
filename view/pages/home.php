<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>HomePage</title>
  <?php include("../components/homePageHeader.php") ?>
</head>

<body class="">
  <header class="bg-white">
    <?php
    include("../components/navbar.php");
    ?>

    <section style="height:600px" id="header" class="bg-dark">
      <div class="container-fluid pb-4 h-100"
      style="background-image: url('../assets/bg/headerBgRight.svg');background-repeat: no-repeat;background-size: cover; background-color: rgba(34, 23, 99,0.75);">
      <div class="contaner"style="height:250px" ></div>
        <div class="row d-flex justify-content-around">
          <div class="align-self-center col-xs-10 col-12 col-xl-12 col-xxl-4">
            <h1 class="text-light display-1 fw-bold">MAKE A TRY</h1>
            <p class="text-light fw-light display-6">See the World Differently<br> Where Style Meets Clarity at Make a Try!<br>
            </p>
            <div class="container d-flex justify-content-start">
              <!-- signUP -->

              <?php
              if (!isset($_SESSION['user_mobile'])  && !isset($_SESSION['user_id'])) {
                include("../components/signUp.php");
              }
              ?>
              <div class="col-1"></div>
              <!-- login -->
              <?php
              if (!isset($_SESSION['user_mobile']) && !isset($_SESSION['user_id'])) {
                include("../components/login.php");
              }
              ?>
            </div>
          </div>
          <img class="col-xs-6 col-xl-4 col-xxl-4 col-sm-12" src="assets/image/headerRightImage.svg" alt="">
        </div>
      </div>
    </section>
  </header>
  <main>
    <!-- text and banner -->
    <section>
      <div class="container-fluid"
        style="background-image:url('../assets/bg/Oohapebg.svg');background-color: #221763;background-repeat: no-repeat;background-size: contain; background-position: right;">
        <div
          class="row justify-content-lg-start justify-content-md-start justify-content-lg-start justify-content-xl-around justify-content-xxl-around ">
          <div class="text-white text-xs-justify display-6 mt-5 col-md-12 col-lg-12 col-xl-3 col-xxl-3 pb-xl-4"
            style="font-size:20px;text-align:justify">
            <br>
            <br>
            🌟Welcome to "Make a Try" <br> Your Ultimate Glass Destination!🌟
            <br>
            <br>
            Explore a world of style and clarity at our glass store! Discover a stunning collection that transcends
            trends and embraces timeless elegance. From chic eyewear to trendy sunglasses, we have the perfect frames
            for every face.
            <br>
            <br>
            ✨Why Choose "Make a Try"? ✨
            <br>
            <br>
            👓Extensive Collection: Find frames that match your unique style.
            <br>
            <br>
            😎Sunglasses Galore: Shield your eyes in style with our trendy sunglasses.
            <br>
            <br>
            🔍Precision Clarity: Experience crystal-clear vision with our high-quality lenses.
            <br>
            <br>
            🌈Fashion Fusion: Blend fashion with function for the perfect eyewear ensemble.
            <br>
            <br>
            💎Quality Craftsmanship: Impeccable quality that stands the test of time.
          </div>
          <img class="col-10 col-md-10 col-lg-10 h-auto col-xl-8 col-xxl-8" src="../assets/bg/tryOutBgMale.svg" alt=""
            style="object-fit: cover; overflow-x: visible;">
        </div>
      </div>

    </section>
    <!-- carousel -->
    <section class="m-0">
      <div class="test-white h1 font-weight-bold text-center bg-light mb-0 py-3 display-2">CATEGORY</div>
      <div class="">
        <div class="row justify-content-around">

          <div id="carouselExampleControls" class="carousel slide " data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="../assets/carousel/otpical.svg" class="d-block w-100" alt="Fashion">
                <div class="carousel-caption d-none d-md-block text-dark">
                  <h1 class="text-center container pb-4 bg-none">OPTICAL</h1>
                </div>
              </div>
              <div class="carousel-item">
                <img src="../assets/carousel/sunglass.jpg" class="d-block w-100" alt="Sunglass">
                <div class="carousel-caption d-none d-md-block">
                  <h1 class="text-center text-white px-5 py-2">SUN GLASS</h1>
                </div>
              </div>
            </div>
            <ol class="carousel-indicators">
              <li data-bs-target="#carouselExampleControls" data-bs-slide-to="0" class="active"></li>
              <li data-bs-target="#carouselExampleControls" data-bs-slide-to="1"></li>
            </ol>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </a>
          </div>

        </div>
      </div>
    </section>
    <!-- tryout -->
    <section>
      <div class="container-fluid d-flex justify-content-center align-items-center" id="tryout"
        style="height: 768px; background-image: url('../assets/bg/tryOutbg.svg');background-repeat: no-repeat; background-position: center;background-size:cover;">
        <butto class="btn text-white">
          <a href="faceMeasurement.php" class="text-decoration-none display-1 fw-bolder text-white">TRY NOW</a>
          </button>
      </div>
    </section>
    <?php
    include("../components/cartBottom.php")
      ?>
  </main>
  <!-- footer -->
  <?php include("../components/footer.php") ?>
  <?php include("../components/DomFooter.php") ?>
<script>
    $('.carousel').carousel({
      interval: 2000
    })
</script>
</body>

</html>