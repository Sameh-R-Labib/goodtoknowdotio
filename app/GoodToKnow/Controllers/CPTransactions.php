<?php

namespace GoodToKnow\Controllers;

class CPTransactions
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers();


        $g->page = 'CPTransactions';


        $g->show_poof = true;


        $g->html_title = 'Transactions';


        $g->message .= ' Manage my copy of my bank transactions. ';


        require VIEWS . DIRSEP . 'cptransactions.php';
    }
}