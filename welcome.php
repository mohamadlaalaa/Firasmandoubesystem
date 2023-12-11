<?php
session_start();
include("connection.php");
include("functions.php");

$user_data = check_login($con);
$userID = $_SESSION['user_id'];
$stmt = $con->prepare("SELECT `name`, `isAdmin` FROM `users` WHERE `user_id` = ?");
$stmt->bind_param("i", $userID);
$stmt->execute();
$stmt->bind_result($fullName, $isAdmin);
$stmt->fetch();
$stmt->close();

// Fetch orders for the current representative
$ordersStmt = $con->prepare("SELECT * FROM `orders` WHERE `representative` = ? ORDER BY `order-date` DESC");
$ordersStmt->bind_param("s", $fullName);
$ordersStmt->execute();
$ordersResult = $ordersStmt->get_result();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/welcome.css" />
    
    <title>Welcome</title>
</head>
<body>
    <h1>أهلا <?php echo $fullName ?> !</h1>
    <div class="control-button">
      <a href="addorder.php" class="add-order">اضافة طلب</a>
      <a href="#" class="logout" id="logoutLink">خروج</a>
      <?php
      if($isAdmin){
        echo '
        <a href="./admin/index.php" style="margin-right:30px;background-color:#FBF6EE;">Admin page</a>
        ';
      }
      ?>
      
    </div>

    <div class="orders-list">
      <div class="orders-list-content">
            <?php
            // Loop through orders and display each one
            
            while ($order = $ordersResult->fetch_assoc()) {
              
                echo '<div class="order">';
                echo '<a href="order-details.php?id=' . $order['order-id'] . '" style="text-decoration:none;color:black;">';
                echo '<div class="order-general">';
                echo '<div class="order-general-data">';
                echo '<h2>' . $order['company-name'] . '</h2>';
                echo '<p>' . $order['representative'] . '</p>';
                echo '<p>' . $order['company-number'] . '</p>';
                echo '</div>';
                echo '<div class="order-general-details">';
                echo '<p style="text-align:left;opacity:0.4;">SP - ' . $order['orderInvoice'] . '</p>';
                echo '<p>' . $order['store-location-governorate'] . '</p>';
                echo '</div>';
                echo '</div>';
                echo '<div class="order-detail">';
                echo '<p class="price">' . $order['total-price'] . '$</p>';
                echo '<p class="status">' . $order['status'] . '</p>';
                $formattedDate = date('Y-m-d', strtotime($order['order-date']));
                echo '<p class="date">' . $formattedDate . '</p>';
                echo '</div>';
                echo '</a>';
                echo '</div>';
              
              

            }
            ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="assets/js/welcome.js"></script>
  </body>
</html>