<?php

    session_start();

    // Check if user is logged in
    if ( isset( $_SESSION["loggedin"] ) && $_SESSION["loggedin"] === true)
    {
        header("location: ./dashboard/index.php");
        exit;
    }


    include_once "dbconf.php";

    $Username = $Password = "";
    $username_err = $password_err = $login_err = "";

    //Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){


        // Check if username is empty
        if(empty(trim($_POST["username"])))
        {
            $username_err = "Please enter username.";
        }
        else
        {
            $Username = trim($_POST["username"]);
        }
        
        // Check if password is empty
        if(empty(trim($_POST["password"])))
        {
            $password_err = "Please enter your password.";
        }
        else
        {
            $Password = trim($_POST["password"]);
        }


        
        // Validate credentials
        if( empty($username_err) && empty($password_err) )
        {
            // Prepare a select statement
            $sql = "SELECT User_ID, User_Name, User_Password FROM User WHERE User_Name = ?";
            
            if($stmt = mysqli_prepare($conn, $sql))
            {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $Username);
                
                // Set parameters
                $param_username = $username;
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt))
                {
                    // Store result
                    mysqli_stmt_store_result($stmt);
                    
                    // Check if username exists, if yes then verify password
                    if(mysqli_stmt_num_rows($stmt) == 1)
                    {                    
                        // Bind result variables
                        mysqli_stmt_bind_result($stmt, $User_ID, $Username, $Hashed_Password);
                        if(mysqli_stmt_fetch($stmt))
                        {
                            if(password_verify($Password, $Hashed_Password))
                            {
                                // Password is correct, so start a new session
                                session_start();
                                
                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $User_ID;
                                $_SESSION["username"] = $Username;                            
                                
                                // Redirect user to welcome page
                                header("location: ./dashboard/index.php");
                            } 
                            else
                            {
                                // Password is not valid, display a generic error message
                                $login_err = "Invalid username or password.";
                            }
                        }
                    } 
                    else
                    {
                        // Username doesn't exist, display a generic error message
                        $login_err = "Invalid username or password.";
                    }
                } 
                else
                {
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
        
        // Close connection
        mysqli_close($conn);
    }
?>

<!DOCTYPE html>
<html lang="de">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - LCMS</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

    <!-- Style Development -->
    <link rel="stylesheet" href="../res/css/mask/style.css">

    <!-- Style Production -->
    <!-- <link rel="stylesheet" href="../res/css/mask/style.min.css"> -->

</head>
<body>

    <main>
        <form action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" placeholder="Enter Username..." required>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="Enter Password..." required>
            <input type="submit" value="Login">
        </form>
    </main>

</body>
</html>