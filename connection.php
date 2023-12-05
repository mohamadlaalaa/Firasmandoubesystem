<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "ll";
$dbname = "mandoub";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
    die('Failed to connect!');
}



?>
