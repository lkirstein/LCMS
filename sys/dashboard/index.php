<?php

include ($_SERVER["DOCUMENT_ROOT"]."/sys/sesconf.php");

// Initialize the session
session_start();
 
// Check if the "active" variable exists or if it isn't true
if( !isset( $_SESSION["active"] ) || $_SESSION["active"] !== true)
{
    // Redirect to login page
    doRedirect("./../login.php");
    exit;
}
// Session exists
else 
{
    if ( !checkSessionTimestamp($Session_Duration) )
    {
        destroySession();
    }
}

print_r($_SESSION);

?>

<a href="logout.php">Logout</a>