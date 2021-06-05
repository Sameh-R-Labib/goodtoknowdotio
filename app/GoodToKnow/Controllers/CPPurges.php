<?php

namespace GoodToKnow\Controllers;

class CPPurges
{
    function page()
    {
        global $app_state;
        global $show_poof;


        kick_out_loggedoutusers();


        $app_state->page = 'CPPurges';


        $show_poof = true;


        $app_state->html_title = 'Purges';


        $app_state->message .= ' Manage purges. ';


        require VIEWS . DIRSEP . 'cppurges.php';
    }
}