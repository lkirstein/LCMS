<?php

    // Sessins is Calculated Minutes * Seconds
    $Session_Duration = (5 * 60);

    function destroySession() {
        // Destroy session.
        session_destroy();
        exit;
    }

    function doRedirect($location) {
        // Redirect user to specified path.
        header("location: " . $location);
        exit;
    }

    function setSessionTimestamp() {
        // Set new time for session
        $_SESSION["timestamp"] = time();
    }

    function checkSessionTimestamp($duration) {
        // Check if the session timestamp has ben set.
        if( isset($_SESSION['timestamp']) )
        {
            // Subtract the session time (current time - time from session) from the allowed duration. 
            $time = ($duration - (time() - $_SESSION['timestamp']));

            // If the session time is smaller or equal to 0, the user will be logged out.
            if($time <= 0)
            {
                return false;
            }
            else
            {
                return true;
            }
        }
        else
        {
            // Handle no session time stamp (Redirect to login, so user can log in again and get a new timestamp)
            doRedirect("./login.php");
        }
    }

    // Checks if the Access Level of the user is equal to the reqired (passed) value.
    function checkSessionAccessLevel($requiredLevel) {
        // Check if the access level is set
        if ( isset($_SESSION["User_AccessLevel"]) )
        {
            if ( $_SESSION["User_AccessLevel"] == $requiredLevel)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            // Handle no access level (Redirect to login, so user can log in to set the level again)
            doRedirect("./login.php");
        }
    }

?>