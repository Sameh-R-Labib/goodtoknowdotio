<?php

namespace GoodToKnow\Controllers;

class c_p_banking_accounts
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers();


        $g->page = 'c_p_banking_accounts';


        $g->show_poof = true;


        $g->html_title = 'Bank Account';


        $g->message .= ' Manage banking accounts. ';


        require VIEWS . DIRSEP . 'cpbankingaccounts.php';
    }
}