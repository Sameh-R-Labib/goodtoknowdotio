<?php

namespace GoodToKnow\Controllers;

class CPCapitalGains
{
    function page()
    {
        global $gtk;
        global $show_poof;


        kick_out_loggedoutusers();


        $gtk->page = 'CPCapitalGains';


        $show_poof = true;


        $gtk->html_title = 'Capital Gains';


        $gtk->message .= ' Manage capital gains. ';


        require VIEWS . DIRSEP . 'cpcapitalgains.php';
    }
}