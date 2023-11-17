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
// sdd
?>

<?php
if(isset($_POST["submit"])){
    $orderIdNumber = $_POST["orderid"];
    $digits = str_split((string) $orderIdNumber);

    // Shuffle the array of digits
    shuffle($digits);

    // Take the first 5 digits
    $randomDigits = implode('', array_slice($digits, 0, 5));

    // Create the new variable
    $orderInvoice = $randomDigits;



    $storecategorie = $_POST["store-categorie"];
    $storetype = $_POST["store-type"];
    $companyname = $_POST["company-name"];
    $companynumber = $_POST["company-number"];
    $storelocationgovernorate = $_POST["store-location-governorate"];
    $locationtext = $_POST["location-text"];
    $locationmap = $_POST["location-map"];
    $storereceivername = $_POST["store-receiver-name"];
    $storereceivernumber = $_POST["store-receiver-number"];
    $note = $_POST["note"];
    $representative = $_POST["representative"];
    $status = $_POST["status"];
    $spoonboxcount = $_POST["spoon-box-count"];
    $spoonbagcount = $_POST["spoon-bag-count"];
    $totalPrice = $spoonboxcount * 15.5 + $spoonbagcount * 6.25;
    date_default_timezone_set('Asia/Beirut');
    $date = date('Y-m-d H:i:s');
    $query = "INSERT INTO orders VALUES('' ,'$orderIdNumber','$orderInvoice','$storecategorie', '$storetype' ,'$companyname','$companynumber' , '$storelocationgovernorate',
     '$locationtext','$locationmap', '$storereceivername','$storereceivernumber' ,'$note', '$representative' , '$status','$spoonboxcount','$spoonbagcount','$totalPrice','$date')";

    mysqli_query($con , $query);
    
    
    echo "
    <script>alert('Done');window.location.replace('welcome.php');</script>
    ";

  

}
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

      <form method="post" class="login__form">
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
            <option value="سوبر ماركت">سوبر ماركت</option>
            <option value="صيدلية">صيدلية</option>
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
            <option value="محافظة لبنان الشمالي">محافظة لبنان الشمالي</option>
            <option value="محافظة بيروت">محافظة بيروت</option>
            <option value="محافظة جبل لبنان">محافظة جبل لبنان</option>
            <option value="محافظة لبنان الجنوبي">محافظة لبنان الجنوبي</option>
            <option value="محافظة البقاع">محافظة البقاع</option>
            <option value="محافظة النبطية">محافظة النبطية</option>
            <option value="محافظة بعلبك الهرمل">محافظة بعلبك الهرمل</option>
            <option value="محافظة عكار">محافظة عكار</option>
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
              
              
            />
          </div>
          
          <p id="total-cost" style="font-weight:bold;">السعر الاجمالي :</p>
          
        </div>
        <input type="text" name="orderid" id="order-id" style="display:none;" readonly/>
        <button type="submit" class="login__button" name="submit">حفظ الطلبية</button>
        
      </form>
      <button onclick="getLocation()" id="location-btn" class="location-btn">الحصول على الموقع الحالي</button>

    </div>
    <script>


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
console.log(random15DigitNumber);

//======================================

</script>

</body>
</html>
