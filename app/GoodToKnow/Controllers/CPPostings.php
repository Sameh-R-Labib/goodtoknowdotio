<?php

namespace GoodToKnow\Controllers;

class CPPostings
{
    function page()
    {
        global $g;


        kick_out_nonadmins_or_if_there_is_error_msg();


        $g->page = 'CPPostings';


        $g->show_poof = true;


        $g->html_title = 'Postings';


        $g->message .= ' Manage postings. ';


        require VIEWS . DIRSEP . 'cppostings.php';
    }
}