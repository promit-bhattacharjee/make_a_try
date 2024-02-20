<?php

class ProductSearch
{
    private $connect;

    public function __construct()
    {
        include("../connections/database.php");
        $this->connect = $connect;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Check and set the product name
            $productName = isset($_POST["productName"]) ? $_POST["productName"] : "";

            // Check and set the product brand
            $productBrand = isset($_POST["productBrand"]) ? $_POST["productBrand"] : "";

            // Check and set the product model
            $productModel = isset($_POST["productModel"]) ? $_POST["productModel"] : "";

            // Check and set the product colour
            $productColour = isset($_POST["productColour"]) ? $_POST["productColour"] : "";

            // Check and set the product gender
            $productGender = isset($_POST["productGender"]) ? $_POST["productGender"] : "";

            // Check and set the min price
            $minPrice = isset($_POST["minPrice"]) ? intval($_POST["minPrice"]) : '';

            // Check and set the max price
            $maxPrice = isset($_POST["maxPrice"]) ? intval($_POST["maxPrice"]) : '';
            $searchResults = $this->searchProducts($productName, $productBrand, $productModel, $productColour, $productGender, $minPrice, $maxPrice);
            $this->displaySearchResults($searchResults);
        }
    }

    private function searchProducts($productName, $productBrand, $productModel, $productColour, $productGender, $minPrice, $maxPrice)
    {
        $productName = $this->sanitizeInput($productName);
        $productBrand = $this->sanitizeInput($productBrand);
        $productModel = $this->sanitizeInput($productModel);
        $productColour = $this->sanitizeInput($productColour);
        $productGender = $this->sanitizeInput($productGender);
    
        $conditions = [];
    
        if (!empty($productName)) {
            $conditions[] = "product_name LIKE '%$productName%'";
        }
    
        if (!empty($productBrand)) {
            $conditions[] = "product_brand LIKE '%$productBrand%'";
        }
    
        if (!empty($productColour)) {
            $conditions[] = "product_colour LIKE '%$productColour%'";
        }
    
        if (!empty($productModel)) {
            $conditions[] = "product_model LIKE '%$productModel%'";
        }
    
        if (!empty($productGender)) {
            $conditions[] = "product_gender LIKE '%$productGender%'";
        }
    
        // Add conditions for other parameters
    
        if (!empty($minPrice) && !empty($maxPrice)) {
            $priceCondition = "product_price BETWEEN $minPrice AND $maxPrice";
        } elseif (!empty($minPrice)) {
            $priceCondition = "product_price >= $minPrice";
        } elseif (!empty($maxPrice)) {
            $priceCondition = "product_price <= $maxPrice";
        } else {
            $priceCondition = ""; // No price conditions selected
        }
    
        if (!empty($priceCondition)) {
            $conditions[] = $priceCondition;
        }
    
        // Combine all conditions using AND
        $conditionsString = implode(' AND ', $conditions);
    
        $query = "SELECT * FROM products";
    
        if (!empty($conditionsString)) {
            $query .= " WHERE $conditionsString";
        }
    
        // After constructing $conditionsString
        // echo "SQL Query: $query <br>";
        // echo "Conditions: $conditionsString <br>";
    
        $result = mysqli_query($this->connect, $query);
    
        if (!$result) {
            die("Error in query: " . mysqli_error($this->connect));
        }
    
        $products = [];
    
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $products[] = $row;
            }
        }
    
        return $products;
    }
    

    private function sanitizeInput($data)
    {
        return mysqli_real_escape_string($this->connect, trim(strtolower($data)));
    }

    private function displaySearchResults($searchResults)
    {
        if (empty($searchResults)) {
            echo "<h2 class='text-center m-5'>No search results found.</h2>";
            return;
        }

        foreach ($searchResults as $row) {
            echo "
                <div class='mt-3 card col-xxl-3 col-md-5 col-xl-3 d-flex justify-content-evenly rounded '>
                    <img src='{$row['product_image']}' class='card-img-top'>
                    <div class='card-body'>
                        <h5 class='card-title d-flex justify-content-evenly'>{$row['product_name']}</h5>
                        <p class='card-text d-flex justify-content-evenly'>{$row['product_description']}</p>
                        <ul class='list-group list-group-flush'>
                            <li class='list-group-item'>
                                <div class='d-flex justify-content-between'>
                                    <span>Price: {$row['product_price']} TK</span>
                                    <span>Category: {$row['product_category']}</span>
                                </div>
                            </li>
                            <li class='list-group-item'>
                                <div class='d-flex justify-content-between'>
                                    <span>Status: {$row['product_status']}</span>
                                    <span>Brand: {$row['product_brand']}</span>
                                </div>
                            </li>
                            <li class='list-group-item'>
                                <div class='d-flex justify-content-between'>
                                    <span>Gender: {$row['product_gender']}</span>
                                    <span>Model: {$row['product_model']}</span>
                                </div>
                            </li>
                            <li class='list-group-item'>
                                <div class='d-flex justify-content-between'>
                                    <span>Colour: {$row['product_colour']}</span>
                                    <!-- Add more data as needed -->
                                </div>
                            </li>
                        </ul>
                        <a href='#' class='btn btn-dark card-link d-flex justify-content-center'>Another link</a>
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
    <?php require_once("../components/navbar.php");?>
    <main>
        <div class="d-flex justify-content-around row">
            <?php
            $productSearch = new ProductSearch();
            ?>
        </div>
    </main>
    <div class="fixed-bottom">
    <?php require_once("../components/footer.php");?>
    </div>

</body>
</html>
