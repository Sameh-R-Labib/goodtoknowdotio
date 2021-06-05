<?php

namespace GoodToKnow\Controllers;

class CPAccounts
{
    function page()
    {
        global $gtk;
        global $show_poof;


        kick_out_loggedoutusers();


        $gtk->page = 'CPAccounts';


        $show_poof = true;


        $gtk->html_title = 'Accounts';


        $gtk->message .= ' Manage accounts. ';


        require VIEWS . DIRSEP . 'cpaccounts.php';
    }
}