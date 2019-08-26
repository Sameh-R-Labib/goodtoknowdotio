<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\TaxableIncomeEvent;
use function GoodToKnow\ControllerHelpers\get_readable_time;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;

class WriteOverATaxableIncomeEventYearFilter
{
    function page()
    {
        /**
         * 1) Validate the submitted year_received.
         * 2) Present the TaxableIncomeEvent(s/plural) which fall in that year as radio buttons.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $user_id;

        kick_out_loggedoutusers();

        kick_out_onabort();


        /**
         * 1) Validate the submitted year_received.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $year_received = integer_form_field_prep('year_received', 1992, 65535);

        if (is_null($year_received)) {
            breakout(' Year received did not pass validation. ');
        }


        /**
         * 2) Present the TaxableIncomeEvent(s/plural) which fall in that year as radio buttons.
         */

        $db = get_db();

        $sql = 'SELECT * FROM `taxable_income_event` WHERE `year_received` = ' . $db->real_escape_string($year_received);
        $sql .= ' AND `user_id` = ' . $db->real_escape_string($user_id);

        $array = TaxableIncomeEvent::find_by_sql($db, $sessionMessage, $sql);

        if (!$array || !empty($sessionMessage)) {
            breakout(" For <b>{$year_received}</b> I could NOT find any Taxable Income Events. ");
        }


        /**
         * Loop through the array and replace time attributes with a more readable time format.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';

        foreach ($array as $item) {
            $item->time = get_readable_time($item->time);
        }

        $html_title = 'Which taxable income event?';

        require VIEWS . DIRSEP . 'writeoverataxableincomeeventyearfilter.php';
    }
}