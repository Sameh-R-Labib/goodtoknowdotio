<?php


namespace GoodToKnow\Controllers;


class GawkAtAllTaxableIncomeEvents
{
    function page()
    {
        /**
         * This page is going to present a text box
         * for entering a year_received value to be used
         * so that the subsequent code can display the
         * taxable_income_event(s/plural) for that year.
         */

        global $is_logged_in;
        global $sessionMessage;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $html_title = 'Which year_received for showing taxable_income_event(s/plural)?';

        require VIEWS . DIRSEP . 'gawkatalltaxableincomeevents.php';
    }
}