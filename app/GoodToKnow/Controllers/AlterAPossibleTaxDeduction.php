<?php


namespace GoodToKnow\Controllers;


class AlterAPossibleTaxDeduction
{
    function page()
    {
        /**
         * This page is going to present a text box
         * for entering a year_paid value to be used
         * to narrow down the choices for which
         * possible_tax_deduction to edit.
         */

        global $is_logged_in;
        global $sessionMessage;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        $html_title = 'Which year_paid for filtering your tax deduction choices?';

        require VIEWS . DIRSEP . 'alterapossibletaxdeduction.php';
    }
}