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
    $userResult = $con->query("SELECT isAdmin FROM users WHERE `user_id` = $userID");
    // Fetch product details from the database
    $result = $con->query("SELECT * FROM orders WHERE `order-id` = $orderId");
    $userDetails = $userResult->fetch_assoc();}

    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/welcome.css" />
    <link rel="stylesheet" href="assets/css/addorder.css" />
    <style>
        .icon{
            display: flex;
            justify-content: center;
            align-items: center
            }

        .icon a {
            text-decoration: none;
            color: black;
            padding: 8px;
            background-color: #ff8080;
            border-radius: 50px;
            font-size: 14px;
            font-weight: bold;
            border: 1.5px solid;
            margin-top:50px;

            }
            .label{
                text-align:center;
                margin-bottom:-15px;
                font-weight:bold;
            }
    </style>
    <title>Order Update</title>
</head>
<body>
    <?php 
            $productDetails = $result->fetch_assoc();
            if($userDetails['isAdmin']){
                if($productDetails['store-categorie'] === 'مؤسسة'){
                    echo '
                        <div class="login">

                        <form action="./assets/php/update-order-fn.php?id=' . $orderId . '" method="post" class="login__form">
                        <a href="welcome.php">الغاء</a>
                        <h1 class="login__title">الرجاء تعديل تفاصيل الطلبية</h1>
                        
                        <div class="login__inputs">
                        <div class="login__box">
                            <select name="store-categorie" id="store-categorie">
                            <option value="مؤسسة" selected disabled>مؤسسة</option>
                            
                            </select>
                        </div>
                        
                        <div class="login__box other-hide">
                            <select name="store-type" id="store-type">';
                            $sqlstoretype = "SELECT * FROM `store-type` ";
                            $resultstoretype = $con->query($sqlstoretype);
                            while ($row = $resultstoretype->fetch_assoc()) {
                                $selected = ($row['types'] == $productDetails['store-type']) ? 'selected' : '';
                                echo '<option value="' . $row['types'] . '" ' . $selected . '>' . $row['types'] . '</option>';
                            }
                            echo'
                            </select>
                        </div>
                        <p class="label">اسم المؤسسة :</p>
                            <div class="login__box">
                            <input
                                type="text"
                                placeholder="اسم المؤسسة :"
                                id="company-name"
                                class="login__input"
                                name="company-name"
                                value="' . $productDetails['company-name'] .'"
                            />
                            
                            </div>
                        <p class="label">رقم المؤسسة :</p>
                            <div class="login__box">
                            <input
                                type="text"
                                placeholder="رقم المؤسسة :"
                                id= "company-number"
                                class="login__input"
                                name="company-number"
                                value="' . $productDetails['company-number'] .'"
                            />
                            
                            </div>
                            <p class="label">المحافظة :</p>
                            <div class="login__box">
                            <select name="store-location-governorate" id="store-location-governorate">';
                            $sqlgov = "SELECT * FROM `governorate` ";
                            $resultgov = $con->query($sqlgov);
                            while ($row = $resultgov->fetch_assoc()) {
                                $selected = ($row['governorate-name'] == $productDetails['store-location-governorate']) ? 'selected' : '';
                                echo '<option value="' . $row['governorate-name'] . '" ' . $selected . '>' . $row['governorate-name'] . '</option>';
                            }
                            echo'
                            </select>
                            </div>
                            <p class="label">العنوان كتابة :</p>
                            <div class="login__box">
                            <input
                                type="text"
                                placeholder="العنوان كتابة :"
                                id="location-text"
                                name="location-text"
                                class="login__input"
                                value="' . $productDetails['location-text'] .'"
                            />
                            </div>
                            <p class="label">العنوان خربطة :</p>
                            <div class="login__box other-hide">
                            <input
                                type="text"
                                placeholder="العنوان خريطة :"
                                id="location-map"
                                name="location-map"
                                class="login__input"
                                readonly
                                value="' . $productDetails['location-map'] .'"
                                
                            />
                            </div>
                            
                            <p class="label">اسم مستلم المؤسسة :</p>
                            <div class="login__box other-hide">
                            <input
                                type="text"
                                placeholder="اسم مستلم المؤسسة :"
                                id="store-receiver-name"
                                name="store-receiver-name"
                                class="login__input"
                                value="' . $productDetails['store-receiver-name'] .'"
                                
                            />
                            </div>
                            <p class="label">رقم مستلم المؤسسة :</p>
                            <div class="login__box other-hide">
                            <input
                                type="text"
                                placeholder="رقم مستلم المؤسسة :"
                                id="store-receiver-number"
                                name="store-receiver-number"
                                class="login__input"
                                value="' . $productDetails['store-receiver-number'] .'"
                                
                            />
                            </div>
                            <p class="label">ملاحظة :</p>
                            <div class="login__box">
                            <input
                                type="text"
                                placeholder="ملاحظة :"
                                id="note"
                                name="note"
                                class="login__input"
                                value="' . $productDetails['note'] .'"
                    
                            />
                            </div>
                            <p class="label">اسم المندوب :</p>
                            <div class="login__box">
                            <input
                                type="text"
                                placeholder="اسم المندوب :"
                                readonly
                                id="representative"
                                name="representative"
                                class="login__input"
                                value="' . $productDetails['representative'] .'"
                            />
                            </div>
                            <p class="label">الحالة :</p>
                            <div class="login__box">
                            <select name="status" id="status">
                            <option value="قيد الانتظار" selected>قيد الانتظار</option>
                            <option value="ملغاة" >ملغاة </option>
                            
                            </select>
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
                                value="' . $productDetails['spoon-box-count'] .'"
                                
                                
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
                                value="' . $productDetails['spoon-bag-count'] .'"
                                
                                
                            />
                            </div>
                            
                            <p id="total-cost" style="font-weight:bold;">السعر الاجمالي : ' . $productDetails['total-price'] . '$</p>
                            
                        </div>
                        <button type="submit" class="login__button" name="submit">حفظ الطلبية</button>
                        
                        </form>
                    
                
                    </div>
                        
                        ';
                }else{
                    echo '

                        <div class="login">

                        <form action="./assets/php/update-order-fn.php?id=' . $orderId . '" method="post" class="login__form">
                        <a href="welcome.php">الغاء</a>
                        <h1 class="login__title">الرجاء تعديل تفاصيل الطلبية</h1>
                        
                        <div class="login__inputs">
                        <div class="login__box">
                            <select name="store-categorie" id="store-categorie">
                            <option value="فردي" selected disabled>فردي</option>
                            
                            </select>
                        </div>
                        <p class="label">اسم الزبون :</p>
                            <div class="login__box">
                            <input
                                type="text"
                                placeholder="اسم المؤسسة :"
                                id="company-name"
                                class="login__input"
                                name="company-name"
                                value="' . $productDetails['company-name'] .'"
                            />
                            
                            </div>
                        <p class="label">رقم الزبون :</p>
                            <div class="login__box">
                            <input
                                type="text"
                                placeholder="رقم المؤسسة :"
                                id= "company-number"
                                class="login__input"
                                name="company-number"
                                value="' . $productDetails['company-number'] .'"
                            />
                            
                            </div>
                            <p class="label">المحافظة :</p>
                            <div class="login__box">
                            <select name="store-location-governorate" id="store-location-governorate">';
                            $sqlgov = "SELECT * FROM `governorate` ";
                            $resultgov = $con->query($sqlgov);
                            while ($row = $resultgov->fetch_assoc()) {
                                $selected = ($row['governorate-name'] == $productDetails['store-location-governorate']) ? 'selected' : '';
                                echo '<option value="' . $row['governorate-name'] . '" ' . $selected . '>' . $row['governorate-name'] . '</option>';
                            }
                            echo'
                                
                            </select>
                            </div>
                            <p class="label">العنوان كتابة :</p>
                            <div class="login__box">
                            <input
                                type="text"
                                placeholder="العنوان كتابة :"
                                id="location-text"
                                name="location-text"
                                class="login__input"
                                value="' . $productDetails['location-text'] .'"
                            />
                            </div>
                        
                            <p class="label">ملاحظة :</p>
                            <div class="login__box">
                            <input
                                type="text"
                                placeholder="ملاحظة :"
                                id="note"
                                name="note"
                                class="login__input"
                                value="' . $productDetails['note'] .'"
                    
                            />
                            </div>
                            <p class="label">اسم المندوب :</p>
                            <div class="login__box">
                            <input
                                type="text"
                                placeholder="اسم المندوب :"
                                readonly
                                id="representative"
                                name="representative"
                                class="login__input"
                                value="' . $productDetails['representative'] .'"
                            />
                            </div>
                            <p class="label">الحالة :</p>
                            <div class="login__box">
                            <select name="status" id="status">
                            <option value="قيد الانتظار" selected>قيد الانتظار</option>
                            <option value="ملغاة" >ملغاة </option>
                            
                            </select>
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
                                value="' . $productDetails['spoon-box-count'] .'"
                                
                                
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
                                value="' . $productDetails['spoon-bag-count'] .'"
                                
                                
                            />
                            </div>
                            
                            <p id="total-cost" style="font-weight:bold;">السعر الاجمالي : ' . $productDetails['total-price'] . '$</p>
                            
                        </div>
                        <button type="submit" class="login__button" name="submit">حفظ الطلبية</button>
                        
                        </form>
                    
                
                    </div>
                        
                        ';
                }
            }else{
                if($productDetails['status'] === 'قيد الانتظار'){
                    if($productDetails['store-categorie'] === 'مؤسسة'){
                        echo '

                        <div class="login">

                        <form method="post" class="login__form">
                        <a href="welcome.php">الغاء</a>
                        <h1 class="login__title">الرجاء تعديل تفاصيل الطلبية</h1>
                        
                        <div class="login__inputs">
                        <div class="login__box">
                            <select name="store-categorie" id="store-categorie">
                            <option value="مؤسسة" selected disabled>مؤسسة</option>
                            
                            </select>
                        </div>
                        
                        <div class="login__box other-hide">
                            <select name="store-type" id="store-type">
                            <option value="" disabled selected>أختر نوع المؤسسة</option>
                            <option value="سوبر ماركت">سوبر ماركت</option>
                            <option value="صيدلية">صيدلية</option>
                            </select>
                        </div>
                        <p class="label">اسم المؤسسة :</p>
                            <div class="login__box">
                            <input
                                type="text"
                                placeholder="اسم المؤسسة :"
                                id="company-name"
                                class="login__input"
                                name="company-name"
                                value="' . $productDetails['company-name'] .'"
                            />
                            
                            </div>
                        <p class="label">رقم المؤسسة :</p>
                            <div class="login__box">
                            <input
                                type="text"
                                placeholder="رقم المؤسسة :"
                                id= "company-number"
                                class="login__input"
                                name="company-number"
                                value="' . $productDetails['company-number'] .'"
                            />
                            
                            </div>
                            <p class="label">المحافظة :</p>
                            <div class="login__box">
                            <select name="store-location-governorate" id="store-location-governorate">
                                <option value="محافظة لبنان الشمالي" ' . (($productDetails['store-location-governorate'] == 'محافظة لبنان الشمالي') ? 'selected' : '') . '>محافظة لبنان الشمالي</option>
                                <option value="محافظة بيروت" ' . (($productDetails['store-location-governorate'] == 'محافظة بيروت') ? 'selected' : '') . '>محافظة بيروت</option>
                                <option value="محافظة جبل لبنان" ' . (($productDetails['store-location-governorate'] == 'محافظة جبل لبنان') ? 'selected' : '') . '>محافظة جبل لبنان</option>
                                <option value="محافظة لبنان الجنوبي" ' . (($productDetails['store-location-governorate'] == 'محافظة لبنان الجنوبي') ? 'selected' : '') . '>محافظة لبنان الجنوبي</option>
                                <option value="محافظة البقاع" ' . (($productDetails['store-location-governorate'] == 'محافظة البقاع') ? 'selected' : '') . '>محافظة البقاع</option>
                                <option value="محافظة النبطية" ' . (($productDetails['store-location-governorate'] == 'محافظة النبطية') ? 'selected' : '') . '>محافظة النبطية</option>
                                <option value="محافظة بعلبك الهرمل" ' . (($productDetails['store-location-governorate'] == 'محافظة بعلبك الهرمل') ? 'selected' : '') . '>محافظة بعلبك الهرمل</option>
                                <option value="محافظة عكار" ' . (($productDetails['store-location-governorate'] == 'محافظة عكار') ? 'selected' : '') . '>محافظة عكار</option>
                            </select>
                            </div>
                            <p class="label">العنوان كتابة :</p>
                            <div class="login__box">
                            <input
                                type="text"
                                placeholder="العنوان كتابة :"
                                id="location-text"
                                name="location-text"
                                class="login__input"
                                value="' . $productDetails['location-text'] .'"
                            />
                            </div>
                            <p class="label">العنوان خربطة :</p>
                            <div class="login__box other-hide">
                            <input
                                type="text"
                                placeholder="العنوان خريطة :"
                                id="location-map"
                                name="location-map"
                                class="login__input"
                                readonly
                                value="' . $productDetails['location-map'] .'"
                                
                            />
                            </div>
                            
                            <p class="label">اسم مستلم المؤسسة :</p>
                            <div class="login__box other-hide">
                            <input
                                type="text"
                                placeholder="اسم مستلم المؤسسة :"
                                id="store-receiver-name"
                                name="store-receiver-name"
                                class="login__input"
                                value="' . $productDetails['store-receiver-name'] .'"
                                
                            />
                            </div>
                            <p class="label">رقم مستلم المؤسسة :</p>
                            <div class="login__box other-hide">
                            <input
                                type="text"
                                placeholder="رقم مستلم المؤسسة :"
                                id="store-receiver-number"
                                name="store-receiver-number"
                                class="login__input"
                                value="' . $productDetails['store-receiver-number'] .'"
                                
                            />
                            </div>
                            <p class="label">ملاحظة :</p>
                            <div class="login__box">
                            <input
                                type="text"
                                placeholder="ملاحظة :"
                                id="note"
                                name="note"
                                class="login__input"
                                value="' . $productDetails['note'] .'"
                    
                            />
                            </div>
                            <p class="label">اسم المندوب :</p>
                            <div class="login__box">
                            <input
                                type="text"
                                placeholder="اسم المندوب :"
                                readonly
                                id="representative"
                                name="representative"
                                class="login__input"
                                value="' . $productDetails['representative'] .'"
                            />
                            </div>
                            <p class="label">الحالة :</p>
                            <div class="login__box">
                            <select name="status" id="status">
                            <option value="قيد الانتظار" selected>قيد الانتظار</option>
                            <option value="ملغاة" >ملغاة </option>
                            
                            </select>
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
                                value="' . $productDetails['spoon-box-count'] .'"
                                
                                
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
                                value="' . $productDetails['spoon-bag-count'] .'"
                                
                                
                            />
                            </div>
                            
                            <p id="total-cost" style="font-weight:bold;">السعر الاجمالي : ' . $productDetails['total-price'] . '$</p>
                            
                        </div>
                        <button type="submit" class="login__button" name="submit">حفظ الطلبية</button>
                        
                        </form>
                    
                
                    </div>
                        
                        ';
                    }else{

                        echo '

                        <div class="login">

                        <form method="post" class="login__form">
                        <a href="welcome.php">الغاء</a>
                        <h1 class="login__title">الرجاء تعديل تفاصيل الطلبية</h1>
                        
                        <div class="login__inputs">
                        <div class="login__box">
                            <select name="store-categorie" id="store-categorie">
                            <option value="فردي" selected disabled>فردي</option>
                            
                            </select>
                        </div>
                        <p class="label">اسم الزبون :</p>
                            <div class="login__box">
                            <input
                                type="text"
                                placeholder="اسم المؤسسة :"
                                id="company-name"
                                class="login__input"
                                name="company-name"
                                value="' . $productDetails['company-name'] .'"
                            />
                            
                            </div>
                        <p class="label">رقم الزبون :</p>
                            <div class="login__box">
                            <input
                                type="text"
                                placeholder="رقم المؤسسة :"
                                id= "company-number"
                                class="login__input"
                                name="company-number"
                                value="' . $productDetails['company-number'] .'"
                            />
                            
                            </div>
                            <p class="label">المحافظة :</p>
                            <div class="login__box">
                            <select name="store-location-governorate" id="store-location-governorate">
                                <option value="محافظة لبنان الشمالي" ' . (($productDetails['store-location-governorate'] == 'محافظة لبنان الشمالي') ? 'selected' : '') . '>محافظة لبنان الشمالي</option>
                                <option value="محافظة بيروت" ' . (($productDetails['store-location-governorate'] == 'محافظة بيروت') ? 'selected' : '') . '>محافظة بيروت</option>
                                <option value="محافظة جبل لبنان" ' . (($productDetails['store-location-governorate'] == 'محافظة جبل لبنان') ? 'selected' : '') . '>محافظة جبل لبنان</option>
                                <option value="محافظة لبنان الجنوبي" ' . (($productDetails['store-location-governorate'] == 'محافظة لبنان الجنوبي') ? 'selected' : '') . '>محافظة لبنان الجنوبي</option>
                                <option value="محافظة البقاع" ' . (($productDetails['store-location-governorate'] == 'محافظة البقاع') ? 'selected' : '') . '>محافظة البقاع</option>
                                <option value="محافظة النبطية" ' . (($productDetails['store-location-governorate'] == 'محافظة النبطية') ? 'selected' : '') . '>محافظة النبطية</option>
                                <option value="محافظة بعلبك الهرمل" ' . (($productDetails['store-location-governorate'] == 'محافظة بعلبك الهرمل') ? 'selected' : '') . '>محافظة بعلبك الهرمل</option>
                                <option value="محافظة عكار" ' . (($productDetails['store-location-governorate'] == 'محافظة عكار') ? 'selected' : '') . '>محافظة عكار</option>
                            </select>
                            </div>
                            <p class="label">العنوان كتابة :</p>
                            <div class="login__box">
                            <input
                                type="text"
                                placeholder="العنوان كتابة :"
                                id="location-text"
                                name="location-text"
                                class="login__input"
                                value="' . $productDetails['location-text'] .'"
                            />
                            </div>
                        
                            <p class="label">ملاحظة :</p>
                            <div class="login__box">
                            <input
                                type="text"
                                placeholder="ملاحظة :"
                                id="note"
                                name="note"
                                class="login__input"
                                value="' . $productDetails['note'] .'"
                    
                            />
                            </div>
                            <p class="label">اسم المندوب :</p>
                            <div class="login__box">
                            <input
                                type="text"
                                placeholder="اسم المندوب :"
                                readonly
                                id="representative"
                                name="representative"
                                class="login__input"
                                value="' . $productDetails['representative'] .'"
                            />
                            </div>
                            <p class="label">الحالة :</p>
                            <div class="login__box">
                            <select name="status" id="status">
                            <option value="قيد الانتظار" selected>قيد الانتظار</option>
                            <option value="ملغاة" >ملغاة </option>
                            
                            </select>
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
                                value="' . $productDetails['spoon-box-count'] .'"
                                
                                
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
                                value="' . $productDetails['spoon-bag-count'] .'"
                                
                                
                            />
                            </div>
                            
                            <p id="total-cost" style="font-weight:bold;">السعر الاجمالي : ' . $productDetails['total-price'] . '$</p>
                            
                        </div>
                        <button type="submit" class="login__button" name="submit">حفظ الطلبية</button>
                        
                        </form>
                    
                
                    </div>
                        
                        ';


                    }
                }else{
                    echo '
                    <div class="icon">
                    <a href="welcome.php">تراجع</a>
                    </div>
                    ';
                    echo '<h1 style="font-size:20px;margin-top:70px;">لتعديل الطلبية , يرجى التواصل واتساب مع قسم الدعم </h1>';
                    echo '<h1 style="font-size:20px;">76723329</h1>';
                }
            }
            
        

?>

<script>
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
</script>
</body>
</html>