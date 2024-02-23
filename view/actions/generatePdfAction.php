<?php

session_start();
class OrderProcessor
{
    private $connect;
    private $orderId;
    private $userName;
    private $userId;
    private $userEmail;
    private $userMobile;
    private $userAddress;
    private $userPaymentId;
    private $orderTime;
    private $productDetails = [];
    private $totalAmount;
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
        for ($i = 0; $i <= count($result) - 3; $i++) {
            $this->productDetails[$i] = json_encode($result[$i]);
        }
        // for($i=0;$i<=count($result)-3;$i++) {
        //     // $this->productDetails[$i]=json_encode($result[$i]);
        //     echo $this->productDetails[$i];
        // }

        $userDetails = $result[count($result) - 2];
        $this->userName = $userDetails['user_name'];
        $this->userId = $_SESSION['user_id'];
        $this->userMobile = $userDetails['user_mobile'];
        $this->userPaymentId = $userDetails['user_payment_id'];
        $this->userAddress = $userDetails['user_address'];
        // 

        $totalAmountAry = $result[count($result) - 1];
        $this->totalAmount = $totalAmountAry["total_amount"];
        $jsonProductData = json_encode($this->productDetails);
        $sql = "INSERT INTO `orders` (user_name, user_id, user_email, user_mobile, user_address, user_payment_id, order_time, product_details, total_amount, status) VALUES ('$this->userName', '$this->userId', '$this->userEmail', '$this->userMobile', '$this->userAddress', '$$this->userPaymentId', CURRENT_TIMESTAMP, '$jsonProductData', $this->totalAmount, 'pending')";
        $queryResult = mysqli_query($this->connect, $sql);
        if ($queryResult) {
            return $this->userId;
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


    // public function displayProcessedData($result) {
    //     echo "<pre>";
    //     print_r($result);
    //     echo "</pre>";
    // }
    public function generatePdf()
    {
        $pdf = new TCPDF();
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

        $pdf->AddPage();
        $pdf->SetFont('times', '', 12);

        // Add order details to the PDF
        $pdf->Cell(0, 10, 'Order ID: ' . $this->orderId, 0, 1);
        $pdf->Cell(0, 10, 'User Name: ' . $this->userName, 0, 1);
        $pdf->Cell(0, 10, 'User ID: ' . $this->userId, 0, 1);
        $pdf->Cell(0, 10, 'User Email: ' . $this->userEmail, 0, 1);
        $pdf->Cell(0, 10, 'User Mobile: ' . $this->userMobile, 0, 1);
        $pdf->Cell(0, 10, 'User Address: ' . $this->userAddress, 0, 1);
        $pdf->Cell(0, 10, 'User Payment ID: ' . $this->userPaymentId, 0, 1);
        $pdf->Cell(0, 10, 'Order Time: ' . $this->orderTime, 0, 1);

        // Add product details to the PDF
        // $productDetails = json_decode($this->productDetails);
        foreach ($this->productDetails as $detail) {
            $pdf->Cell(0, 10, 'Product Name: ' . $detail['product_name'], 0, 1);
            $pdf->Cell(0, 10, 'Product ID: ' . $detail['product_id'], 0, 1);
            $pdf->Cell(0, 10, 'Product Model: ' . $detail['product_model'], 0, 1);
            $pdf->Cell(0, 10, 'Product Price: ' . $detail['product_price'], 0, 1);
            $pdf->Cell(0, 10, 'Product Quantity: ' . $detail['product_quantity'], 0, 1);
        }

        // Add total amount to the PDF
        $pdf->Cell(0, 10, 'Total Amount: ' . $this->totalAmount, 0, 1);

        // Output the PDF
        $pdf->Output('output.pdf', 'D');
    }

}
$orderProcessor = new OrderProcessor();
$jsonData = $_GET['jsonData'];
$id = $orderProcessor->insertOrdersIntoDatabase($jsonData);
if ($id) {
    $result = $orderProcessor->deleteCartFromDatabase($id);
    if ($result) {
        header("location:../pages/home.php");
    }
}
