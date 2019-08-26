<?php

namespace GoodToKnow\Controllers;

class LiquidateYearsPossibleTaxDeductions
{
    function page()
    {
        /**
         * Admin script.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $is_admin;

        kick_out_nonadmins();

        $html_title = 'Which year?';

        require VIEWS . DIRSEP . 'liquidateyearspossibletaxdeductions.php';
    }
}