<?php

class DeleteProduct {
    private $connect, $productId;

    function __construct() {
        if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['productID'])) {
            include("../connections/database.php");
            $this->connect = $connect;
            $this->productId = $_GET['productID'];
            $this->productId = $this->connect->real_escape_string($_GET['productID']);
            $this->deleteFromSQL();
        }
    }

    private function deleteFromSQL() {
        $sql = "SELECT * FROM products WHERE product_id='$this->productId' LIMIT 1";
        $result = mysqli_query($this->connect, $sql);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $imgPath = $row['product_image'];

            $deleteSql = "DELETE FROM products WHERE product_id = '$this->productId' LIMIT 1";
            $deleteResult = mysqli_query($this->connect, $deleteSql);

            if ($deleteResult) {
                $this->removeImage($imgPath);
                echo "<script>alert('Product deleted successfully.');</script>";
            } else {
                echo "<script>alert('Error deleting product data: " . mysqli_error($this->connect) . "');</script>";
            }
        } else {
            echo "<script>alert('Error retrieving product data: " . mysqli_error($this->connect) . "');</script>";
        }
    }

    private function removeImage($imgPath) {
        if (file_exists($imgPath)) {
            if (unlink($imgPath)) {
                echo "<script>alert('Image removed successfully.');</script>";
            } else {
                echo "<script>alert('Error removing image.');</script>";
            }
        } else {
            echo "<script>alert('Image file does not exist.');</script>";
        }
    }
}

// Example usage:
new DeleteProduct();
?>
