<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lip_kps";

// Create Connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed" . mysqli_connect_error());
} 

function print_pre($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}
?>