<?php

namespace GoodToKnow\Controllers;

class CPBasics
{
    function page()
    {
        global $sessionMessage;
        global $page;
        global $show_poof;
        global $html_title;


        kick_out_loggedoutusers();


        $page = 'CPBasics';


        $show_poof = true;


        $html_title = 'Basics';


        $sessionMessage .= ' Manage account and posts. ';


        require VIEWS . DIRSEP . 'cpbasics.php';
    }
}