<?php
session_start();

class OrderProcessor
{
    private $connect;

    function __construct()
    {
        include("../connections/database.php");
        $this->connect = $connect;
    }

    public function updateOrderStatus($orderId, $action)
    {
        switch ($action) {
            case 'accept':
                $status = 'accepted';
                break;
            case 'cancel':
                $status = 'cancelled';
                break;
            case 'deliver':
                $status = 'delivered';
                break;
            default:
                return false;
        }
        $updateSql = "UPDATE `orders` SET `status` = ? WHERE `order_id` = ?";
        $stmt = mysqli_prepare($this->connect, $updateSql);
        mysqli_stmt_bind_param($stmt, 'si', $status, $orderId);
        $updateResult = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        return $updateResult;
    }

    public function deleteProduct($orderId)
    {
        $deleteSql = "DELETE FROM `orders` WHERE `order_id` = ?";
        $stmt = mysqli_prepare($this->connect, $deleteSql);
        mysqli_stmt_bind_param($stmt, 'i', $orderId);
        $deleteResult = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        return $deleteResult;
    }
}

class OrderManager
{
    private $connect;

    public function __construct($connection)
    {
        $this->connect = $connection;
    }

    public function fetchOrders()
    {
        $userId = $_SESSION['user_id'];
        $sql = "SELECT * FROM `orders` WHERE user_id = ? ORDER BY FIELD(`status`, 'pending', 'accepted', 'delivered')";
        $stmt = mysqli_prepare($this->connect, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $userId);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        $orders = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $orders[] = $row;
        }

        mysqli_stmt_close($stmt);

        return $orders;
    }

    public function displayOrders($orders)
    {
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Order Management</title>
            <!-- Include Bootstrap CSS -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        </head>

        <body>
            <?php include("../components/navbar.php"); ?>
            <div class="container" style="height:100px"></div>
            <div class="container mt-4">
                <h2 class="mb-4 ">Order Management</h2>

                <table class="table table-bordered text-center table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Count</th>
                            <th>User Name</th>
                            <th>User Mobile</th>
                            <th>User Address</th>
                            <th>Order Time</th>
                            <th>Product Details</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $index => $order) { ?>
                            <tr>
                                <td class="align-middle">
                                    <?php echo $index + 1 ?>
                                </td>
                                <td class="align-middle">
                                    <?php echo $order['user_name']; ?>
                                </td>
                                <td class="align-middle">
                                    <?php echo $order['user_mobile']; ?>
                                </td>
                                <td class="align-middle">
                                    <?php echo $order['user_address']; ?>
                                </td>
                                <td class="align-middle">
                                    <?php echo $order['order_time']; ?>
                                </td>
                                <td class="align-middle">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop<?php echo $index; ?>">
                                        See product Details
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="staticBackdrop<?php echo $index; ?>" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Product Detils</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    $productAry = explode(",", $order["product_details"]);
                                                    foreach ($productAry as $str) {
                                                        $outputString = str_replace('["{', '', $str);
                                                        $outputString2 = str_replace('product_name', "<hr><h6>Product Name", $outputString);
                                                        $outputString3 = str_replace('"', "", $outputString2);
                                                        $outputString4 = str_replace(':', " :- ", $outputString3);
                                                        $outputString5 = str_replace('{', "", $outputString4);
                                                        $outputString6 = str_replace('}]', "<br>", $outputString5);
                                                        $outputString7 = str_replace('}', "<br>", $outputString6);
                                                        $outputString8 = str_replace('product_id', "<br>Product ID", $outputString7);
                                                        $outputString9 = str_replace('product_model', "<br>Product Model", $outputString8);
                                                        $outputString10 = str_replace('product_price', "<br>Product Price", $outputString9);
                                                        $outputString11 = str_replace('product_quantity', "<br>Product Quantity", $outputString10);
                                                        echo $outputString11;
                                                    }
                                                    ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <?php echo $order['status']; ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <!-- Include Bootstrap JS and jQuery -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
                crossorigin="anonymous"></script>
        </body>
        </html>
        <?php
    }
}

include("../connections/database.php");

$orderProcessor = new OrderProcessor();
$orderManager = new OrderManager($connect);
$orders = $orderManager->fetchOrders();
$orderManager->displayOrders($orders);
?>
