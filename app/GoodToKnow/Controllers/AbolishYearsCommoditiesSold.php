<?php

namespace GoodToKnow\Controllers;

class AbolishYearsCommoditiesSold
{
    function page()
    {
        /**
         * Note: It's an admin script.
         */

        global $g;

        kick_out_nonadmins();

        $g->html_title = 'Which year?';

        require VIEWS . DIRSEP . 'abolishyearscommoditiessold.php';
    }
}