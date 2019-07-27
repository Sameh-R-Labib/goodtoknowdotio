<?php


namespace GoodToKnow\Controllers;


class LiquidateYearsPossibleTaxDeductions
{
    function page()
    {
        /**
         *
         *
         * Note: It's an admin script.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $is_admin;

        if (!$is_logged_in OR !$is_admin OR !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $html_title = 'Which year of possible_tax_deduction(s/plural) to delete?';

        require VIEWS . DIRSEP . 'liquidateyearspossibletaxdeductions.php';
    }
}