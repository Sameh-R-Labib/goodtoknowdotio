<?php

namespace GoodToKnow\Controllers;

class CleanupYearsTaxableIncomeEvents
{
    function page()
    {
        /**
         * Note: It's an admin script.
         */


        global $html_title;


        kick_out_nonadmins();


        $html_title = 'Which year?';


        require VIEWS . DIRSEP . 'cleanupyearstaxableincomeevents.php';
    }
}