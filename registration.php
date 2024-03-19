<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="registration.css">
</head>
<body>
    <h2>User Registration Form</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" name="register" value="Register">
    </form>

    <?php
    
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "internshipdb";

   
    $conn = new mysqli($servername, $username, $password, $dbname);

    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
        
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
        
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo "<p>New record created successfully</p>";
            header("Location: login.php");
           exit();
        } else {
            echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    }

    
    $conn->close();
    ?>
</body>
</html>
