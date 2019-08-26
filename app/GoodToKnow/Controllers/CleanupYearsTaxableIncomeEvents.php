<?php

namespace GoodToKnow\Controllers;

class CleanupYearsTaxableIncomeEvents
{
    function page()
    {
        /**
         * Note: It's an admin script.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $is_admin;

        kick_out_nonadmins();

        $html_title = 'Which year?';

        require VIEWS . DIRSEP . 'cleanupyearstaxableincomeevents.php';
    }
}