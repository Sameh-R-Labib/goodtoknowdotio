<?php

namespace GoodToKnow\Controllers;

class c_p_server
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers();


        $g->page = 'c_p_server';


        $g->show_poof = true;


        $g->html_title = 'Server';


        $g->message .= ' Monitoring and affecting server operations. ';


        require VIEWS . DIRSEP . 'cpserver.php';
    }
}