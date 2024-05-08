<?php include("../components/userLoginChecker.php") ?>
<?php
 session_start();
class AddToCart
{
    private $productId, $connect, $userId;

    public function __construct()
    {
        include("../connections/database.php");
        $this->connect = $connect;
       

        // Use isset to check if productId is set in $_GET
        $this->productId = isset($_GET["productId"]) ? $_GET["productId"] : null;
        $this->userId = $_SESSION['user_id'];

        if ($this->productId && $this->userId) {
            $this->addItems();
        } else {
            echo "Invalid request.";
        }
    }

    private function checkDataExist()
    {
        $productId = (int) $this->productId; // Make sure to cast to int to prevent SQL injection
        $sql = "SELECT * FROM carts WHERE product_id = $productId AND user_id = $this->userId";
        $results = mysqli_query($this->connect, $sql);

        // Check if the query was successful and if there are rows returned
        return $results && mysqli_num_rows($results) > 0;
    }

    private function fetchProductData()
    {
        $productId = (int) $this->productId; // Make sure to cast to int to prevent SQL injection
        $product_query = "SELECT * FROM products WHERE product_id = $productId";
        $product_result = mysqli_query($this->connect, $product_query);

        // Check if the query was successful and if there are rows returned
        return $product_result && mysqli_num_rows($product_result) > 0;
    }

    private function addItems()
    {
        $dataAlreadyExist = $this->checkDataExist();
    
        if (!$dataAlreadyExist) {
            $productDataExists = $this->fetchProductData();
            if ($productDataExists) {
                $insertQuery = "INSERT INTO `carts` (`user_id`, `product_id`, `product_quantity`) VALUES ('$this->userId', '$this->productId', 1)";
                $insertResult = mysqli_query($this->connect, $insertQuery);
    
                
    
                if ($insertResult) {
                    echo "<script>
                    window.alert('Product added to the cart successfully.');
                    window.location.href = '../pages/viewProductsList.php';
                  </script>";
                } else {
                    echo "<script>
                            alert('Error adding the product to the cart: " . mysqli_error($this->connect) . "');
                            window.location.href = '../pages/viewProductsList.php';
                          </script>";
                }
            } else {
                echo "<script>
                        alert('Product not found.');
                        window.location.href = '../pages/viewProductsList.php';
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Product already exists in the cart.');
                    window.location.href = '../pages/viewProductsList.php';
                  </script>";
        }
    }
    
}

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["productId"]) && isset($_SESSION['user_id'])) {
    new AddToCart();
} else {
    echo "Login First";
}
?>
