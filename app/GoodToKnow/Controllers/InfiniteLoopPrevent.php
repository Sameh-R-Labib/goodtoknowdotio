<?php

namespace GoodToKnow\Controllers;

class InfiniteLoopPrevent
{
    function page()
    {
        global $app_state;


        $app_state->html_title = 'For Infinite Loop Prevention';


        require VIEWS . DIRSEP . 'infiniteloopprevent.php';
    }
}