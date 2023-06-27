<?php

namespace GoodToKnow\Controllers;

class c_p_postings
{
    function page()
    {
        global $g;


        kick_out_nonadmins();


        $g->page = 'c_p_postings';


        $g->show_poof = true;


        $g->html_title = 'Postings';


        $g->message .= ' Manage postings. ';


        require VIEWS . DIRSEP . 'cppostings.php';
    }
}