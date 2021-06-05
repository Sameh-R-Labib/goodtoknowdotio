<?php

namespace GoodToKnow\Controllers;

class AbolishYearsCommoditiesSold
{
    function page()
    {
        /**
         * Note: It's an admin script.
         */

        global $gtk;

        kick_out_nonadmins();

        $gtk->html_title = 'Which year?';

        require VIEWS . DIRSEP . 'abolishyearscommoditiessold.php';
    }
}