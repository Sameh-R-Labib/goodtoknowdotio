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


        kick_out_nonadmins();


        $g->html_title = "Suspend Account";


        require VIEWS . DIRSEP . 'suspendaccount.php';
    }
}