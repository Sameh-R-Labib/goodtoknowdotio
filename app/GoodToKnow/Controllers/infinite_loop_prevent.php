<?php

namespace GoodToKnow\Controllers;

class infinite_loop_prevent
{
    function page()
    {
        global $g;

        $_SESSION = [];
        session_destroy();

        $g->html_title = 'For Infinite Loop Prevention';


        require VIEWS . DIRSEP . 'infiniteloopprevent.php';
    }
}