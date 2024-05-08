<?php if (!isset($_SESSION)) {
  session_start();

}
$_SESSION['homePage'] = '';
$_SESSION['productPage']='';
$_SESSION['checkMesurementPage']='';
$_SESSION['aboutUsPage']='';
$_SESSION['contactPage']='';
$_SESSION['userPage']='';

$_SESSION['currentPage'] = basename($_SERVER["PHP_SELF"]);
// echo $_SESSION['currentPage'];
if ($_SESSION['currentPage'] === "home.php") {
  $_SESSION['homePage'] = "rounded btn  btn-light text-dark";
}
elseif ($_SESSION['currentPage'] === "viewProductsList.php") {
  $_SESSION['productPage'] = "rounded btn btn-light  text-dark";
}
elseif ($_SESSION['currentPage'] === "faceMeasurement.php") {
  $_SESSION['checkMesurementPage'] = "rounded btn btn-light text-dark";
}
elseif ($_SESSION['currentPage'] === "aboutUs.php") {
  $_SESSION['aboutUsPage'] = " rounded btn btn-light text-dark";
}
elseif ($_SESSION['currentPage'] === "contact.php") {
  $_SESSION['contactPage'] = "rounded btn btn-light text-dark";
}
elseif ($_SESSION['currentPage'] === "userDashBoard.php") {
  $_SESSION['userPage'] = " rounded btn btn-light text-dark";
}
?>
<header class="SecondaryBgClr">
  <nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgba(34, 23, 99);">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03"
        aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mr-auto d-flex justify-content-around align-items-center container-fluid">
          <li class="nav-item">
            <a class="nav-link" href="#"><img class="rounded" src="/assets/icons/siteIcon.svg" alt=""></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link text-light<?php echo $_SESSION['homePage'] ?>"
              href="../pages/home.php">Home</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light <?php echo $_SESSION['productPage'] ?>"
              href="../pages/viewProductsList.php">Product</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link text-light <?php echo $_SESSION['checkMesurementPage'] ?>"
              href="../pages/faceMeasurement.php">Check Measurements</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light <?php echo $_SESSION['aboutUsPage'] ?>" href="../pages/aboutUs.php">About
              Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light <?php echo $_SESSION['contactPage'] ?>"
              href="../pages/contact.php">Contact</a>
          </li>
          <li class="nav-item">

            <div class="btn-group">
              <button type="button" class="btn dropdown-toggle d-flex justify-content-center align-items-center "
                data-bs-toggle="dropdown" aria-expanded="false">
                <img src="assets/icons/profileIcon.svg" class="" alt=""><a class="text-light nav-link <?php echo $_SESSION['userPage'] ?>"
                  href="#">User</a>
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="../pages/userDashBoard.php">Profile <i class="fa-solid fa-user"></i>
                  </a></li>
          </li>

          <?php
          if (isset($_SESSION['user_mobile']) && isset($_SESSION['user_id'])) {
            echo "<hr class='dropdown-divider'>";
            echo "<li><a class='dropdown-item' href='../connections/sessionDistroy.php'>Logout<i class='fa-sharp fa-solid fa-right-from-bracket'></i></a></li>
              ";
          }
          ?>
          <hr class="dropdown-divider">
          <li><a class="dropdown-item" href="../pages/cart.php">Cart <i class="fa-solid fa-cart-shopping"></i></a>
          </li>
        </ul>
      </div>
      </li>
      </ul>
    </div>
  </nav>
</header>