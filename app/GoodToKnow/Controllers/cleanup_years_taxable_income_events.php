<?php

namespace GoodToKnow\Controllers;

class cleanup_years_taxable_income_events
{
    function page()
    {
        /**
         * Note: It's an Admin script.
         */


        global $g;


        kick_out_nonadmins();


        $g->html_title = 'Which year?';


        require VIEWS . DIRSEP . 'cleanupyearstaxableincomeevents.php';
    }
}