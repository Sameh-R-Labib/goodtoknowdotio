<?php

namespace GoodToKnow\Controllers;

class CPCommodities
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->page = 'CPCommodities';


        $g->show_poof = true;


        $g->html_title = 'Commodity';


        $g->message .= ' Manage commodities. ';


        require VIEWS . DIRSEP . 'cpcommodities.php';
    }
}