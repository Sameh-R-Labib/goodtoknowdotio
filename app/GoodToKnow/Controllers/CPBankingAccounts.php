<?php

namespace GoodToKnow\Controllers;

class CPBankingAccounts
{
    function page()
    {
        global $gtk;
        global $show_poof;


        kick_out_loggedoutusers();


        $gtk->page = 'CPBankingAccounts';


        $show_poof = true;


        $gtk->html_title = 'CRUD For Bank Accounts And Their Starting Balances';


        $gtk->message .= ' Manage banking accounts. ';


        require VIEWS . DIRSEP . 'cpbankingaccounts.php';
    }
}