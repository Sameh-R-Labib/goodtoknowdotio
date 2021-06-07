<?php

namespace GoodToKnow\Controllers;

class CPBankingAccounts
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers();


        $g->page = 'CPBankingAccounts';


        $g->show_poof = true;


        $g->html_title = 'CRUD For Bank Accounts And Their Starting Balances';


        $g->message .= ' Manage banking accounts. ';


        require VIEWS . DIRSEP . 'cpbankingaccounts.php';
    }
}