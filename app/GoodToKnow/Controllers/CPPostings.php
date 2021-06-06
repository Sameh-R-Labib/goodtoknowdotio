<?php

namespace GoodToKnow\Controllers;

class CPPostings
{
    function page()
    {
        global $gtk;


        kick_out_nonadmins();


        $gtk->page = 'CPPostings';


        $gtk->show_poof = true;


        $gtk->html_title = 'Postings';


        $gtk->message .= ' Manage postings. ';


        require VIEWS . DIRSEP . 'cppostings.php';
    }
}