<?php

namespace GoodToKnow\Controllers;

class CPBasics
{
    function page()
    {
        global $app_state;
        global $show_poof;


        kick_out_loggedoutusers();


        $app_state->page = 'CPBasics';


        $show_poof = true;


        $app_state->html_title = 'Basics';


        $app_state->message .= ' Manage account and posts. ';


        require VIEWS . DIRSEP . 'cpbasics.php';
    }
}