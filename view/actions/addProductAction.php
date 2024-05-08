<?php
class AddProduct
{
    private $connect,
    $productName,
    $productImage,
    $productCategory,
    $productPrice,
    $productBrand,
    $productWidth,
    $productHeight,
    $productModel,
    $productColour,
    $productGender,
    $productStatus,
    $productDescription,
    $productImagePath;

    function __construct()
    {
        include("../connections/database.php");
        $this->connect = $connect;

        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["productImage"])) {
            $this->retrieveData();
            $this->filterData();
            $this->uploadImage();
            $this->uploadData();
        }
    }

    private function retrieveData()
    {
        $this->productName = $_POST["productName"];
        $this->productCategory = $_POST["productCategory"];
        $this->productPrice = $_POST["productPrice"];
        $this->productImage = $_FILES["productImage"];
        $this->productBrand = $_POST["productBrand"];
        $this->productWidth = $_POST["productWidth"];
        $this->productHeight = $_POST["productHeight"];
        $this->productModel = $_POST["productModel"];
        $this->productColour = $_POST["productColour"];
        $this->productGender = $_POST["productGender"];
        $this->productDescription = $_POST["productDescription"];
        $this->productStatus = "active";
    }

    private function filterData()
    {
        $this->productName = $this->connect->real_escape_string($_POST["productName"]);
        $this->productCategory = $this->connect->real_escape_string($_POST["productCategory"]);
        $this->productPrice = $this->connect->real_escape_string($_POST["productPrice"]);
        $this->productBrand = $this->connect->real_escape_string($_POST["productBrand"]);
        $this->productWidth = $this->connect->real_escape_string($_POST["productWidth"]);
        $this->productHeight = $this->connect->real_escape_string($_POST["productHeight"]);
        $this->productModel = $this->connect->real_escape_string($_POST["productModel"]);
        $this->productColour = $this->connect->real_escape_string($_POST["productColour"]);
        $this->productGender = $this->connect->real_escape_string($_POST["productGender"]);
        $this->productDescription = $this->connect->real_escape_string($_POST["productDescription"]);
    }

    private function uploadImage()
    {
        $fileExtension = pathinfo($this->productImage["name"], PATHINFO_EXTENSION);
        $targetDirectory = "../assets/product_images" . "/" . $this->productName . "_" . $this->productModel . '.' . $fileExtension;

        if (move_uploaded_file($this->productImage["tmp_name"], $targetDirectory)) {
            // echo "<script>alert('Image successfully uploaded.');</script>";

            $this->productImagePath = $targetDirectory;
        } else {
            $this->allertMessage("Photo Upload Error");
        }


    }







    private function uploadData()
    {
        $sql = "INSERT INTO `products` (
            `product_name`,
            `product_price`,
            `product_category`,
            `product_description`,
            `product_status`,
            `product_width`,
            `product_image`,
            `product_height`,
            `product_brand`,
            `product_gender`,
            `product_model`,
            `product_colour`,
            `created_at`,
            `updated_at`
        ) VALUES (
            '$this->productName',
            '$this->productPrice',
            '$this->productCategory',
            '$this->productDescription',
            '$this->productStatus',
            '$this->productWidth',
            '$this->productImagePath',
            '$this->productHeight',
            '$this->productBrand',
            '$this->productGender',
            '$this->productModel',
            '$this->productColour',
            CURRENT_TIMESTAMP(),
            CURRENT_TIMESTAMP()
        );";

        $result = mysqli_query($this->connect, $sql);

        if ($result) {
            $this->allertMessage("product Uploaded Successfully");
        } else {
            $this->allertMessage("Error adding product:" . mysqli_error($this->connect));
        }
    }
    private function allertMessage($message)
    {
        echo "<script>alert('$message');</script>";
        header("Location: ../pages/addProduct.php");
        exit;
    }
}

new AddProduct();
?>