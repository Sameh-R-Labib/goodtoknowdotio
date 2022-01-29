<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\make_commodity_readable;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class CommoditySeeMyRecords
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        get_db();


        /**
         * Get data from $_POST array.
         */

        // Get $commodity_symbol

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $commodity_symbol = standard_form_field_prep('commodity_symbol', 1, 15);

        // + + + Get $g->begin and $g->end (which are timestamps) based on submitted:
        // `timezone` `begin_date` `begin_hour` `begin_minute` `begin_second` `end_date` `end_hour` `end_minute` `end_second`

        require CONTROLLERINCLUDES . DIRSEP . 'figure_out_begin_and_end_epochs.php';

        // + + +


        /**
         * Get user's commodity records from database.
         */

        require CONTROLLERINCLUDES . DIRSEP . 'get_commodity_records_of_the_user.php';


        /**
         * Loop through the array and replace some attributes with more readable versions of themselves.
         * And apply htmlspecialchars if necessary.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'make_commodity_readable.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'readable_amount_of_money.php';

        foreach ($g->array_of_commodity_objects as $g->commodity_object) {

            make_commodity_readable();

        }


        /**
         * Present the view.
         */

        $g->html_title = 'Your Commodity records';

        $g->page = 'CommoditySeeMyRecords';

        $g->show_poof = true;

        $g->message .= ' Here are your commodity records. ';

        require VIEWS . DIRSEP . 'commodityseemyrecords.php';
    }
}