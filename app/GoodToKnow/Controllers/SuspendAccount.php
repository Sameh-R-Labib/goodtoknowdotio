<?php

namespace GoodToKnow\Controllers;

class SuspendAccount
{
    function page()
    {
        global $is_logged_in;
        global $is_admin;
        global $sessionMessage;

        if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
            breakout('');
        }


        /**
         * Collect the username.
         */

        $html_title = "Suspend Account";

        require VIEWS . DIRSEP . 'suspendaccount.php';
    }
}