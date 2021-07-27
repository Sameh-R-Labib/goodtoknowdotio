<?php

namespace GoodToKnow\Controllers;

class CPAccounts
{
    function page()
    {
        global $g;


        kick_out_nonadmins();


        $g->page = 'CPAccounts';


        $g->show_poof = true;


        $g->html_title = 'Accounts';


        $g->message .= ' Manage accounts. ';


        require VIEWS . DIRSEP . 'cpaccounts.php';
    }
}