<?php


namespace GoodToKnow\Controllers;


class NukeATaxableIncomeEvent
{
    function page()
    {
        /**
         * Ultimately, this is about deleting a TaxableIncomeEvent.
         *
         * This page is going to present a text box
         * for entering a year_received value to be used
         * to narrow down the choices for which
         * taxable_income_event to delete.
         */

        global $is_logged_in;
        global $sessionMessage;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $html_title = 'Which year_received for filtering your taxable income event choices?';

        require VIEWS . DIRSEP . 'nukeataxableincomeevent.php';
    }
}