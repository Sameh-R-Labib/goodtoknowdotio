<?php

namespace GoodToKnow\Controllers;

class UnsuspendAccount
{
    function page()
    {
        global $gtk;


        kick_out_nonadmins();


        /**
         * Present a form which collects the username.
         */

        $gtk->html_title = "Unsuspend Account";

        require VIEWS . DIRSEP . 'unsuspendaccount.php';
    }
}