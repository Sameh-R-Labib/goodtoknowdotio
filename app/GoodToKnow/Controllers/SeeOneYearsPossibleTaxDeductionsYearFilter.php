<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use GoodToKnow\Models\PossibleTaxDeduction;

class SeeOneYearsPossibleTaxDeductionsYearFilter
{
    function page()
    {
        /**
         * 1) Validate the submitted year_paid.
         * 2) Present the PossibleTaxDeduction(s/plural) in a page whose layout is similar to the Home page.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $user_id;
        global $is_admin;
        global $special_community_array;
        global $type_of_resource_requested;

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
         * 2) Present the PossibleTaxDeduction(s/plural) in a page whose layout is similar to the Home page.
         */

        $db = get_db();

        $sql = 'SELECT * FROM `possible_tax_deduction` WHERE `year_paid` = ' . $db->real_escape_string($year_paid);
        $sql .= ' AND `user_id` = ' . $db->real_escape_string($user_id);

        $array = PossibleTaxDeduction::find_by_sql($db, $sessionMessage, $sql);

        if (!$array || !empty($sessionMessage)) {
            breakout(" For <b>{$year_paid}</b> I could NOT find any Possible Tax Deduction. ");
        }


        /**
         * Loop through the array and replace attributes with more readable ones.
         */

        foreach ($array as $item) {
            $item->comment = nl2br($item->comment, false);
        }

        $sessionMessage .= ' Enjoy ʘ‿ʘ at One Year of your 🤔 Tax ✍🏽🔽s. ';

        $html_title = 'Enjoy ʘ‿ʘ at One Year of your 🤔 Tax ✍🏽🔽s.';

        $page = 'SeeOneYearsPossibleTaxDeductions';

        $show_poof = true;

        require VIEWS . DIRSEP . 'seeoneyearspossibletaxdeductionsyearfilter.php';
    }
}