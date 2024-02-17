<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>adminDashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="color.css">
    <style>
        .card-hover:hover {
            border: 10px solid ghostwhite !important;
        }
    </style>
</head>

<body>
    <header class="primaryBgClr">

    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgba(34, 23, 99,0.75);">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03"
          aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
          <ul class="navbar-nav mr-auto d-flex justify-content-around align-items-center container-fluid">
            <li class="nav-item">
              <a class="nav-link" href="#"><img src="assets/icons/siteIcon.svg" alt=""></a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="home.html">Home</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link text-light" href="#" style="font-size: 24px;">Product <span class="sr-only"></span></a>
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
            <hr class="dropdown-divider">
            <li><a class="dropdown-item" href="sessionDistroy.php">Logout <i class="fa-sharp fa-solid fa-right-from-bracket"></i></a>
            </li>
          </ul>
        </div>
        </li>
        </ul>
      </div>
    </nav>

    </header>
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <?php
                include 'database.php';
                $query="SELECT * FROM `product` WHERE 1";
                $allData=mysqli_query($connect,$query);
                while($row = mysqli_fetch_array($allData)){
                echo "<div class='card col-xxl-4 col-md-5 col-xl-4 border-0 card-hover'>
                <img style='height: 300px; object-fit: cover;' src='$row[productImg]' alt=''>
                <div class='mt-3 align-self-lg-center text-center rounded-circle' style='width: 20px; height: 20px; background-color: $row[color];'></div>
                <div class='card-body container text-center'>
                    <div class='continer d-flex justify-content-around'>
                        <div class='h6'>$row[name]</div>
                        <div class='h6'>Price: $row[price] TK</div>
                    </div>
                    <div class='h6'>$row[brand]</div>
                </div>
            </div>
            ";
                }
                ?>
            </div>
        </div>
    </main>
    <footer class="SecondaryBgClr container-fluid mt-5 py-5">
    <!-- <div class="container" style="height: 30px;"></div> -->
    <div
      class="row justify-content-xxl-around justify-content-lg-around justify-content-md-around justify-content-around">
      <div class="col-xxl-4 col-lg-5 col-md-5 col-10 d-flex justify-content-center d-md-block">
        <img class="mb-5" src="assets/icons/siteIcon.svg" alt="">
        <p style="font-size: 18;" class="text-dark">The 100% Money Back Guarantee cleaning
          company specialised in high quality cleaning.</p>
      </div>
      <div class="col-xxl-2 col-lg-5 col-md-5  col-5">
        <p style="font-size: 18;" class="text-dark"><b>Navigation</b> </p>
        <p style="font-size: 18;" class="text-dark">Help </p>
        <p style="font-size: 18;" class="text-dark">Blog </p>
        <p style="font-size: 18;" class="text-dark">Contact us </p>
        <p style="font-size: 18;" class="text-dark">Request Quote </p>
        <p style="font-size: 18;" class="text-dark">Login </p>
      </div>
      <div class="col-xxl-2 col-lg-5 col-md-5  col-5">
        <p style="font-size: 18;" class="text-dark"><b>Support</b> </p>
        <p style="font-size: 18;" class="text-dark">Terms & Conditions </p>
        <p style="font-size: 18;" class="text-dark">Privacy Policy </p>
      </div>
      <div class="col-xxl-2 col-lg-5 col-md-5  col-5">
        <p style="font-size: 18;" class="text-dark"><b>Follow us</b> </p>
        <i class="fa-brands fa-facebook bg-white" style="width: 32px;height: 32px;"></i>
        <i class="fa-brands fa-instagram bg-white" style="width: 32px;height: 32px;"></i>
      </div>
    </div>
    <div class="row text-center">
      <hr class="primaryBgClr w-100">
      <span>
        <i class="fa-regular fa-copyright"></i>
        2023 Make_A_Try || All Rights Reserved
      </span>
    </div>
  </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script>
        let imgInput = document.getElementById('userImage');
        document.getElementById('imageBtn').addEventListener('click', () => {
            imgInput.click();
        });
        let preview = document.getElementById('imagePreview');
        imgInput.addEventListener('change', () => {
            if (imgInput.files && imgInput.files[0]) {
                preview.src = URL.createObjectURL(imgInput.files[0]);
                preview.style.display = 'inline-block';
            }
        });
    </script>
</body>

</html>