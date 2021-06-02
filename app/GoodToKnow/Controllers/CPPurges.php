<?php

namespace GoodToKnow\Controllers;

class CPPurges
{
    function page()
    {
        global $app_state;
        global $page;
        global $show_poof;
        global $html_title;


        kick_out_loggedoutusers();


        $page = 'CPPurges';


        $show_poof = true;


        $html_title = 'Purges';


        $app_state->message .= ' Manage purges. ';


        require VIEWS . DIRSEP . 'cppurges.php';
    }
}