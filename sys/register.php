<?php

// FOR DEBUG PURPOSES ONLY! FOR DEBUG PURPOSES ONLY! FOR DEBUG PURPOSES ONLY!
// FOR DEBUG PURPOSES ONLY! FOR DEBUG PURPOSES ONLY! FOR DEBUG PURPOSES ONLY!
// FOR DEBUG PURPOSES ONLY! FOR DEBUG PURPOSES ONLY! FOR DEBUG PURPOSES ONLY!

// This script will not be included in the production system.
// Users can be created by the admin user.

include_once "dbconf.php";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $Username = $_POST["username"];
    $Password = $_POST["password"];
    $EMail = $_POST["email"];
    $CDate = date("Ymd");
    
    $PasswordHashed = password_hash($Password, null, []);

    // Prepare Query and Bind Data
    $stmt = $conn -> prepare("INSERT INTO User (User_ID, User_Name, User_Password, User_EMail, User_CDate) VALUES (NULL, ?, ?, ?, ?)");
    $stmt -> bind_param("ssss", $Username, $PasswordHashed, $EMail, $CDate);
    // Execute Query
    $stmt -> execute();

    echo "New Account has been registered!";

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - LCMS</title>
</head>
<body>
    
    <form action="register.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username">
        <label for="email">E-Mail:</label>
        <input type="email" name="email" id="email">
        <label for="password">Password:</label>
        <input type="text" name="password" id="password">
        <input type="submit" value="Register">
    </form>

</body>
</html>