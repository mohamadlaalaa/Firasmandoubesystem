<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "jjjj";
$dbname = "mandoub";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
    die('Failed to connect!');
}



?>
