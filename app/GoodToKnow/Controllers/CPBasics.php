<?php

namespace GoodToKnow\Controllers;

class CPBasics
{
    function page()
    {
        global $gtk;


        kick_out_loggedoutusers();


        $gtk->page = 'CPBasics';


        $gtk->show_poof = true;


        $gtk->html_title = 'Basics';


        $gtk->message .= ' Manage account and posts. ';


        require VIEWS . DIRSEP . 'cpbasics.php';
    }
}