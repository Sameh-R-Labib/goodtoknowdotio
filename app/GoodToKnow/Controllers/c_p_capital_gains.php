<?php

namespace GoodToKnow\Controllers;

class c_p_capital_gains
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers();


        $g->page = 'c_p_capital_gains';


        $g->show_poof = true;


        $g->html_title = 'Capital Gains';


        $g->message .= ' Manage capital gains. ';


        require VIEWS . DIRSEP . 'cpcapitalgains.php';
    }
}