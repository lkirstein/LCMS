<?php 

    function logInFile($paMsg)
    {
        $ts = "[" . date("Y-m-d") . " - " . date("H:i:s") . "]";
        $msg = $ts . " - " . $paMsg;
        error_log($msg . "\n", 3, "error.log");
    }