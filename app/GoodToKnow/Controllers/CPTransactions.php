<?php

namespace GoodToKnow\Controllers;

class CPTransactions
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->page = 'CPTransactions';


        $g->show_poof = true;


        $g->html_title = 'Transactions';


        $g->message .= ' Manage my bank transactions. ';


        require VIEWS . DIRSEP . 'cptransactions.php';
    }
}