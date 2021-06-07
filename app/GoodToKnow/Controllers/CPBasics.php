<?php

namespace GoodToKnow\Controllers;

class CPBasics
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers();


        $g->page = 'CPBasics';


        $g->show_poof = true;


        $g->html_title = 'Basics';


        $g->message .= ' Manage account and posts. ';


        require VIEWS . DIRSEP . 'cpbasics.php';
    }
}