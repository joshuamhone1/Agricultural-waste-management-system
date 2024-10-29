<?php
$servername = "localhost";
$username = "root";
$password = "PASSWORD_1";
$dbname = "agri-waste";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
