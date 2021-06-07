<?php

namespace GoodToKnow\Controllers;

class CleanupYearsTaxableIncomeEvents
{
    function page()
    {
        /**
         * Note: It's an admin script.
         */


        global $g;


        kick_out_nonadmins();


        $g->html_title = 'Which year?';


        require VIEWS . DIRSEP . 'cleanupyearstaxableincomeevents.php';
    }
}