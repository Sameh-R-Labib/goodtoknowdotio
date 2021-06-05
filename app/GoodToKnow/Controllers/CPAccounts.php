<?php

namespace GoodToKnow\Controllers;

class CPAccounts
{
    function page()
    {
        global $app_state;
        global $html_title;
        global $show_poof;


        kick_out_loggedoutusers();


        $app_state->page = 'CPAccounts';


        $show_poof = true;


        $html_title = 'Accounts';


        $app_state->message .= ' Manage accounts. ';


        require VIEWS . DIRSEP . 'cpaccounts.php';
    }
}