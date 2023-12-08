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


?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!--=============== REMIXICONS ===============-->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css"
      crossorigin=""
    />

    <link rel="stylesheet" href="assets/css/addorder.css" />

    <title>Add Order</title>
  </head>
  <body>
    <div class="login">

      <form action="./php/add-orders-fn.php" method="post" class="login__form" id="addorder-form" onsubmit="return checkForm();">
        <a href="welcome.php">الغاء</a>
        <h1 class="login__title">الرجاء ادخال تفاصيل الطلبية</h1>
        
        <div class="login__inputs">
        <div class="login__box">
          <select name="store-categorie" id="store-categorie">
            <option value="مؤسسة">مؤسسة</option>
            <option value="فردي">فردي</option>
          </select>
        </div>
        <div class="login__box other-hide">
        <select name="store-type" id="store-type">
            <option value="" disabled selected>أختر نوع المؤسسة</option>
          <?php
          $sqlstoretype = "SELECT * FROM `store-type` ";
          $resultstoretype = $con->query($sqlstoretype);
          while ($row = $resultstoretype->fetch_assoc()) {
            // Use the values in the select options
            echo '<option value="' . $row['types'] . '">' . $row['types'] . '</option>';
        }
           ?>
          </select>
        </div>
          <div class="login__box">
            <input
              type="text"
              placeholder="اسم المؤسسة :"
              id="company-name"
              class="login__input"
              name="company-name"
            />
            
          </div>
          <div class="login__box">
            <input
              type="text"
              placeholder="رقم المؤسسة :"
              id= "company-number"
              class="login__input"
              name="company-number"
            />
            
          </div>
          <div class="login__box">
            <select name="store-location-governorate" id="store-location-governorate">
            
            <?php
          $sqlgovernorate = "SELECT * FROM `governorate` ";
          $resultgovernorate = $con->query($sqlgovernorate);
          while ($row = $resultgovernorate->fetch_assoc()) {
            // Use the values in the select options
            echo '<option value="' . $row['governorate-name'] . '">' . $row['governorate-name'] . '</option>';
        }
           ?>
            
          </select>
          </div>
          <div class="login__box">
            <input
              type="text"
              placeholder="العنوان كتابة :"
              id="location-text"
              name="location-text"
              class="login__input"
            />
          </div>
          <div class="login__box other-hide" id="location-map-div">
            <input
              type="text"
              placeholder="العنوان خريطة :"
              id="location-map"
              name="location-map"
              class="login__input"
              readonly
              
            />
          </div>
          
          
          <div class="login__box other-hide">
            <input
              type="text"
              placeholder="اسم مستلم المؤسسة :"
              id="store-receiver-name"
              name="store-receiver-name"
              class="login__input"
              
            />
          </div>
          <div class="login__box other-hide">
            <input
              type="text"
              placeholder="رقم مستلم المؤسسة :"
              id="store-receiver-number"
              name="store-receiver-number"
              class="login__input"
              
            />
          </div>
          <div class="login__box">
          <input
              type="text"
              placeholder="ملاحظة :"
              id="note"
              name="note"
              class="login__input"
    
            />
          </div>
          <div class="login__box">
            <input
              type="text"
              placeholder="اسم المندوب :"
              readonly
              id="representative"
              name="representative"
              class="login__input"
              value="<?php echo $fullName?>"
            />
          </div>
          <div class="login__box">
          <input
              type="text"
              placeholder=""
              readonly
              id="status"
              name="status"
              class="login__input"
              value="قيد الانتظار"
            />
          </div>
          <p style="text-align:center;margin-bottom:-15px;font-weight:bold;">علبة 25 ملعقة = 15.5$</p>
          <div class="login__box">
            <input
              type="number"
              placeholder="العدد :"
              name="spoon-box-count"
              class="login__input"
              id="spoon-box-count"
              oninput="updateTotal()"
              value="0"

              
              
            />
          </div>
          <p style="text-align:center;margin-bottom:-15px;font-weight:bold;">كيس 10 ملعقة = 6.25$</p>
          <div class="login__box">
            <input
              type="number"
              placeholder="العدد :"
              name="spoon-bag-count"
              class="login__input"
              id="spoon-bag-count"
              oninput="updateTotal()"
              value="0"
              
              
            />
          </div>
          
          <p id="total-cost" style="font-weight:bold;">السعر الاجمالي :</p>
          
        </div>
        <input type="text" name="orderid" id="order-id" style="display:none;" readonly/>
        <button type="submit" class="login__button" name="submit" id="submitBtn">حفظ الطلبية</button>
        
      </form>
      <button onclick="getLocation()" id="location-btn" class="location-btn">الحصول على الموقع الحالي</button>

    </div>
<script src="./assets/js/functions.js"></script>
<script src="./assets/js/submitordersettings.js"></script>
</body>
</html>
