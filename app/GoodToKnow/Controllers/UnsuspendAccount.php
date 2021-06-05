<?php

namespace GoodToKnow\Controllers;

class UnsuspendAccount
{
    function page()
    {
        global $app_state;


        kick_out_nonadmins();


        /**
         * Present a form which collects the username.
         */

        $app_state->html_title = "Unsuspend Account";

        require VIEWS . DIRSEP . 'unsuspendaccount.php';
    }
}