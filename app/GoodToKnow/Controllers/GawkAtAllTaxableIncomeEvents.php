<?php

namespace GoodToKnow\Controllers;

class GawkAtAllTaxableIncomeEvents
{
    function page()
    {
        /**
         * This page is going to present a text box for entering a year_received value to be used
         * so that the subsequent code can display the taxable_income_event(s/plural) for that year.
         */

        global $is_logged_in;
        global $sessionMessage;

        if (!$is_logged_in || !empty($sessionMessage)) {
            breakout('');
        }

        $html_title = 'Which year received?';

        require VIEWS . DIRSEP . 'gawkatalltaxableincomeevents.php';
    }
}