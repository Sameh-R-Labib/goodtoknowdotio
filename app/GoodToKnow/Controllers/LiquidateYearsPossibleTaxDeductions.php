<?php

namespace GoodToKnow\Controllers;

class LiquidateYearsPossibleTaxDeductions
{
    function page()
    {
        /**
         * Admin script.
         */

        global $sessionMessage;
        global $html_title;

        kick_out_nonadmins();

        $html_title = 'Which year?';

        require VIEWS . DIRSEP . 'liquidateyearspossibletaxdeductions.php';
    }
}