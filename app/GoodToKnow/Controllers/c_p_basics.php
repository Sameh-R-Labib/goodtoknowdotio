<?php

namespace GoodToKnow\Controllers;

class c_p_basics
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers();


        $g->page = 'c_p_basics';


        $g->show_poof = true;


        $g->html_title = 'Basics';


        $g->message .= ' Manage account and posts. ';


        require VIEWS . DIRSEP . 'cpbasics.php';
    }
}