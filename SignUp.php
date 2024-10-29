<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400&family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <title>SIGNUP PAGE</title>
    <link rel="stylesheet" href="Login.css">
</head>
<body>
    <div id="mcontainer">
        <div class="container1"> 
            <h2><span>Reducing<br> Waste</span> <br> Saving <br>Resources </h2> 
        </div>

        <div class="container2">
            <form class="login" action="signUp.php" method="POST"> 
                <h1>SIGN UP</h1>

                <div class="username-input">
                    <input type="text" placeholder="Username" name="username" required> 
                </div>
                <div class="password-input">
                    <input type="password" placeholder="Password" name="password" required> 
                </div>
                <div class="password-input">
                    <input type="password" placeholder="Confirm Password" name="password2" required> 
                </div>
                <div>
                    <button type="submit" value="submit">CREATE ACCOUNT</button>
                </div>
                <p id="paragra">Already have an account?<a href="Login.php">Login</a></p>
            </form>
        </div>
    </div>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $servername = "localhost";
        $db_username = "root";
        $db_password = "PASSWORD_1";
        $dbname = "agri-waste";

        $conn = mysqli_connect($servername, $db_username, $db_password, $dbname); 
        if (!$conn) {
            die("Connection failed: "); 
        }

        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $password = $_POST["password"];
        $password2 = $_POST["password2"];

        if ($password !== $password2) {
            echo "Passwords do not match!";
        } else {
            $sql = "INSERT INTO login (username, password, role) VALUES ('$username', '$password', 'user')";

            if (mysqli_query($conn, $sql)) {
                echo "Sign Up Successful";
               header("location:Login.php");
               exit();
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }

    }
    ?>
</body>
</html>
