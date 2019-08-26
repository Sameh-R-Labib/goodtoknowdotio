<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\TaxableIncomeEvent;
use function GoodToKnow\ControllerHelpers\get_readable_time;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use function GoodToKnow\ControllerHelpers\readable_amount_of_money;

class GawkAtAllTaxableIncomeEventsYearFilter
{
    function page()
    {
        /**
         * 1) Validate the submitted year_paid.
         * 2) Present the TaxableIncomeEvent(s/plural) in a page whose layout is similar to the Home page.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $user_id;
        global $is_admin;
        global $special_community_array;
        global $type_of_resource_requested;

        kick_out_loggedoutusers();

        kick_out_onabort();


        /**
         * 1) Validate the submitted year_received.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $year_received = integer_form_field_prep('year_received', 1992, 65535);

        if (is_null($year_received)) {
            breakout(' Your year received did not pass validation. ');
        }


        /**
         * 2) Present the TaxableIncomeEvent(s/plural) in a page whose layout is similar to the Home page.
         */

        $db = get_db();

        $sql = 'SELECT * FROM `taxable_income_event` WHERE `year_received` = ' . $db->real_escape_string($year_received);

        $sql .= ' AND `user_id` = ' . $db->real_escape_string($user_id);

        $array = TaxableIncomeEvent::find_by_sql($db, $sessionMessage, $sql);

        if (!$array || !empty($sessionMessage)) {
            breakout(" For <b>{$year_received}</b> there are <b>no</b> Taxable Income Events. ");
        }


        /**
         * Loop through the array and replace attributes with more readable ones.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';

        require_once CONTROLLERHELPERS . DIRSEP . 'readable_amount_of_money.php';

        foreach ($array as $item) {
            $item->time = get_readable_time($item->time);
            $item->comment = nl2br($item->comment, false);
            $item->amount = readable_amount_of_money($item->currency, $item->amount);
        }

        $sessionMessage .= ' Enjoy ʘ‿ʘ at One Year of your Taxable 💸 Event 📽s. ';

        $html_title = 'Enjoy ʘ‿ʘ at One Year of your Taxable 💸 Event 📽s.';

        $page = 'GawkAtAllTaxableIncomeEvents';

        $show_poof = true;

        require VIEWS . DIRSEP . 'gawkatalltaxableincomeeventsyearfilter.php';
    }
}