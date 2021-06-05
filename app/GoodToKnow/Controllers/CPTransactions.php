<?php

namespace GoodToKnow\Controllers;

class CPTransactions
{
    function page()
    {
        global $app_state;
        global $show_poof;


        kick_out_loggedoutusers();


        $app_state->page = 'CPTransactions';


        $show_poof = true;


        $app_state->html_title = 'Transactions';


        $app_state->message .= ' Manage my copy of my bank transactions. ';


        require VIEWS . DIRSEP . 'cptransactions.php';
    }
}