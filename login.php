<?php
session_start();

// Database connection
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "internshipdb"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


echo "<!DOCTYPE html>";
echo "<html>";
echo "<head>";
echo "<meta charset='UTF-8'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<title>Login Page</title>";
echo "<link rel='stylesheet' href='styles.css'>"; 
echo "</head>";
echo "<body>";

echo "<div class='container'>"; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];
        
        
        if (password_verify($password, $hashed_password)) {
           
            $_SESSION['username'] = $username;
            header("Location: index.html"); 
            exit();
        } else {
            
            $error = "";
        }
    } else {
        
        $error = "";
    }
}


echo "<div class='login-form'>";
echo "<h2>Login</h2>";
if (isset($error)) {
    echo "<p style='color: red;'>$error</p>";
}
echo "<form action='' method='post'>"; 
echo "<label for='username'>Username:</label>";
echo "<input type='text' id='username' name='username' required><br><br>";
echo "<label for='password'>Password:</label>";
echo "<input type='password' id='password' name='password' required><br><br>";
echo "<input type='submit' value='Login'>";
echo "</form>";
echo "</div>"; 

echo "</div>"; 

echo "</body>";
echo "</html>";


$conn->close();
?>
