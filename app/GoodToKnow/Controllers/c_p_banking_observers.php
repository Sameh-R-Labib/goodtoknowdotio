<?php

namespace GoodToKnow\Controllers;

class c_p_banking_observers
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers();


        $g->page = 'c_p_banking_observers';


        $g->show_poof = true;


        $g->html_title = 'Bank Observer';


        $g->message .= ' Manage banking observers. ';


        require VIEWS . DIRSEP . 'cpbankingobservers.php';
    }
}