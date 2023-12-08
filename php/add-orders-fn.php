<?php
session_start();
include("../connection.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

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
    $spoonboxcount = abs($_POST["spoon-box-count"]);
    $spoonbagcount = abs($_POST["spoon-bag-count"]);
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
    $mail->addAddress('mohamad.laalaa700@gmail.com');
    $mail->isHTML(true);
    $mail->Subject = 'SP - ' . $orderInvoice; 
    $mail->Body = $representative . "--"  . $storelocationgovernorate;
    echo "
    <script>window.location.replace('../welcome.php');</script>
    ";
    try {
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
    }
    

  

}
?>