<?php 
session_start();

if(isset($_SESSION['admin'])){

}
else{
  header("Location: home.html");
    exit();
}
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>adminDashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="color.css">
</head>

<body>
  <header>
    <nav class="navbar navbar-light bg-light fixed-top text-white">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar"
          aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand m-auto" href="#">Make A try</a>
        <div class="offcanvas offcanvas-start bg-dark text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
          aria-labelledby="offcanvasDarkNavbarLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Activities</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
              aria-label="Close"></button>
          </div>
          <div class="offcanvas-body bg-white">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="adminDashboard.php">DashBoard</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="addProduct.html">Add Product</a>
              </li>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Buyer Request</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">User Cart Product</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Out of Stock Products</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Users</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">View Sales Report</a>
              </li>
              <hr class="dropdown-divider bg-dark">
              <li><a class="dropdown-item" href="sessionDistroy.php">Logout <i class="fa-sharp fa-solid fa-right-from-bracket"></i></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </header>
  <main>
    <div class='container mt-5'>
      <?php include 'products.php' ?>
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>

</html>