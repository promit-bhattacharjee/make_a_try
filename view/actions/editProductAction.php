<?php
class ProductAction
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
        $productDescription,
        $productImagePath,
        $productId,
        $imageUpdateStatus;

    function __construct()
    {
        include("../connections/database.php");
        $this->connect = $connect;

        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["productId"]) && isset($_POST["submit"])) {
            $this->retrieveData();
            $this->filterData();

            if (isset($this->imageUpdateStatus) && $this->imageUpdateStatus === 'true') {
                $this->uploadImage();
            } else {
                // If image is not updated, keep the existing path
                $this->productImagePath = $_POST["productImage"];
            }

            $this->updateData();
        }
    }

    private function retrieveData()
    {
        $this->productId = $_POST["productId"];
        $this->productName = $_POST["productName"];
        $this->productCategory = $_POST["productCategory"];
        $this->productPrice = $_POST["productPrice"];
        $this->productBrand = $_POST["productBrand"];
        $this->productWidth = $_POST["productWidth"];
        $this->productHeight = $_POST["productHeight"];
        $this->productModel = $_POST["productModel"];
        $this->productColour = $_POST["productColour"];
        $this->productGender = $_POST["productGender"];
        $this->productDescription = $_POST["productDescription"];
        $this->imageUpdateStatus = $_POST["imageUpdateStatus"];
    }

    private function filterData()
    {
        $this->productId = $this->connect->real_escape_string($_POST["productId"]);
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
        $this->imageUpdateStatus = $this->connect->real_escape_string($_POST["imageUpdateStatus"]);
    }

    private function uploadImage()
    {
        // Update the productImage property to the new file
        $this->productImage = $_FILES["productImage"];

        $fileExtension = pathinfo($this->productImage["name"], PATHINFO_EXTENSION);
        $targetDirectory = "../assets/product_images" . "/" . $this->productName . "_" . $this->productModel . '.' . $fileExtension;

        if (move_uploaded_file($this->productImage["tmp_name"], $targetDirectory)) {
            $this->productImagePath = $targetDirectory;
        } else {
            $this->alertMessage("Photo Upload Error");
        }
    }

    private function updateData()
    {
        $sql = "UPDATE `products` SET
                `product_name`='$this->productName',
                `product_price`='$this->productPrice',
                `product_category`='$this->productCategory',
                `product_description`='$this->productDescription',
                `product_width`='$this->productWidth',
                `product_image`='$this->productImagePath',
                `product_height`='$this->productHeight',
                `product_brand`='$this->productBrand',
                `product_gender`='$this->productGender',
                `product_model`='$this->productModel',
                `product_colour`='$this->productColour',
                `updated_at`=CURRENT_TIMESTAMP()
                WHERE `product_id`=$this->productId";

        $result = mysqli_query($this->connect, $sql);

        if ($result) {
            $this->alertMessage("Product Updated Successfully");
        } else {
            $this->alertMessage("Error updating product: " . mysqli_error($this->connect));
        }
    }

    private function alertMessage($message)
    {
        echo "<script>alert('$message');</script>";
        exit;
    }
}

new ProductAction();
?>
