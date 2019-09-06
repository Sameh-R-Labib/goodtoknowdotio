<?php

namespace GoodToKnow\Controllers;

class SuspendAccount
{
    function page()
    {
        global $sessionMessage;

        kick_out_nonadmins();


        /**
         * Collect the username.
         */

        $html_title = "Suspend Account";

        require VIEWS . DIRSEP . 'suspendaccount.php';
    }
}