<?php

namespace GoodToKnow\Controllers;

class CPCapitalGains
{
    function page()
    {
        global $gtk;


        kick_out_loggedoutusers();


        $gtk->page = 'CPCapitalGains';


        $gtk->show_poof = true;


        $gtk->html_title = 'Capital Gains';


        $gtk->message .= ' Manage capital gains. ';


        require VIEWS . DIRSEP . 'cpcapitalgains.php';
    }
}