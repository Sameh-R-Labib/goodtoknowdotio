<?php

namespace GoodToKnow\Controllers;

class InfiniteLoopPrevent
{
    function page()
    {
        global $g;


        $g->html_title = 'For Infinite Loop Prevention';


        require VIEWS . DIRSEP . 'infiniteloopprevent.php';
    }
}