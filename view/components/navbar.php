<header class="SecondaryBgClr">
  <nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgba(34, 23, 99,0.75);">
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
            <a class="nav-link text-light" href="#" style="font-size: 24px;">Home <span class="sr-only"></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="/view/pages/viewProduct.php">Product</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link text-light" href="#">Service</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="#">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="#">Contact</a>
          </li>
          <li class="nav-item">
            <!-- Example single danger button -->
            <div class="btn-group">
              <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="assets/icons/profileIcon.svg" alt="">
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="editProfile.php">Profile <i class="fa-solid fa-user"></i>
                  </a></li>
          </li>
          
            <?php
            if(isset($_SESSION['user_email']) && isset($_SESSION['user_id'])){
              echo "<hr class='dropdown-divider'>";
              echo "<li><a class='dropdown-item' href='/makeATry/view/connections/sessionDistroy.php'>Logout<i class='fa-sharp fa-solid fa-right-from-bracket'></i></a></li>
              ";
             }
            ?>
          <hr class="dropdown-divider">
          <li><a class="dropdown-item" href="#">Cart <i class="fa-solid fa-cart-shopping"></i></a>
          </li>
        </ul>
      </div>
      </li>
      </ul>
    </div>
  </nav>
</header>