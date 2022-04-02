<?php

namespace GoodToKnow\Controllers;

class suspend_account
{
    function page()
    {
        /**
         * Collect the username.
         */


        global $g;


        kick_out_nonadmins_or_if_there_is_error_msg();


        $g->html_title = "Suspend Account";


        require VIEWS . DIRSEP . 'suspendaccount.php';
    }
}