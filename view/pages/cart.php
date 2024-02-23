<?php
session_start();
$_SESSION['user_id'];
class Cart
{
  private $cart = [], $product = [], $userCartIds = [];
  private $connect;
  private $userId, $productId;

  public function __construct()
  {
    include("../connections/database.php");
    $this->connect = $connect;
    $this->userId = $_SESSION['user_id'];
    $this->fetchCartItems();
    $this->fetchPoductItems();
  }
  private function fetchCartItems()
  {
    $sql = "SELECT * FROM carts WHERE user_id = $this->userId";
    $result = mysqli_query($this->connect, $sql);

    if ($result) {
      $this->cart = [];
      while ($row = mysqli_fetch_assoc($result)) {
        $this->cart[] = $row;
        $this->userCartIds[] = $row['product_id'];
      }
    }

  }


  private function fetchPoductItems()
  {
    foreach ($this->userCartIds as $cartItems) {
      $sql = "SELECT * FROM products WHERE product_id = $cartItems";
      $result = mysqli_query($this->connect, $sql);
      if ($result) {
        while ($row = mysqli_fetch_array($result)) {
          $this->product[] = $row;
        }
      }

    }
  }
  public function getCart()
  {
    return $this->cart;
  }
  public function getProduct()
  {
    return $this->product;
  }
  public function getUserId()
  {
    return $this->userCartIds;
  }
}

class showData
{

  private $cart = [], $product = [], $connect, $userId,$totalPrice=0,$jsonProducts;

