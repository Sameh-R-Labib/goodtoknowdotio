<?php

namespace GoodToKnow\Controllers;

class CPBankingAccounts
{
    function page()
    {
        global $sessionMessage;
        global $page;
        global $show_poof;
        global $html_title;


        kick_out_loggedoutusers();


        $page = 'CPBankingAccounts';


        $show_poof = true;


        $html_title = 'CRUD For Bank Accounts And Their Starting Balances';


        $sessionMessage .= ' Manage banking accounts. ';


        require VIEWS . DIRSEP . 'cpbankingaccounts.php';
    }
}