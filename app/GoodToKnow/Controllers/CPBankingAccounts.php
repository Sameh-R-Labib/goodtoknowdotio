<?php

namespace GoodToKnow\Controllers;

class CPBankingAccounts
{
    function page()
    {
        global $sessionMessage;
        global $special_community_array;
        global $type_of_resource_requested;
        global $is_admin;
        global $is_guest;

        kick_out_loggedoutusers();

        $page = 'CPBankingAccounts';

        $show_poof = true;

        $html_title = 'Banking Accounts';

        $sessionMessage .= ' Managing your banking accounts. ';

        require VIEWS . DIRSEP . 'cpbankingaccounts.php';
    }
}