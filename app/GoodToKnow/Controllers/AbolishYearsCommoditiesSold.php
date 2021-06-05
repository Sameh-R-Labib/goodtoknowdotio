<?php

namespace GoodToKnow\Controllers;

class AbolishYearsCommoditiesSold
{
    function page()
    {
        /**
         * Note: It's an admin script.
         */

        global $app_state;

        kick_out_nonadmins();

        $app_state->html_title = 'Which year?';

        require VIEWS . DIRSEP . 'abolishyearscommoditiessold.php';
    }
}