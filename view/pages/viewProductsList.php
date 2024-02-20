<?php

use GuzzleHttp\Psr7\Header;

class viewProductsList
{ 
    private $pageIndexValue, $numberOfpages;
    private $connect;

    function __construct()
    {
        include '../connections/database.php';
        $this->connect = $connect;
        $this->pageIndexValue = isset($_GET['page']) ? ($_GET['page'] - 1) * 32 : 0;
        $this->fetchData();
        $this->pagination();
    }
    private function fetchData()
    {
        $query = "SELECT * FROM `products` WHERE product_status='active' LIMIT 32 OFFSET $this->pageIndexValue";
        $allData = mysqli_query($this->connect, $query);

        while ($row = mysqli_fetch_array($allData)) {
            echo
            "
            <div class='mt-3 card col-xxl-3 col-md-5 col-xl-3 d-flex justify-content-evenly rounded '>
                <img src='$row[product_image]' class='card-img-top'>
                <div class='card-body'>
                    <h5 class='card-title d-flex justify-content-evenly'>$row[product_name]</h5>
                    <p class='card-text d-flex justify-content-evenly'>$row[product_description]</p>
                    <ul class='list-group list-group-flush'>
                        <li class='list-group-item'>
                            <div class='d-flex justify-content-between'>
                                <span>Price: $row[product_price] TK</span>
                                <span>Category: $row[product_category]</span>
                            </div>
                        </li>
                        <li class='list-group-item'>
                            <div class='d-flex justify-content-between'>
                                <span>Status: $row[product_status]</span>
                                <span>Brand: $row[product_brand]</span>
                            </div>
                        </li>
                        <li class='list-group-item'>
                            <div class='d-flex justify-content-between'>
                                <span>Gender: $row[product_gender]</span>
                                <span>Model: $row[product_model]</span>
                            </div>
                        </li>
                        <li class='list-group-item'>
                            <div class='d-flex justify-content-between'>
                                <span>Colour: $row[product_colour]</span>
                                <!-- Add more data as needed -->
                            </div>
                        </li>
                    </ul>
                    <a href='"."http://localhost/makeATry/view/actions/addToCartAction.php? productId=$row[product_id]' class='btn btn-dark card-link d-flex justify-content-center'>Add To Cart</a>
                    </div>
            </div>
            ";
        }
    }

    private function totalPageCount()
    {
        $query = "SELECT COUNT(*) as total FROM products";
        $result = mysqli_query($this->connect, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $totalDataInDataBase = $row['total'];
            return ceil($totalDataInDataBase / 32);
        } else {
            echo "Error: " . mysqli_error($this->connect);
        }
    }

    private function pagination()
    {
        $this->numberOfpages = $this->totalPageCount();
        echo "<div class='d-flex justify-content-center overflow-scroll mt-4'>
                <nav aria-label='Page navigation example'>
                    <div class='pagination-container' style='max-height: 200px; overflow-y: auto;'>
                        <ul class='pagination'>";
    
        if ($this->pageIndexValue > 0) {
            $prevPage = $this->pageIndexValue / 32;
            echo "<li class='page-item'>
                    <a class='page-link' href='?page=$prevPage' aria-label='Previous'>
                        <span aria-hidden='true'>&laquo;</span>
                    </a>
                </li>";
        }
    
        for ($i = 1; $i <= $this->numberOfpages; $i++) {
            $currentPage = $i;
            echo "<li class='page-item" . ($currentPage == ($this->pageIndexValue / 32 + 1) ? " active" : "") . "'>";
            if ($currentPage == ($this->pageIndexValue / 32 + 1)) {
                echo "<span class='page-link' style='color: red; cursor: default;'>$i</span>";
            } else {
                echo "<a class='page-link' href='?page=$currentPage'>$i</a>";
            }
            echo "</li>";
        }
    
        if ($this->pageIndexValue < ($this->numberOfpages - 1) * 32) {
            $nextPage = $this->pageIndexValue / 32 + 2;
            echo "<li class='page-item'>
                    <a class='page-link' href='?page=$nextPage' aria-label='Next'>
                        <span aria-hidden='true'>&raquo;</span>
                    </a>
                </li>";
        }
    
        echo "</ul></div></nav></div>";
    }
    
    
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
    <link rel="stylesheet" href="../connections/color.css"> 
    <link rel="stylesheet" href="../connections/productView.css">
</head>

<body>

    <?php include("../components/navbar.php");
    
    ?>
    <div class="container">
        <?php include("productSearch.php");?>
    </div>
    <!-- <div class="container" style="height:300px"></div> -->
    <main>
        <div class="d-flex justify-content-around row">
            <?php new viewProductsList() ?>
        </div>
        <?php 
        include("../components/cartBottom.php");
        include("../components/footer.php"); ?>

    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>
