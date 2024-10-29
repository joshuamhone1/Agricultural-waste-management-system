<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        $name = $row['name'];
        $description = $row['description'];
        $price = $row['price'];
        $image_path = $row['image_path'];
    } else {
        echo "Product not found.";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $id = $_POST['id'];
    $new_image_path = $image_path;

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image'];
        $image_name = basename($image['name']);
        $new_image_path = 'images/' . $image_name;

        if (!move_uploaded_file($image['tmp_name'], $new_image_path)) {
            echo "Failed to upload image.";
            exit;
        }
    }

    $sql = "UPDATE products SET name = ?, description = ?, price = ?, image_path = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssdsi", $name, $description, $price, $new_image_path, $id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: admin_dashboard.php");
        exit;
    } else {
        echo "Failed to update product.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="file"] {
            margin: 5px 0 20px;
        }
        input[type="submit"] {
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        .success {
            color: green;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <p class="success">Product updated successfully!</p>
<?php endif; ?>

<h2>Edit Product</h2>
<form action="edit_product.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    
    <label>Product Name:</label>
    <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
    
    <label>Description:</label>
    <textarea name="description" required><?php echo htmlspecialchars($description); ?></textarea>
    
    <label>Price:</label>
    <input type="number" step="0.01" name="price" value="<?php echo htmlspecialchars($price); ?>" required>
    
    <label>Current Image:</label>
    <?php if ($image_path): ?>
        <img src="<?php echo htmlspecialchars($image_path); ?>" alt="Product Image" style="width:100px; margin-bottom: 10px;">
    <?php endif; ?>
    
    <label>Upload New Image:</label>
    <input type="file" name="image">
    
    <input type="submit" value="Update Product">
</form>

</body>
</html>
