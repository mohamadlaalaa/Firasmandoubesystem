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

      <form action="./php/add-orders-fn.php" method="post" class="login__form">
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
          <div class="login__box other-hide">
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
    <script>
// preveting multi submitting 

        // Get the form and the submit button
        var formElement = document.querySelector('.login__form');
        var submitBtn = document.getElementById('submitBtn');

        // Add a click event listener to the submit button
        formElement.addEventListener('submit', function () {
            // Disable the submit button to prevent multiple submissions
            submitBtn.style.pointerEvents = "none";
            submitBtn.style.opacity = "0.6";
            submitBtn.style.cursor = "not-allowed";
            submitBtn.innerText = "يرجى الانتظار  ...";
    
        });

//===============================================================================
   

//==================getting location======================
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }

    function showPosition(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;

        // Display the location on the page

        // Construct Google Maps link
        var googleMapsLink = "https://www.google.com/maps?q=" + latitude + "," + longitude;

        // Set the Google Maps link as the value of the input with id "location-map"
        var locationMapInput = document.getElementById("location-map");
        locationMapInput.value = googleMapsLink;

       
    }

    function showError(error) {
        // Handle errors as needed
        console.error(error.message);
    }



  //==============================================================
// hiding inputs if user select فردي  =============================
  document.getElementById('store-categorie').addEventListener('change', function() {
      var selectedOption = this.value;
    
      // Get all items
      var items = document.querySelectorAll('.other-hide');
      var cusName = document.getElementById('company-name');
      var cusNumber = document.getElementById('company-number');
      var locationBtn = document.getElementById('location-btn'); 
      if (selectedOption === 'فردي'){
        cusName.placeholder = 'أسم الزبون :';
        cusNumber.placeholder = 'رقم الزبون :';
        locationBtn.style.display="none";
        
      }else{
        cusName.placeholder = 'أسم المؤسسة :';
        cusNumber.placeholder = 'رقم المؤسسة :';
        locationBtn.style.display="block";

      }
      // Loop through each item and toggle visibility based on the selected option
      items.forEach(function(item) {
        if (selectedOption === 'فردي') {
          item.style.display = 'none'; // Show the item
          
        } else {
          item.style.display = 'grid'; // Hide the item
        }
      });
    });


//==================================================================
// show total price ===================
function updateTotal() {
        // Get the values entered by the user
        var bagCount = document.getElementById('spoon-bag-count').value;
        var boxCount = document.getElementById('spoon-box-count').value;

        // Define the prices
        var bagPrice = 6.25;
        var boxPrice = 15.5;

        // Calculate the total cost
        var totalCost = bagCount * bagPrice + boxCount * boxPrice;

        // Display the total on the page
        document.getElementById('total-cost').textContent = 'السعر الاجمالي : ' + totalCost.toFixed(2) + "$";
      }

//=====================================
//==============random number =================
function generateRandomNumber() {
    const min = 1000000;
    const max = 9999999999999999;
    return Math.floor(Math.random() * (max - min + 1) + min);
}

const randomNumber = generateRandomNumber();
const randomInput = document.getElementById("order-id");
randomInput.value = randomNumber;


//======================================

</script>

</body>
</html>
