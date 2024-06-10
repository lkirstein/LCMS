<?php

    //Log to JavaScript / Browser Console
    function log($data) {

        $output = $data;

        if ( is_array($output) )
        {
            $output = implode(',', $output);
        }

        echo "<script>console.log('PHP: " . $output . "' );</script>";
    }

?>