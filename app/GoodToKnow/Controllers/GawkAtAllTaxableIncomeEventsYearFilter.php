<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\get_readable_time;
use function GoodToKnow\ControllerHelpers\readable_amount_of_money;

class GawkAtAllTaxableIncomeEventsYearFilter
{
    function page()
    {
        /**
         * 1) Validate the submitted year_paid.
         * 2) Present the TaxableIncomeEvent(s/plural) in a page whose layout is similar to the Home page.
         */


        global $app_state;
        global $show_poof;
        global $array;


        require CONTROLLERINCLUDES . DIRSEP . 'get_taxable_income_events_for_year.php';


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


        $app_state->message .= " Here is one year of your taxable income event records. ";


        $app_state->html_title = "One year of your taxable income event records";


        $app_state->page = 'GawkAtAllTaxableIncomeEvents';


        $show_poof = true;


        require VIEWS . DIRSEP . 'gawkatalltaxableincomeeventsyearfilter.php';
    }
}