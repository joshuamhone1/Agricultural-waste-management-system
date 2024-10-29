<?php
include 'db_connect.php';

$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketplace</title>
    <link rel="stylesheet" href="market_place.css">
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


<div class="marketplace">
    <h1>Market place</h1>
    <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border: 1px solid #f5c6cb; margin-bottom: 20px; border-radius: 5px;">
        <p><strong>Notice:</strong> If you have products or services you wish to sell, please contact the administrator using the contact details provided in the footer below. 
        <br>Please be advised that all transactions on this platform are conducted at your own risk. SWM PADRE assumes no responsibility for any loss, damage, or fraudulent activity that may occur. We encourage buyers to exercise caution and conduct thorough research before making any purchase.</p>
    </div>
    
    <?php if (mysqli_num_rows($result) > 0): ?>
        <div class="products">
            <?php while ($product = mysqli_fetch_assoc($result)): ?>
                <div class="product">
                    <h2><?php echo htmlspecialchars($product['name']); ?></h2><br>
                    
                    
                    <?php if (!empty($product['image_path'])): ?>
                        <img src="<?php echo htmlspecialchars($product['image_path']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" width="150">
                    <?php else: ?>
                        <p>No image available</p>
                    <?php endif; ?>
                    <p><?php echo htmlspecialchars($product['description']); ?></p>
                    <p><strong>Price:</strong> MWK<?php echo number_format($product['price'], 2); ?></p>
                    <p><strong>Bank Account:</strong> 123456789 (Standard Bank)</p>
                    
                    <form action="add_to_cart.php" method="POST" style="display:inline;">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <button type="submit">Add to Cart</button>
                    </form>
                    <form action="buy_now.php" method="POST" style="display:inline;">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        
                        <a href="https://www.paypal.com/" target="_blank">
                             <button type="button">Buy Now</button>
                        </a>

                    </form>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>No products available at the moment.</p>
    <?php endif; ?>
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
