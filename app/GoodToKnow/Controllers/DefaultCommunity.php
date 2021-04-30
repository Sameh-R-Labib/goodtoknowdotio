<?php

namespace GoodToKnow\Controllers;

class DefaultCommunity
{
    function page()
    {
        global $html_title;


        kick_out_loggedoutusers();


        $html_title = 'Default Community';


        require VIEWS . DIRSEP . 'defaultcommunity.php';
    }
}