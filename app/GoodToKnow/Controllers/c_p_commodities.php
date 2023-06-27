<?php

namespace GoodToKnow\Controllers;

class c_p_commodities
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers();


        $g->page = 'c_p_commodities';


        $g->show_poof = true;


        $g->html_title = 'commodity';


        $g->message .= ' Manage commodities. ';


        require VIEWS . DIRSEP . 'cpcommodities.php';
    }
}