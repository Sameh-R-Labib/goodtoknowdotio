<?php


namespace GoodToKnow\Controllers;


class CleanupYearsTaxableIncomeEvents
{
    function page()
    {
        /**
         * Note: It's an admin script.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $is_admin;

        if (!$is_logged_in OR !$is_admin OR !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        $html_title = 'Which year of taxable_income_event(s/plural) to delete?';

        require VIEWS . DIRSEP . 'cleanupyearstaxableincomeevents.php';
    }
}