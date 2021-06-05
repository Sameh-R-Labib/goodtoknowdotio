<?php

namespace GoodToKnow\Controllers;

class CPCapitalGains
{
    function page()
    {
        global $app_state;
        global $show_poof;
        global $html_title;


        kick_out_loggedoutusers();


        $app_state->page = 'CPCapitalGains';


        $show_poof = true;


        $html_title = 'Capital Gains';


        $app_state->message .= ' Manage capital gains. ';


        require VIEWS . DIRSEP . 'cpcapitalgains.php';
    }
}