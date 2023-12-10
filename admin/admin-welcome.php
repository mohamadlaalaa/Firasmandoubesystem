<?php 
include("../connection.php");
include("functions.php");
session_start();
$user_data = check_login($con);
echo $_SESSION['user_id'];
echo 'hhrlo' ;

?>