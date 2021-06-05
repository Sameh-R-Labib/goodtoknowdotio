<?php

namespace GoodToKnow\Controllers;

class DefaultCommunity
{
    function page()
    {
        global $app_state;


        kick_out_loggedoutusers();


        $app_state->html_title = 'Default Community';


        require VIEWS . DIRSEP . 'defaultcommunity.php';
    }
}