<?php

    session_start();
    include './sesconf.php';

    // Check if the "active" variable is set and is "true"
    if ( isset($_SESSION["active"]) && $_SESSION["active"] === true)
    {
        if (checkSessionTimestamp($Session_Duration) )
        {  
            doRedirect("./dashboard/index.php");
        }
        else
        {
            destroySession();
        }
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
            $sql = "SELECT User_ID, User_Name, User_Password, User_AccessLevel FROM User WHERE User_Name = ?";
            
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
                        mysqli_stmt_bind_result($stmt, $User_ID, $Username, $Hashed_Password, $User_AccessLevel);
                        if(mysqli_stmt_fetch($stmt))
                        {
                            if(password_verify($Password, $Hashed_Password))
                            {
                                // Password is correct, so start a new session
                                session_start();
                                
                                // Store data in session variables
                                $_SESSION["active"] = true;
                                $_SESSION["Ses_ID"] = session_create_id();
                                $_SESSION["User_ID"] = $User_ID;
                                $_SESSION["User_Name"] = $Username;
                                $_SESSION["User_AccessLevel"] = $User_AccessLevel;
                                
                                // Set new session timestamp.
                                setSessionTimestamp();
                                
                                // Redirect user to dashboard
                                doRedirect("./dashboard/index.php");
                            } 
                            else
                            {
                                // Password is not valid, display a generic error message
                                $login_err = "Invalid password.";
                            }
                        }
                    } 
                    else
                    {
                        // Username doesn't exist, display a generic error message
                        $login_err = "Invalid username.";
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