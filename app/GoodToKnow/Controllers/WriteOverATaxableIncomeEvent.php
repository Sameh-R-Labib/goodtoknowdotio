<?php


namespace GoodToKnow\Controllers;


class WriteOverATaxableIncomeEvent
{
    function page()
    {
        /**
         * This page is going to present a text box for entering a year_received value to be used
         * to narrow down the choices for which taxable_income_event to edit.
         */

        global $is_logged_in;
        global $sessionMessage;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        $html_title = 'Which year received for filtering taxable income event choices?';

        require VIEWS . DIRSEP . 'writeoverataxableincomeevent.php';
    }
}