<?php

namespace GoodToKnow\Controllers;

class CPTransactions
{
    function page()
    {
        global $gtk;


        kick_out_loggedoutusers();


        $gtk->page = 'CPTransactions';


        $gtk->show_poof = true;


        $gtk->html_title = 'Transactions';


        $gtk->message .= ' Manage my copy of my bank transactions. ';


        require VIEWS . DIRSEP . 'cptransactions.php';
    }
}