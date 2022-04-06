<?php

namespace GoodToKnow\Controllers;

class infinite_loop_prevent
{
    function page()
    {
        global $g;

        // Destroying the session is helpful when the developer makes
        // changes to the code which trap a logged-in user.
        $_SESSION = [];
        session_destroy();

        $g->html_title = 'For Infinite Loop Prevention';


        require VIEWS . DIRSEP . 'infiniteloopprevent.php';
    }
}