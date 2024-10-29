<?php
include 'db_connect.php';

$id = $_GET['id'];
$sql = "DELETE FROM products WHERE id = $id";
if (mysqli_query($conn, $sql)) {
    header("Location: admin_dashboard.php");
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
