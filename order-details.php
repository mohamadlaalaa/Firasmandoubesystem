<?php
session_start();
include("connection.php");
include("functions.php");

$user_data = check_login($con);
$userID = $_SESSION['user_id'];
$stmt = $con->prepare("SELECT `name` FROM `users` WHERE `user_id` = ?");
$stmt->bind_param("i", $userID);
$stmt->execute();
$stmt->bind_result($fullName);
$stmt->fetch();
$stmt->close();



if (isset($_GET['id'])) {
    $orderId = $_GET['id'];

    // Fetch product details from the database
    $result = $con->query("SELECT * FROM orders WHERE `order-id` = $orderId");

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link rel="stylesheet" href="assets/css/welcome.css" />
    <style>
.order-details {
  padding: 20px;
}
.title {
  text-align: center;
  font-size: 2rem;
}
p {
  margin: 20px auto;
  text-align: center;
}
.icon{
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 10px;
}

.icon a {
  text-decoration: none;
  color: black;
  padding: 8px;
  background-color: #ff8080;
  border-radius: 50px;
  font-size: 14px;
  font-weight: bold;
  border: 1.5px solid 
}

.icon .edit{
  background-color: #A7D397;

}

    </style>
</head>
<body>
    <?php
    if ($result->num_rows > 0) {
        // Display product details
        $productDetails = $result->fetch_assoc();
        echo '
        <div class="order-details">
        <h1 class="title">Order Details</h1>
        <div class="icon">
            <a href="order-update.php?id=' . $productDetails['order-id'] . '" class="edit">تعديل</a>
            <a href="welcome.php">تراجع</a>
        </div>
        ';
        if($productDetails['store-categorie'] == 'مؤسسة'){
        echo '<p>نوع الزبون : <span>' . $productDetails['store-categorie'] . '</span></p>';
        echo '<p>نوع المؤسسة : <span>' . $productDetails['store-type'] . '</span></p>';
        echo'<p>اسم المؤسسة : <span>' . $productDetails['company-name'] . '</span></p>';
        echo'<p>رقم المؤسسة : <span>' . $productDetails['company-number'] . '</span></p>';
        echo'<p>المحافظة : <span>' . $productDetails['store-location-governorate'] . '</span></p>';
        echo'<p>العنوان كتابة : <span>' . $productDetails['location-text'] . '</span></p>';
        echo'<p>العنوان خريطة : <span><a href="' . $productDetails['location-map'] . '">'. $productDetails['location-map'] .'</a></span></p>';
        echo'<p>اسم مستلم المؤسسة : <span>' . $productDetails['store-receiver-name'] . '</span></p>';
        echo'<p>رقم مستلم المؤسسة : <span>' . $productDetails['store-receiver-number'] . '</span></p>';
        echo'<p>ملاحظة : <span>' . $productDetails['note'] . '</span></p>';
        echo'<p>المندوب : <span>' . $productDetails['representative'] . '</span></p>';
        echo'<p>الحالة : <span>' . $productDetails['status'] . '</span></p>';
        echo'<p>عدد علبة 25 ملعقة : <span>' . $productDetails['spoon-box-count'] . ' علب</span></p>';
        echo'<p>عدد كيس 10 ملعقة : <span>' . $productDetails['spoon-bag-count'] . ' أكياس</span></p>';
        echo'<p>السعر الاجمالي : <span>$ ' . $productDetails['total-price'] . '</span></p>';
        $orderDate = strtotime($productDetails['order-date']); // Convert the date to a timestamp

        echo '<p>تاريخ الطلبية :    <span>' . date('H:i:s', $orderDate) . '</span> <span>' . date('Y-m-d', $orderDate) . '</span></p>';
       

        echo '</div>';
    }else{
        echo '<p>نوع الزبون : <span>' . $productDetails['store-categorie'] . '</span></p>';
        echo '<p>اسم الزبون : <span>' . $productDetails['company-name'] . '</span></p>';
        echo'<p>رقم الزبون : <span>' . $productDetails['company-number'] . '</span></p>';
        echo'<p>المحافظة : <span>' . $productDetails['store-location-governorate'] . '</span></p>';
        echo'<p>العنوان كتابة : <span>' . $productDetails['location-text'] . '</span></p>';
        echo'<p>ملاحظة : <span>' . $productDetails['note'] . '</span></p>';
        echo'<p>المندوب : <span>' . $productDetails['representative'] . '</span></p>';
        echo'<p>الحالة : <span>' . $productDetails['status'] . '</span></p>';
        echo'<p>عدد علبة 25 ملعقة : <span>' . $productDetails['spoon-box-count'] . ' علب</span></p>';
        echo'<p>عدد كيس 10 ملعقة : <span>' . $productDetails['spoon-bag-count'] . ' أكياس</span></p>';
        echo'<p>السعر الاجمالي : <span>$ ' . $productDetails['total-price'] . '</span></p>';
        $orderDate = strtotime($productDetails['order-date']); // Convert the date to a timestamp

        echo '<p>تاريخ الطلبية :    <span>' . date('H:i:s', $orderDate) . '</span> <span>' . date('Y-m-d', $orderDate) . '</span></p>';
        echo '</div>';
    }
        
    } else {
        echo '<h1>Order not found</h1>';
    }
} else {
    echo '<p>Invalid product ID.</p>';
}
    
    ?>

</body>
</html>