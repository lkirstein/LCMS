<?php

    session_start();

    function validateState()
    {
        if( isset( $_SESSION["Ses_State"] ) || $_SESSION["Ses_State"] == true)
        {
            $return_value = true;
        }
        else 
        {
            $return_value = false;
        }

        return $return_value;

    }

    function setTimestamp() {
        $_SESSION["timestamp"] = time();
    }

    function validateTimestamp() {

        // -- SESSION DURATION --
        // (Minutes * Seconds)
        $sessionDuration = (120 * 60);

        $time = ($sessionDuration - (time() - $_SESSION['timestamp']));

        // If the session time is smaller or equal to 0, the user will be logged out.
        if($time <= 0)
        {
            $return_value = false;
        }
        else
        {
            $return_value = true;
        }

        return $return_value;

    }

    function validateAccessLevel($requiredLevel) {
        
        if ( $_SESSION["User_AccessLevel"] >= $requiredLevel)
        {
            $return_value = true;
        }
        else
        {
            $return_value = false;
        }

        return $return_value;

    }

    function evictUser() {

        // Empty Session
        $_SESSION = array();

        // Remove Session
        session_destroy();

        // Redirect
        header("location: ../index.php");

        // End Script
        die;
    }

    function admitUser() {

        // Redirect
        header("location: ./sys/index.php?view=dashboard");

        // End Script
        die;
    }

?>