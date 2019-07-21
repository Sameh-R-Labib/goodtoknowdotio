<?php


namespace GoodToKnow\Controllers;


class LiquidateYearsPossibleTaxDeductionsGetYear
{
    public function page()
    {
        /**
         * 1) Validate the submitted year_paid.
         * 2) Delete the possible_tax_deduction which have the specified year_paid.
         * 3) Give confirmation of deletion.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $is_admin;

        if (!$is_logged_in OR !$is_admin OR !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }
    }
}