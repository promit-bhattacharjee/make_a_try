<?php
class InStock{
    private $connect,$productId;
function __construct()
{
    if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['productID'])) {
        include("../connections/database.php");
        $this->connect = $connect;
        $this->productId = $_GET['productID'];
        $this->productId = $this->connect->real_escape_string($_GET['productID']);
        $this->makeStockOut();
    }
    
}
private function makeStockOut()
    {
        $stockOutSql = "UPDATE products SET product_status='active' WHERE product_id = '$this->productId'  LIMIT 1";
        $stockOutResult = mysqli_query($this->connect, $stockOutSql);

        if ($stockOutResult) {
            echo "<script>alert('Product Out of Stock successfully.');</script>";
        } else {
            echo "<script>alert('Product Out of Stock Unsuccessfully.');</script>"; 
    }}
}
new InStock();