<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin_dashboard.css">
</head>
<body>
    
<header>
        <h1>SWM PADRE</h1>
        <nav>
            <ul class="links">
                <li><a href="homepage.html">Home</a></li>
                <li><a href="biogas.html">Services</a></li>
                <li><a href="market_place.php">Market</a></li>
            </ul>
        </nav>
    </header>

<div class="dashboard">
    <h1>Admin Dashboard</h1>
    <a href="add_product.php" class="add-btn">Add New Product</a>

    <table>
        <tr>
            <th>Product Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        
        <?php
         
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);

            include 'db_connect.php';

            $sql = "SELECT * FROM products";
            $result = mysqli_query($conn, $sql);

          
            if (!$result) {
                die("Query failed: " . mysqli_error($conn));
            }

          
            while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['description']); ?></td>
                <td><?php echo htmlspecialchars($row['price']); ?></td>
                <td><img src="<?php echo htmlspecialchars($row['image_path']); ?>" width="100" alt="Product Image"></td>
                <td>
                    <a href="edit_product.php?id=<?php echo $row['id']; ?>">Edit</a> | 
                    <a href="delete_product.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

<footer class="footer">
        <div class="footer-container">

            <div class="footer-section contact-us">
                <h3>Contact Us</h3>
                <p><strong>Email:</strong> fst-014-21@must.ac.mw</p>
                <p><strong>Cell:</strong> +265-999-936-164</p>
                <p><strong>Address:</strong> 111 Nansadi street, Goliati </p>
            </div>
    
            <div class="footer-section support">
                <h3>Support Us</h3>
                <ul>
                    <li><a href="#">Donate</a></li>
                    <li><a href="#">Volunteer</a></li>
                    <li><a href="#">Become a Partner</a></li>
                </ul>
            </div>
    
            <div class="footer-section about-us">
                <h3>About Us</h3>
                <p>We are a sustainable waste management organization focused on turning waste into valuable resources. Our mission is to promote environmental sustainability through innovative waste management solutions.</p>
            </div>
    
            <div class="footer-section terms">
                <h3>Terms of Service</h3>
                <ul>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms & Conditions</a></li>
                    <li><a href="#">Cookie Policy</a></li>
                </ul>
            </div>
        </div>
    
        <div class="footer-bottom">
            <p>&copy; 2024 Designed by Padre <span>😎</span> | All Rights Reserved</p>
        </div>
    </footer>

</body>
</html>
