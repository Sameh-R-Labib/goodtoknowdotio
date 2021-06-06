<?php

namespace GoodToKnow\Controllers;

class CPAccounts
{
    function page()
    {
        global $gtk;


        kick_out_loggedoutusers();


        $gtk->page = 'CPAccounts';


        $gtk->show_poof = true;


        $gtk->html_title = 'Accounts';


        $gtk->message .= ' Manage accounts. ';


        require VIEWS . DIRSEP . 'cpaccounts.php';
    }
}