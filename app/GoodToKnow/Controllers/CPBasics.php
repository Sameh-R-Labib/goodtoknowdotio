<?php

namespace GoodToKnow\Controllers;

class CPBasics
{
    function page()
    {
        global $gtk;
        global $show_poof;


        kick_out_loggedoutusers();


        $gtk->page = 'CPBasics';


        $show_poof = true;


        $gtk->html_title = 'Basics';


        $gtk->message .= ' Manage account and posts. ';


        require VIEWS . DIRSEP . 'cpbasics.php';
    }
}