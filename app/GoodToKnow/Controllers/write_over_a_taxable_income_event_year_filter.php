<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\get_readable_time;

class write_over_a_taxable_income_event_year_filter
{
    function page()
    {
        /**
         * 1) Validate the submitted year_received.
         * 2) Present the taxable_income_event(s/plural) which fall in that year as radio buttons.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        get_db();


        require CONTROLLERINCLUDES . DIRSEP . 'get_taxable_income_events_for_year.php';


        /**
         * Loop through the array and replace time attributes with a more readable time format.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';

        foreach ($g->array as $item) {

            $item->time = get_readable_time($item->time);

        }


        /**
         * Present the view.
         */

        $g->html_title = 'Which taxable income event?';

        require VIEWS . DIRSEP . 'writeoverataxableincomeeventyearfilter.php';
    }
}