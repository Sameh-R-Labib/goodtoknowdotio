<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\make_commodity_readable;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class commodity_see_my_records
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers();


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

        // Records will be received sorted by time.

        require CONTROLLERINCLUDES . DIRSEP . 'get_commodity_records_of_the_user.php';


        /**
         * Take the array $g->array_of_commodity_objects and do the following:
         *  1. Remove objects which are not commodities of type $commodity_symbol.
         *  2. Remove objects which are out of the time range.
         */

        foreach ($g->array_of_commodity_objects as $key => $commodity_object) {


            if ($commodity_object->commodity !== $commodity_symbol) {

                // Remove the object if it is not a commodity of type $commodity_symbol.

                unset($g->array_of_commodity_objects[$key]);

            } elseif ($commodity_object->time > $g->end or $commodity_object->time < $g->begin) {

                // Remove the object if it is out of the time range.

                unset($g->array_of_commodity_objects[$key]);

            }

        }


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

        $g->html_title = 'Your commodity records';

        $g->page = 'commodity_see_my_records';

        $g->show_poof = true;

        $g->message .= ' Here are your commodity records. ';

        require VIEWS . DIRSEP . 'commodityseemyrecords.php';
    }
}