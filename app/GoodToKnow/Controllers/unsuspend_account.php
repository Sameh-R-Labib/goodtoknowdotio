<?php

namespace GoodToKnow\Controllers;

class unsuspend_account
{
    function page()
    {
        global $g;


        kick_out_nonadmins();


        /**
         * Present a form which collects the username.
         */

        $g->html_title = "Unsuspend Account";

        require VIEWS . DIRSEP . 'unsuspendaccount.php';
    }
}