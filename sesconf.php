<?php

    // Sessins is Calculated Minutes * Seconds
    $Session_Duration = (5 * 60);

    function setNewTimeStamp() {

        // Set new time for session
        $_SESSION["timestamp"] = time();
        
    }

?>