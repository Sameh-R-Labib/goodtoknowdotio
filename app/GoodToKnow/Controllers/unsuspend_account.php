<?php

namespace GoodToKnow\Controllers;

class unsuspend_account
{
    function page()
    {
        global $g;


        kick_out_nonadmins_or_if_there_is_error_msg();


        /**
         * Present a form which collects the username.
         */

        $g->html_title = "Unsuspend Account";

        require VIEWS . DIRSEP . 'unsuspendaccount.php';
    }
}