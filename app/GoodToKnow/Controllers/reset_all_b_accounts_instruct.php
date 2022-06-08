<?php

namespace GoodToKnow\Controllers;

class reset_all_b_accounts_instruct
{
    function page()
    {
        /**
         * This route of the "Reset All Bank Accounts" feature
         * presents instructions and a submit button so that the
         * user is aware of what's going on.
         */

        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->html_title = "Instructions";


        require VIEWS . DIRSEP . 'resetallbaccountsinstruct.php';
    }
}