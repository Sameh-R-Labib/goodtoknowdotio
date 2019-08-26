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

        if (!$is_logged_in OR !$is_admin OR !empty($sessionMessage)) {
            breakout('');
        }

        $html_title = 'Which year?';

        require VIEWS . DIRSEP . 'cleanupyearstaxableincomeevents.php';
    }
}