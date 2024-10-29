<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
</head>
<style>
       
        body {
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #f5f5f5;
        }

       
        form {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

       
        h2 {
            text-align: center;
            color: #4CAF50;
        }

        
        label {
            font-weight: bold;
            color: #333;
            display: block;
            margin-top: 10px;
            
        }

        
        input[type="text"],
        input[type="number"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 1rem;
        }

        
        textarea {
            resize: vertical;
            height: 100px;
        }

        
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
   
    <form action="" method="POST" enctype="multipart/form-data">
        <h2>Add New Product</h2><br>
        <label>Product Name</label><br>
        <input type="text" name="name" required><br>
        <label>Description</label><br>
        <textarea name="description"></textarea><br>
        <label>Price</label><br>
        <input type="number" step="0.01" name="price" required><br>
        <label>Image</label><br>
        <input type="file" name="image" required><br><br>
        <input type="submit" value="Add Product">
    </form>


<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = $_POST['price'];

   
    $target_dir = __DIR__ . "/images/";
    $image_path = $target_dir . basename($_FILES["image"]["name"]);

   
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0775, true);  
    }

   
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $image_path)) {
        
        $relative_image_path = "images/" . basename($_FILES["image"]["name"]);
        $sql = "INSERT INTO products (name, description, price, image_path) VALUES ('$name', '$description', '$price', '$relative_image_path')";
        
        if (mysqli_query($conn, $sql)) {
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "Database error: " . mysqli_error($conn);
        }
    } else {
        echo "Failed to upload image.";
    }
}
?>


</body>
</html>