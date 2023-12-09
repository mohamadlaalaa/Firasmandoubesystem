<?php
session_start();
include("../../connection.php");
if (isset($_GET['id'])) {
    $orderId = $_GET['id'];}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $updatedStoreType = isset($_POST['store-type']) ? $_POST['store-type'] : '';
    $updatedCompanyName = isset($_POST['company-name']) ? $_POST['company-name'] : '';
    $updatedCompanyNumber = isset($_POST['company-number']) ? $_POST['company-number'] : '';
    $updatedStoreLocationGovernorate = isset($_POST['store-location-governorate']) ? $_POST['store-location-governorate'] : '';
    $updatedLocationText = isset($_POST['location-text']) ? $_POST['location-text'] : '';
    $updatedStoreReceiverName = isset($_POST['store-receiver-name']) ? $_POST['store-receiver-name'] : '';
    $updatedStoreReceiverNumber = isset($_POST['store-receiver-number']) ? $_POST['store-receiver-number'] : '';
    $updatedNote = isset($_POST['note']) ? $_POST['note'] : '';
    $updatedStatus = isset($_POST['status']) ? $_POST['status'] : '';
    $updatedSpoonBoxCount = isset($_POST['spoon-box-count']) ? $_POST['spoon-box-count'] : '';
    $updatedSpoonBagCount = isset($_POST['spoon-bag-count']) ? $_POST['spoon-bag-count'] : '';
    $updatedTotalPrice = $updatedSpoonBoxCount * 15.5 + $updatedSpoonBagCount * 6.25;
    $sql = "UPDATE orders 
        SET `store-type` = '$updatedStoreType', 
            `company-name` = '$updatedCompanyName', 
            `company-number` = '$updatedCompanyNumber', 
            `store-location-governorate` = '$updatedStoreLocationGovernorate', 
            `location-text` = '$updatedLocationText', 
            `store-receiver-name` = '$updatedStoreReceiverName', 
           `store-receiver-number` = '$updatedStoreReceiverNumber', 
            note = '$updatedNote', 
            `status` = '$updatedStatus', 
            `spoon-box-count` = '$updatedSpoonBoxCount', 
            `spoon-bag-count` = '$updatedSpoonBagCount', 
            `total-price`= '$updatedTotalPrice'
        WHERE `order-id` = '$orderId'";
        $result = $con->query($sql);

        if ($result === TRUE) {
    
            echo "
            <script>window.location.replace('../../welcome.php');</script>
            ";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    
        
    }

    ?>