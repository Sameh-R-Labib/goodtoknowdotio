<?php

namespace GoodToKnow\Controllers;

class CPPurges
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg_or_if_there_is_error_msg();


        $g->page = 'CPPurges';


        $g->show_poof = true;


        $g->html_title = 'Purges';


        $g->message .= ' Manage purges. ';


        require VIEWS . DIRSEP . 'cppurges.php';
    }
}