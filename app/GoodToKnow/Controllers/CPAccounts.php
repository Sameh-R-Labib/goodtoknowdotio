<?php

namespace GoodToKnow\Controllers;

class CPAccounts
{
    function page()
    {
        global $app_state;
        global $show_poof;


        kick_out_loggedoutusers();


        $app_state->page = 'CPAccounts';


        $show_poof = true;


        $app_state->html_title = 'Accounts';


        $app_state->message .= ' Manage accounts. ';


        require VIEWS . DIRSEP . 'cpaccounts.php';
    }
}