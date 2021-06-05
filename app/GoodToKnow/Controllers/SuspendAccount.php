<?php

namespace GoodToKnow\Controllers;

class SuspendAccount
{
    function page()
    {
        /**
         * Collect the username.
         */


        global $app_state;


        kick_out_nonadmins();


        $app_state->html_title = "Suspend Account";


        require VIEWS . DIRSEP . 'suspendaccount.php';
    }
}