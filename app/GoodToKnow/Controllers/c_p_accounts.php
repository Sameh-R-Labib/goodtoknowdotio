<?php

namespace GoodToKnow\Controllers;

class c_p_accounts
{
    function page()
    {
        global $g;


        kick_out_nonadmins();


        $g->page = 'c_p_accounts';


        $g->show_poof = true;


        $g->html_title = 'Accounts';


        $g->message .= ' Manage accounts. ';


        require VIEWS . DIRSEP . 'cpaccounts.php';
    }
}