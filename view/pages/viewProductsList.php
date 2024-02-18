<?php
class viewProductsList
{ 
    private $pageIndexValue=0,$numberOfpages;
    private $connect;

    function __construct()
    {
        include '../connections/database.php';
        $this->connect = $connect;
        $this->fetchData();
    }
    private function totalPageCount()
    {
        $query = "SELECT COUNT(*) as total FROM products";
        $result = mysqli_query($this->connect, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $totalDataInDataBase = $row['total'];
            // mysqli_free_result($result);
            return ceil( $totalDataInDataBase/32);
        } else {
            echo "Error: " . mysqli_error($this->connect);
        }
    }
    private function pagination()
    {
        $left=null;
        $center=null;
        $right=null;
         if($this->pageIndexValue===0){
            $left=1;
        $center=2;
        $right=3;
         }else{
            $left=$this->pageIndexValue/32;
            $center=$left+1;
            $right=$center+1;
         }
        echo "<nav aria-label='Page navigation example'>
        <ul class='pagination'>
          <li class='page-item'>
            <a class='page-link' href='#' aria-label='Previous'>
              <span aria-hidden='true'>&laquo;</span>
            </a>
          </li>
          <li class='page-item'><a class='page-link'href='javascript:void(0)' onclick='$this-> '>$left</a></li>
          <li class='page-item'><a class='page-link' href='#'>$center</a></li>
          <li class='page-item'><a class='page-link' href='#'>$right</a></li>
          <li class='page-item'>
            <a class='page-link' href='#' aria-label='Next'>
              <span aria-hidden='true'>&raquo;</span>
            </a>
          </li>
        </ul>
      </nav>
      ";
    }

    private function fetchData()
    {
        $this->numberOfpages = $this->totalPageCount();
        $query = "SELECT `product_id`, `product_name`, `product_price`, `product_category`, `product_description`, `product_status`, `product_width`, `product_image`, `product_height`, `product_brand`, `product_gender`, `product_model`, `product_colour`, `created_at`, `updated_at` FROM `products` WHERE 1 LIMIT 32 OFFSET $this->pageIndexValue";
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
                    <a href='#' class='btn btn-dark card-link d-flex justify-content-center'>Another link</a>
                </div>
            </div>
            ";
        }
        $this->pagination();
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

    <style>
        .card {
            height: 300px;

            position: relative;
            overflow: hidden;
            border: 1px solid #dee2e6;
        }

        .card-img-top {

            flex: 1;
            transition: opacity 0.3s ease-in-out;
        }

        .card-body {
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: white;
            transition: transform 0.3s ease-in-out;
            transform: translateY(100%);
            padding: 10px;
            box-sizing: border-box;
        }

        .card:hover .card-img-top {
            opacity: 0;
        }

        .card:hover .card-body {
            transform: translateY(-100%);
        }
    </style>
</head>

<body>
    <?php include("../components/navbar.php") ?>
    <main>

        <div class=" d-flex justify-content-around row">
            <?php new viewProductsList() ?>
        </div>
        <?php
        // $pagenation = new viewProductsList();
        // $pagenation->pagination(); 
        ?>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>