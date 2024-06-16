<?php

// Site Attribs
$AccessLevel = 1;

// Session Functions
include "../includes/session.inc.php";

// User Checks 
if ( validateState() )
{
    if ( validateTimestamp() ) 
    {
        if ( validateAccessLevel($AccessLevel) )
        {

        } else {
            echo "No Permission";
        }
    } else {
        evictUser();
    }

} else {
    evictUser();
}

//Routing  Functions
switch ($_GET["view"]) {
    case 'dashboard':
        include "./views/dashboard.html";
        break;
    case 'pages':
        include "./views/pages.html";
        break;
    case 'posts':
        include "./views/posts.html";
        break;    
    case 'media':
        include "./views/media.html";
        break;
    case 'usermanager':
        include "./views/usermanager.html";
        break;
    default:
        http_response_code(404);
        break;
}

print_r($_SESSION);

?>