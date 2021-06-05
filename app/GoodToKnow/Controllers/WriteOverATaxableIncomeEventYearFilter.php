<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\get_readable_time;

class WriteOverATaxableIncomeEventYearFilter
{
    function page()
    {
        /**
         * 1) Validate the submitted year_received.
         * 2) Present the TaxableIncomeEvent(s/plural) which fall in that year as radio buttons.
         */


        global $gtk;
        global $array;


        require CONTROLLERINCLUDES . DIRSEP . 'get_taxable_income_events_for_year.php';


        /**
         * Loop through the array and replace time attributes with a more readable time format.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';

        foreach ($array as $item) {

            $item->time = get_readable_time($item->time);

        }


        /**
         * Present the view.
         */

        $gtk->html_title = 'Which taxable income event?';

        require VIEWS . DIRSEP . 'writeoverataxableincomeeventyearfilter.php';
    }
}