  public function __construct()
  {
    $cart = new Cart();
    $this->cart = $cart->getCart();
    $this->product = $cart->getProduct();
    $this->userId = $_SESSION["user_id"];
    include("../connections/database.php");
    $this->connect = $connect;
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["removeProductId"])) {
      $this->remove($_POST["removeProductId"]);
    }
    if (isset($_POST['incrementQuantity'])) {
      $this->incrementQuantity($_POST['incrementQuantity']);
    }

    if (isset($_POST['decrementQuantity'])) {
      $this->decrementQuantity($_POST['decrementQuantity']);
    }
    if (isset($_POST['paymentId']) && isset($_POST['mobileNumber'])) {
      $this->displayCartItemsAsJSON();
    }
    $_SESSION["total_price"]=$this->totalPrice;
  }
  function quntityChecker(int $id)
  {
    foreach ($this->cart as $item) {

      if ($item["product_id"] == $id) {
        return $item["product_quantity"];
      }
    }
  }
  private function remove($id)
  {
    $sql = "DELETE FROM carts WHERE user_id = $_SESSION[user_id] AND product_id = $id";
    $result = mysqli_query($this->connect, $sql);

    if (!$result) {
      echo '<script>alert("Failed to remove item from cart."); window.location.href = window.location.href</script>';
    } else {
      echo '<script>alert("Item removed from cart."); window.location.href = window.location.href;</script>';
    }
  }
  private function incrementQuantity($id)
  {
    $productId = mysqli_real_escape_string($this->connect, $id);

    // Fetch the current quantity from the database
    $fetchSql = "SELECT product_quantity FROM carts WHERE product_id = $productId AND user_id = $this->userId";
    $fetchResult = mysqli_query($this->connect, $fetchSql);

    if ($fetchResult) {
      $row = $fetchResult->fetch_assoc();
      if (!$row) {
        echo "<script>alert('Product not found in the cart.');</script>";
      } else {
        $currentQuantity = $row['product_quantity'];
        $newQuantity = $currentQuantity + 1;
        // Update the quantity in the database
        $updateSql = "UPDATE carts SET product_quantity = $newQuantity WHERE product_id = $productId AND user_id = $this->userId";
        $updateResult = mysqli_query($this->connect, $updateSql);
        echo mysqli_error($this->connect);
        if ($updateResult) {
          echo "<script>alert('Quantity updated successfully.');</script>";
        } else {
          echo "<script>alert('Failed to update quantity in the database.');</script>";
        }
      }
    } else {
      echo "<script>alert('Failed to fetch quantity from the database.');</script>";
    }
  }
  private function decrementQuantity($id)
  {
    $productId = mysqli_real_escape_string($this->connect, $id);
    $fetchSql = "SELECT product_quantity FROM carts WHERE product_id = $productId AND user_id = $this->userId";
    $fetchResult = mysqli_query($this->connect, $fetchSql);

    if ($fetchResult) {
      $row = $fetchResult->fetch_assoc();
      if (!$row) {
        echo "<script>alert('Product not found in the cart.');</script>";
      } else {
        $currentQuantity = $row['product_quantity'];

        if ($currentQuantity == 1) {
          $this->remove($productId);
        } else {
          $newQuantity = $currentQuantity - 1;

          $updateSql = "UPDATE carts SET product_quantity = $newQuantity WHERE product_id = $productId AND user_id = $this->userId";
          $updateResult = mysqli_query($this->connect, $updateSql);

          if ($updateResult) {
            echo "<script>alert('Quantity updated successfully.');</script>";
          } else {
            echo "<script>alert('Failed to update quantity in the database.');</script>";
          }
        }
      }
    } else {
      echo "<script>alert('Failed to fetch quantity from the database.');</script>";
    }
  }

  public function displayCartItems()
  {

    foreach ($this->product as $item) {
      echo "<tr>";
      echo "<td>{$item['product_name']}</td>";
      echo "<td>{$item['product_model']}</td>";
      echo "<td>";
      echo "<form method='post'>";
      echo "<button type='submit' class='btn btn-link text-danger p-0' name='removeProductId' value='{$item['product_id']}'><i class='fas fa-trash-alt'></i> Remove</button>";
      echo "</td>";
      echo "<td>{$item['product_price']} TK</td>";
      echo "<td>";
      echo "<div class='input-group'>";
      echo "<button type='submit' class='btn btn-outline-secondary' name='decrementQuantity' value='{$item['product_id']}'>&minus;</button>";
      echo "<input type='text' class='bg-white form-control text-center' name='quantity' value='" . $this->quntityChecker($item["product_id"]) . "' readonly disabled>";
      echo "<button type='submit' class='btn btn-outline-secondary' name='incrementQuantity' value='{$item['product_id']}'>+</button>";
      echo "</div>";
      echo "</form>";

      echo "</td>";
      echo "</tr>";
      $this->totalPrice = $this->totalPrice + $this->quntityChecker($item["product_id"]) * $item["product_price"];
      $_SESSION["total_price"]=$this->totalPrice;
    }
    
    echo "<tr>";
    echo "<th colspan='3' class='text-right'>Total</th>";
    echo "<th>$this->totalPrice" . "  " . "TK</th>";
    echo "</tr>"; 
    // $this->fetchUserData(); 
  }
  private function fetchUserData()
  {
    $sql="SELECT * FROM `users` WHERE user_id=$this->userId";
    $result=mysqli_query($this->connect,$sql);
    if($result){
      $user = mysqli_fetch_array($result);
      $userData=array([

        'user_name'=>$user["user_name"],
        'user_id'=>$user["user_id"],
        'user_mobile'=>$_POST["mobileNumber"],
        'user_payment_id'=>$_POST["paymentId"],
        'user_address'=>$user["user_address"]
      ]);
      $jsonUserData=json_encode($userData);
      return $jsonUserData; 

    }
  }
  
  public function displayCartItemsAsJSON()
  {
      $orderDetails = [];
  
      // Add product details
      foreach ($this->product as $item) {
          $orderDetails[] = [
              'product_details' => [
                  'product_name' => $item['product_name'],
                  'product_id' => $item['product_id'],
                  'product_model' => $item['product_model'],
                  'product_price' => $item['product_price'],
                  'product_id' => $item['product_id'],
                  'product_quantity' => $this->quntityChecker($item['product_id']),
              ],
          ];
      }
  
      // Add user details
      $userDetails = $this->fetchUserData();
      $orderDetails[] = ['user_details' => $userDetails]; // Corrected here
      $orderDetails[] = ['total_amount' => $_SESSION['total_price']];
  
      $jsonData = json_encode($orderDetails);
  
      // Store JSON data in session
      $_SESSION['jsonData'] = $jsonData;
  
      // Redirect to the PDF generation script
      header("location: ../actions/generatePdfAction.php?jsonData=" . urlencode($jsonData));
  
      // Ensure that no further output is sent
      exit;
  }
  
  

  
  


}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shopping Cart</title>
  <!-- Add Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="../connections/color.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>

  <?php
  include("../components/navbar.php");
  ?>

  <div class="container mt-5">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <div class="card">
          <div class="card-header">
            <h5 class="mb-0">Cart Summary</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Product Name</th>
                    <th>Product Model</th>
                    <th>Remove</th>
                    <th>Price</th>
                    <th>Quantity</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $dataDisplayer = new showData();
                  $dataDisplayer->displayCartItems();
                  // $dataDisplayer->displayCartItemsAsJSON();
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
          <?php
          include("../components/generatePdfModal.php");
          ?>
      </div>

    </div>

  </div>
  </div>

  <div class="">
    <?php include("../components/footer.php") ?>

  </div>

  <!-- Add Bootstrap JavaScript -->
  <script src="../connections/generatePdf.js" ></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
  <script src="validate.js"></script>
  <script src="../connections/cart.js"></script>
</body>

</html>