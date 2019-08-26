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

        if (!$is_logged_in OR !$is_admin OR !empty($sessionMessage)) {
            breakout('');
        }

        $html_title = 'Which year?';

        require VIEWS . DIRSEP . 'liquidateyearspossibletaxdeductions.php';
    }
}