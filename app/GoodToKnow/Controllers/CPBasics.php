<?php

namespace GoodToKnow\Controllers;

class CPBasics
{
    function page()
    {
        global $app_state;
        global $page;
        global $show_poof;
        global $html_title;


        kick_out_loggedoutusers();


        $page = 'CPBasics';


        $show_poof = true;


        $html_title = 'Basics';


        $app_state->message .= ' Manage account and posts. ';


        require VIEWS . DIRSEP . 'cpbasics.php';
    }
}