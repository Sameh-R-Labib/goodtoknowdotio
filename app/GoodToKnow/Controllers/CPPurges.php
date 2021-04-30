<?php

namespace GoodToKnow\Controllers;

class CPPurges
{
    function page()
    {
        global $sessionMessage;
        global $page;
        global $show_poof;
        global $html_title;


        kick_out_loggedoutusers();


        $page = 'CPPurges';


        $show_poof = true;


        $html_title = 'Purges';


        $sessionMessage .= ' Manage purges. ';


        require VIEWS . DIRSEP . 'cppurges.php';
    }
}