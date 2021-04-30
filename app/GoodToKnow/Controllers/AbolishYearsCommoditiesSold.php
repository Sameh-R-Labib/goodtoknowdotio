<?php

namespace GoodToKnow\Controllers;

class AbolishYearsCommoditiesSold
{
    function page()
    {
        /**
         * Note: It's an admin script.
         */

        global $html_title;

        kick_out_nonadmins();

        $html_title = 'Which year?';

        require VIEWS . DIRSEP . 'abolishyearscommoditiessold.php';
    }
}