<?php

namespace GoodToKnow\Controllers;

class DefaultCommunity
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers();


        $g->html_title = 'Default Community';


        require VIEWS . DIRSEP . 'defaultcommunity.php';
    }
}