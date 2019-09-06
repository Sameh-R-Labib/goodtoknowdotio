<?php

namespace GoodToKnow\Controllers;

class UnsuspendAccount
{
    function page()
    {
        global $sessionMessage;

        kick_out_nonadmins();


        /**
         * Present a form which collects
         * the username.
         */

        $html_title = "Unsuspend Account";

        require VIEWS . DIRSEP . 'unsuspendaccount.php';
    }
}