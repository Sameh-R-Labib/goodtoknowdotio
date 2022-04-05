<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\get_readable_time;
use function GoodToKnow\ControllerHelpers\readable_amount_of_money;

class gawk_at_all_taxable_income_events_year_filter
{
    function page()
    {
        /**
         * 1) Validate the submitted year_paid.
         * 2) Present the taxable_income_event(s/plural) in a page whose layout is similar to the home page.
         */


        global $g;


        kick_out_loggedoutusers();


        get_db();


        require CONTROLLERINCLUDES . DIRSEP . 'get_taxable_income_events_for_year.php';


        /**
         * Loop through the array and replace attributes with more readable ones.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';

        require_once CONTROLLERHELPERS . DIRSEP . 'readable_amount_of_money.php';


        foreach ($g->array as $item) {

            $item->time = get_readable_time($item->time);

            $item->comment = nl2br($item->comment, false);

            $item->amount = readable_amount_of_money($item->currency, $item->amount);

            $item->price = readable_amount_of_money($item->fiat, $item->price);

        }


        $g->message .= " Here is one year of your taxable income events. ";


        $g->html_title = "One year of your taxable income events";


        $g->page = 'gawk_at_all_taxable_income_events';


        $g->show_poof = true;


        require VIEWS . DIRSEP . 'gawkatalltaxableincomeeventsyearfilter.php';
    }
}