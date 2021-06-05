<?php

namespace GoodToKnow\Controllers;

class DefaultCommunity
{
    function page()
    {
        global $gtk;


        kick_out_loggedoutusers();


        $gtk->html_title = 'Default Community';


        require VIEWS . DIRSEP . 'defaultcommunity.php';
    }
}