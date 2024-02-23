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
        $updateSql = "UPDATE `orders` SET `status` = '$status' WHERE `order_id` = '$orderId'";
        $updateResult = mysqli_query($this->connect, $updateSql);

        return $updateResult;
    }


    public function deleteProduct($orderId)
    {
        $deleteSql = "DELETE FROM `orders` WHERE `order_id` = '$orderId'";
        $deleteResult = mysqli_query($this->connect, $deleteSql);
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
        $sql = "SELECT `order_id`, `user_name`, `user_mobile`, `user_address`, `order_time`, `product_details`, `status` FROM `orders` ORDER BY FIELD(`status`, 'pending', 'accepted', 'delivered')";
        $result = mysqli_query($this->connect, $sql);

        $orders = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $orders[] = $row;
        }

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
            <?php include("../components/adminSidebar.php"); ?>
            <div class="contaner" style="height:100px"></div>
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
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $index=> $order) { ?>
                            <tr>
                                <td class="align-middle">
                                    <?php echo $index+1 ?>
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
                                            data-bs-target="#staticBackdrop">
                                            See product Details
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
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
                                    <?php echo $order['status'];


                                    ?>
                                </td>
                                <td class="align-middle">
                                    <?php if ($order['status'] == 'pending') { ?>
                                        <form method="post" action="">
                                            <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                            <button type="submit" name="accept_order" class="btn btn-success">Accept</button>
                                            <button type="submit" name="cancel_order" class="btn btn-danger">Cancel</button>
                                        </form>
                                    <?php } elseif ($order['status'] == 'accepted') { ?>
                                        <form method="post" action="">
                                            <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                            <button type="submit" name="deliver_order" class="btn btn-primary">Deliver</button>
                                        </form>
                                    <?php } elseif ($order['status'] == 'delivered') { ?>
                                        Delivered at
                                        <?php echo $order['order_time']; ?>
                                    <?php } ?>
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