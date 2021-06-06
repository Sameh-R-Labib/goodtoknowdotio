<?php

namespace GoodToKnow\Controllers;

class CPPurges
{
    function page()
    {
        global $gtk;


        kick_out_loggedoutusers();


        $gtk->page = 'CPPurges';


        $gtk->show_poof = true;


        $gtk->html_title = 'Purges';


        $gtk->message .= ' Manage purges. ';


        require VIEWS . DIRSEP . 'cppurges.php';
    }
}