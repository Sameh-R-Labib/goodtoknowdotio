<?php

namespace GoodToKnow\Controllers;

class CPTransactions
{
    function page()
    {
        global $sessionMessage;
        global $special_community_array;
        global $type_of_resource_requested;
        global $is_admin;
        global $is_guest;
        global $show_poof;

        kick_out_loggedoutusers();

        $page = 'CPTransactions';

        $show_poof = true;

        $html_title = 'Transactions';

        $sessionMessage .= ' Manage my copy of my bank transactions. ';

        require VIEWS . DIRSEP . 'cptransactions.php';
    }
}