<?php

namespace GoodToKnow\Controllers;

class CleanupYearsTaxableIncomeEvents
{
    function page()
    {
        /**
         * Note: It's an admin script.
         */


        global $gtk;


        kick_out_nonadmins();


        $gtk->html_title = 'Which year?';


        require VIEWS . DIRSEP . 'cleanupyearstaxableincomeevents.php';
    }
}