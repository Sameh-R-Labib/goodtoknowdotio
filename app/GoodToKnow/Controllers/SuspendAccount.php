<?php

namespace GoodToKnow\Controllers;

class SuspendAccount
{
    function page()
    {
        /**
         * Collect the username.
         */


        global $gtk;


        kick_out_nonadmins();


        $gtk->html_title = "Suspend Account";


        require VIEWS . DIRSEP . 'suspendaccount.php';
    }
}