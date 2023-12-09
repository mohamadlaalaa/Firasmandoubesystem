<?php
session_start();
include("../../connection.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require './phpmailer/src/Exception.php';
require './phpmailer/src/PHPMailer.php';
require './phpmailer/src/SMTP.php';

if(isset($_POST["submit"])){
    $orderIdNumber = $_POST["orderid"];
    $digits = str_split((string) $orderIdNumber);
    // Shuffle the array of digits
    shuffle($digits);
    // Take the first 5 digits
    $randomDigits = implode('', array_slice($digits, 0, 5));
    // Create the new variable
    $orderInvoice = $randomDigits;
    $storecategorie = isset($_POST["store-categorie"]) ? $_POST["store-categorie"] : '';
    $storetype = isset($_POST["store-type"]) ? $_POST["store-type"] : '';
    $companyname = isset($_POST["company-name"]) ? $_POST["company-name"] : '';
    $companynumber = isset($_POST["company-number"]) ? $_POST["company-number"] : '';
    $storelocationgovernorate = isset($_POST["store-location-governorate"]) ? $_POST["store-location-governorate"] : '';
    $locationtext = isset($_POST["location-text"]) ? $_POST["location-text"] : '';
    $locationmap = isset($_POST["location-map"]) ? $_POST["location-map"] : '';
    $storereceivername = isset($_POST["store-receiver-name"]) ? $_POST["store-receiver-name"] : '';
    $storereceivernumber = isset($_POST["store-receiver-number"]) ? $_POST["store-receiver-number"] : '';
    $note = isset($_POST["note"]) ? $_POST["note"] : '';
    $representative = isset($_POST["representative"]) ? $_POST["representative"] : '';
    $status = isset($_POST["status"]) ? $_POST["status"] : '';
    $spoonboxcount = isset($_POST["spoon-box-count"]) ? abs($_POST["spoon-box-count"]) : 0;
    $spoonbagcount = isset($_POST["spoon-bag-count"]) ? abs($_POST["spoon-bag-count"]) : 0;
    $totalPrice = $spoonboxcount * 15.5 + $spoonbagcount * 6.25;
    date_default_timezone_set('Asia/Beirut');
    $date = date('Y-m-d H:i:s');
    $query = "INSERT INTO orders VALUES('' ,'$orderIdNumber','$orderInvoice','$storecategorie', '$storetype' ,'$companyname','$companynumber' , '$storelocationgovernorate',
     '$locationtext','$locationmap', '$storereceivername','$storereceivernumber' ,'$note', '$representative' , '$status','$spoonboxcount','$spoonbagcount','$totalPrice','$date')";
    mysqli_query($con , $query);
    
    
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = "hbaba9377@gmail.com";
    $mail->Password = 'ckdu aycu vyxd qsyz';
    $mail->SMTPSecure = 'ssl'; // Change 'ssl' to 'tls'
    $mail->Port = 465; // Update to the correct port for TLS
    $mail->setFrom('hbaba9377@gmail.com');
    $mail->addAddress('hbaba9377@gmail.com');
    $mail->isHTML(true);
    $mail->Subject = 'SP - ' . $orderInvoice; 
    $mail->Body = $representative . "--"  . $storelocationgovernorate;
    echo "
    <script>window.location.replace('../../welcome.php');</script>
    ";
    try {
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
    }
    

  

}
?>