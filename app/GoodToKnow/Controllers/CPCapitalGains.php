<?php

namespace GoodToKnow\Controllers;

class CPCapitalGains
{
    function page()
    {
        global $app_state;
        global $page;
        global $show_poof;
        global $html_title;


        kick_out_loggedoutusers();


        $page = 'CPCapitalGains';


        $show_poof = true;


        $html_title = 'Capital Gains';


        $app_state->message .= ' Manage capital gains. ';


        require VIEWS . DIRSEP . 'cpcapitalgains.php';
    }
}