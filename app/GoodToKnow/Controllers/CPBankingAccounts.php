<?php

namespace GoodToKnow\Controllers;

class CPBankingAccounts
{
    function page()
    {
        global $gtk;


        kick_out_loggedoutusers();


        $gtk->page = 'CPBankingAccounts';


        $gtk->show_poof = true;


        $gtk->html_title = 'CRUD For Bank Accounts And Their Starting Balances';


        $gtk->message .= ' Manage banking accounts. ';


        require VIEWS . DIRSEP . 'cpbankingaccounts.php';
    }
}