<?php

namespace GoodToKnow\Controllers;

class c_p_transactions
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers();


        $g->page = 'c_p_transactions';


        $g->show_poof = true;


        $g->html_title = 'Transactions';


        $g->message .= ' Manage my bank transactions. ';


        require VIEWS . DIRSEP . 'cptransactions.php';
    }
}