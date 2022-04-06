<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\make_commodity_readable;

class commodity_see_my_records_create_edit
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers();


        get_db();


        /**
         * Establish a value for $commodity_symbol. $commodity_symbol is the
         * symbol for the commodity associated with the commodity record which
         * was created or edited.
         */

        $commodity_symbol = $g->saved_str01;


        /**
         * Establish values for $g->begin and $g->end based on the time
         * of purchase the user specified (which we stored in $g->saved_int02.)
         *
         * The time range will be one month before and after the time of purchase.
         * One month is 2628000 seconds.
         */

        $g->begin = $g->saved_int02 - 2628000;

        $g->end = $g->saved_int02 + 2628000;


        /**
         * Get user's commodity records from database.
         */

        // Records will be received sorted by time.

        require CONTROLLERINCLUDES . DIRSEP . 'get_all_commodity_records_of_the_user.php';


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
        reset_feature_session_vars();
        require VIEWS . DIRSEP . 'commodityseemyrecords.php';
    }
}