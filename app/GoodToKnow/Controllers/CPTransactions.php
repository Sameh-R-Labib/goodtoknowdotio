<?php

namespace GoodToKnow\Controllers;

class CPTransactions
{
    function page()
    {
        global $app_state;
        global $page;
        global $show_poof;
        global $html_title;


        kick_out_loggedoutusers();


        $page = 'CPTransactions';


        $show_poof = true;


        $html_title = 'Transactions';


        $app_state->message .= ' Manage my copy of my bank transactions. ';


        require VIEWS . DIRSEP . 'cptransactions.php';
    }
}