<?php

namespace GoodToKnow\Controllers;

class CPPostings
{
    function page()
    {
        global $app_state;
        global $page;
        global $html_title;
        global $show_poof;


        kick_out_nonadmins();


        $page = 'CPPostings';


        $show_poof = true;


        $html_title = 'Postings';


        $app_state->message .= ' Manage postings. ';


        require VIEWS . DIRSEP . 'cppostings.php';
    }
}