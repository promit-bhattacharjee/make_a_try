<?php

session_start();

class OrderProcessor
{
    private $connect = '';
    private $orderId = '';
    private $userName = '';
    private $userId = '';
    private $userEmail = '';
    private $userMobile = '';
    private $userAddress = '';
    private $userPaymentId = '';
    private $orderTime = '';
    private $productDetails = [];
    private $totalAmount = '';

    public function __construct()
    {
        require("../connections/database.php");
        $this->connect = $connect;
        require("../tcpdf/tcpdf/tcpdf.php");
    }

    public function processJsonData($jsonData)
    {
        $result = [];

        foreach ($jsonData as $item) {
            $tempResult = [];

            if (isset($item['product_details'])) {
                $productDetails = $item['product_details'];
                $tempResult = [
                    'product_name' => $productDetails['product_name'],
                    'product_id' => $productDetails['product_id'],
                    'product_model' => $productDetails['product_model'],
                    'product_price' => $productDetails['product_price'],
                    'product_quantity' => $productDetails['product_quantity'],
                ];
            } elseif (isset($item['user_details'])) {
                $userDetails = json_decode($item['user_details'], true)[0];
                $tempResult['user_name'] = $userDetails['user_name'];
                $tempResult['user_id'] = $userDetails['user_id'];
                $tempResult['user_mobile'] = $userDetails['user_mobile'];
                $tempResult['user_payment_id'] = $userDetails['user_payment_id'];
                $tempResult['user_address'] = $userDetails['user_address'];
            } elseif (isset($item['total_amount'])) {
                $tempResult['total_amount'] = $item['total_amount'];
            }

            $result[] = $tempResult;
        }

        return $result;
    }

    public function insertOrdersIntoDatabase($jsonData)
    {
        $data = json_decode($jsonData, true);
        $result = $this->processJsonData($data);

        // Process product details
        for ($i = 0; $i < count($result) - 2; $i++) {
            $this->productDetails[] = json_encode($result[$i]);
        }

        // Process user details
        $userDetails = $result[count($result) - 2];
        $this->userName = $userDetails['user_name'];
        $this->userId = $_SESSION['user_id'];
        $this->userMobile = $userDetails['user_mobile'];
        $this->userPaymentId = $userDetails['user_payment_id'];
        $this->userAddress = $userDetails['user_address'];

        // Process total amount
        $totalAmountDetails = $result[count($result) - 1];
        $this->totalAmount = $totalAmountDetails["total_amount"];

        // Insert data into the orders table
        $jsonProductData = json_encode($this->productDetails);
        $sql = "INSERT INTO `orders` (user_name, user_id, user_mobile, user_address, user_payment_id, order_time, product_details, total_amount, status) VALUES ('$this->userName', '$this->userId', '$this->userMobile', '$this->userAddress', '$this->userPaymentId', CURRENT_TIMESTAMP, '$jsonProductData', $this->totalAmount, 'pending')";

        $queryResult = mysqli_query($this->connect, $sql);

        if ($queryResult) {

            return $_SESSION['user_id'];
        } else {
            // Add an error message or log the error
            $errorMessage = mysqli_error($this->connect);
            echo "Error inserting data: $errorMessage";
        }
    }

    public function deleteCartFromDatabase($id)
    {
        $sql = "DELETE FROM `carts` WHERE user_id=$id";
        $queryResult = mysqli_query($this->connect, $sql);

        return $queryResult;
    }

    public function generatePdf()
    {
        // Your PDF generation code here
    }
}

$orderProcessor = new OrderProcessor();
$jsonData = $_GET['jsonData'];
    $data2=json_decode($jsonData,true);
if (isset($_GET['jsonData']) && count(array_keys($data2))>2) {
    $id = $orderProcessor->insertOrdersIntoDatabase($jsonData);

    if ($id) {
        $result = $orderProcessor->deleteCartFromDatabase($id);

        if ($result) {
            echo "<script>
            alert('Order Placed')
            window.location.href = '../pages/home.php';</script>";
            exit(); // Add exit after header to prevent further execution
        }
    }
}
else{
    echo "<script>
    alert('Place select an item')
    window.location.href = '../pages/cart.php';</script>";
    exit;
}
$jsonData = ""; // Reset jsonData after processing

?>
