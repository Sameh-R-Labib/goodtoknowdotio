<?php

namespace GoodToKnow\Controllers;

class SuspendAccount
{
    function page()
    {
        /**
         * Collect the username.
         */


        global $html_title;


        kick_out_nonadmins();


        $html_title = "Suspend Account";


        require VIEWS . DIRSEP . 'suspendaccount.php';
    }
}