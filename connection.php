<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "l";
$dbname = "mandoub";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
    die('Failed to connect!');
}



?>
