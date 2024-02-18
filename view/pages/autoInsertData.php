<?php

include("../connections/database.php");
// Create connection
// // $connect = new mysqli($servername, $username, $password, $dbname);

// // Check connection
// if ($connect->connect_error) {
//     die("Connection failed: " . $connect->connect_error);
// }

// Generate and execute SQL INSERT statements
for ($i = 1; $i <= 500; $i++) {
    $productName = "Product $i";
    $productPrice = rand(10, 100);
    $productCategory = "Category $i";
    $productDescription = "Description $i";
    $productStatus = "Active";  // Set status to "Active"
    $productWidth = rand(5, 20);
    $productHeight = rand(5, 20);
    $productBrand = "Brand $i";
    $productGender = "Gender $i";
    $productModel = "Model $i";
    $productColour = "Colour $i";
    $productImage = "../assets/product_images/vima_v15.jpg";
    // Add more fields as needed

    $sql = "INSERT INTO `products` (
        `product_name`, 
        `product_price`, 
        `product_category`, 
        `product_description`, 
        `product_status`, 
        `product_width`, 
        `product_height`, 
        `product_brand`, 
        `product_gender`, 
        `product_model`, 
        `product_colour`, 
        `product_image`
    ) VALUES (
        '$productName', 
        '$productPrice', 
        '$productCategory', 
        '$productDescription', 
        '$productStatus', 
        '$productWidth', 
        '$productHeight', 
        '$productBrand', 
        '$productGender', 
        '$productModel', 
        '$productColour', 
        '$productImage'
    )";

    if ($connect->query($sql) === TRUE) {
        echo "Record $i inserted successfully<br>";
    } else {
        echo "Error inserting record: " . $connect->error . "<br>";
    }
}

$connect->close();

?>
