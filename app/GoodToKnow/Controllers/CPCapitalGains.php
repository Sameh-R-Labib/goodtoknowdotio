<?php

namespace GoodToKnow\Controllers;

class CPCapitalGains
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->page = 'CPCapitalGains';


        $g->show_poof = true;


        $g->html_title = 'Capital Gains';


        $g->message .= ' Manage capital gains. ';


        require VIEWS . DIRSEP . 'cpcapitalgains.php';
    }
}