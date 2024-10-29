<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400&family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>LOGIN PAGE</title>
    <link rel="stylesheet" href="SignUp.css">
</head>
<body>
    <div id="mcontainer">
        <div class="container1"> 
            <h2><span>Reducing<br> Waste</span> <br> Saving <br>Resources </h2> 
        </div>

        <div class="container2">
           <form class="login" action="Login.php" method="post" >
            <h1>USER LOGIN</h1>

            <div class="username-input">
                <input type="text" placeholder="Username" name="username" >
            </div>
            <div class="password-input">
                <input type="password"  placeholder="Password" name="password">
            </div>
            <div>
                <button type="submit" value="submit">LOGIN</button>
            </div>
            <div class="already">
                <h2>------OR------</h2>
                <p>Dont have an account yet? <a href="SignUp.php">Sign Up</a></p>
            </div>
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
        die("Connection failed: " . mysqli_connect_error());
    }

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    
    $sql = "SELECT * FROM login WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

       
        echo "Stored password: " . $row['password'] . "<br>";
        echo "Entered password: " . $password . "<br>";

        
        if ($password == $row['password']) {
            if ($row['role'] == 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location:homepage.html");
            }
            exit();
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "No user found with that username!";
    }

    mysqli_close($conn);
}
?>

</body>
</html>
