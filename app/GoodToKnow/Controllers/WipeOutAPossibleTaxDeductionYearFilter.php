<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use GoodToKnow\Models\PossibleTaxDeduction;

class WipeOutAPossibleTaxDeductionYearFilter
{
    function page()
    {
        /**
         * 1) Validate the submitted year_paid.
         * 2) Present the PossibleTaxDeduction(s/plural) which fall in that year as radio buttons.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $user_id;

        if (!$is_logged_in || !empty($sessionMessage)) {
            breakout('');
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            breakout(' Task aborted. ');
        }


        /**
         *  1) Validate the submitted year_paid.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $year_paid = integer_form_field_prep('year_paid', 1992, 65535);

        if (is_null($year_paid)) {
            breakout(' Your year paid did not pass validation. ');
        }


        /**
         * 2) Present the PossibleTaxDeduction(s/plural) which fall in that year as radio buttons.
         */

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            breakout(' Database connection failed. ');
        }

        $sql = 'SELECT * FROM `possible_tax_deduction` WHERE `year_paid` = ' . $db->real_escape_string($year_paid);
        $sql .= ' AND `user_id` = ' . $db->real_escape_string($user_id);

        $array = PossibleTaxDeduction::find_by_sql($db, $sessionMessage, $sql);

        if (!$array || !empty($sessionMessage)) {
            breakout(" For <b>{$year_paid}</b> I could NOT find any Possible Tax Deductions. ");
        }

        $html_title = 'Which possible_tax_deduction record?';

        require VIEWS . DIRSEP . 'wipeoutapossibletaxdeductionyearfilter.php';
    }
}