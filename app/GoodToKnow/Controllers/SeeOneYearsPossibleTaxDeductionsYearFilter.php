<?php


namespace GoodToKnow\Controllers;


use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use GoodToKnow\Models\PossibleTaxDeduction;


class SeeOneYearsPossibleTaxDeductionsYearFilter
{
    public function page()
    {
        /**
         * 1) Validate the submitted year_paid.
         * 2) Present the PossibleTaxDeduction(s/plural) in a page whose layout is similar to the Home page.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $user_id;
        global $is_admin;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " You've aborted the task! Session variables reset. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         *  1) Validate the submitted year_paid.
         */
        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $year_paid = integer_form_field_prep('year_paid', 1992, 65535);

        if (is_null($year_paid)) {
            $sessionMessage .= " Your year_paid did not pass validation. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 2) Present the PossibleTaxDeduction(s/plural) in a page whose layout is similar to the Home page.
         */
        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $sql = 'SELECT * FROM `possible_tax_deduction` WHERE `year_paid` = ' . $db->real_escape_string($year_paid);
        $sql .= ' AND `user_id` = ' . $db->real_escape_string($user_id);
        $array = PossibleTaxDeduction::find_by_sql($db, $sessionMessage, $sql);
        if (!$array || !empty($sessionMessage)) {
            $sessionMessage .= " 🤔 For <b>{$year_paid}</b> I could NOT find any Possible Tax Deduction for you. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $sessionMessage .= ' Enjoy ʘ‿ʘ at One Year of your 🤔 Tax ✍🏽🔽s. ';

        $html_title = 'Enjoy ʘ‿ʘ at One Year of your your 🤔 Tax ✍🏽🔽s.';

        $page = 'SeeOneYearsPossibleTaxDeductions';

        $show_poof = true;

        require VIEWS . DIRSEP . 'seeoneyearspossibletaxdeductionsyearfilter.php';
    }
}