<?php

namespace GoodToKnow\Controllers;

class CPAccounts
{
    function page()
    {
        global $sessionMessage;
        global $html_title;
        global $show_poof;
        global $page;


        kick_out_loggedoutusers();


        $page = 'CPAccounts';


        $show_poof = true;


        $html_title = 'Accounts';


        $sessionMessage .= ' Manage accounts. ';


        require VIEWS . DIRSEP . 'cpaccounts.php';
    }
}