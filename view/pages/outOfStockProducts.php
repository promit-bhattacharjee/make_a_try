<?php 
class productsList{
    private $connect;
     function __construct() {
        include '../connections/database.php';
        $this->connect=$connect;
        $this->fetchData();

        
    }
    private function fetchData(){
        $query = "SELECT * FROM `products` where product_status='outofstock'";
        $allData = mysqli_query($this->connect, $query);
        while ($row = mysqli_fetch_array($allData)) {
            echo "
            <div class='card col-xxl-4 col-md-5 col-xl-4 border-0 card-hover'>
            <img style='height: 300px; object-fit: cover;' src='$row[product_image]' alt=''>
            <div class='mt-3 align-self-lg-center text-center rounded-circle' style='width: 20px; height: 20px; background-color: $row[product_colour];'></div>
            <div class='card-body container text-center'>
            <div class='continer d-flex justify-content-around'>
                <div class='h6'>$row[product_name]</div>
                <div class='h6'>Price: $row[product_price] TK</div>
                <div class='h6'>status: $row[product_status]</div>
            </div>
            <div class='h6'>$row[product_brand]</div>
            <div class='d-flex justify-content-between'>
            <a class='btn bg-success' href='editProduct.php? productID=$row[product_id]'>Edit Product</a>
            <a class='btn bg-danger' href='../actions/deleteProductAction.php? productID=$row[product_id]'>Delete Product</a> 
            <a class='btn bg-dark text-white' href='../actions/inStockAction.php? productID=$row[product_id]'>In Stock</a></div>
        </div>
        
    </div>
    ";
        }
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
    <link rel="stylesheet" href="color.css">
    <style>
        .card-hover:hover{
            border: 10px solid ghostwhite !important;
        }
    </style>
</head>

<body>
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <?php
                require_once("../components/adminSidebar.php")
                ?>    
                <div class="container" style=" height:100px ;width:100%" ></div>
                <?php
                    new productsList();
                ?>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>