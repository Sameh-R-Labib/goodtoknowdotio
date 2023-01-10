<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\commodity;
use GoodToKnow\Models\commodity_sold;
use function GoodToKnow\ControllerHelpers\get_readable_time;
use function GoodToKnow\ControllerHelpers\make_commodity_readable;
use function GoodToKnow\ControllerHelpers\readable_amount_of_money;

class process_a_commodity_sale_save
{
    function page()
    {
        /**
         * Save the commodity and commodity_sold records generated by the previous
         * route. Also, retrieve these records back from the database and present
         * them to the user as confirmation that all went well.
         *
         * Make sure all session variables are destroyed at the end of the script.
         */


        global $g;


        kick_out_loggedoutusers();


        get_db();

        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'readable_amount_of_money.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'make_commodity_readable.php';


        /**
         * The commodity and commodity_sold records are (now) in a state which is appropriate
         * to be saved to the database although at one point in time in the previous route,
         * these records were modified to be human-readable for the confirmation view.
         */

        //$g->saved_arr02 has commodity
        //$g->saved_arr03 has commodity_sold


        /**
         * Update the database with the modified commodity objects.
         */

        foreach ($g->saved_arr02 as $commodity) {

            $result = $commodity->save();

            if (!$result) {

                breakout(' The save method for commodity returned false. ');

            }

            if (!empty($g->message)) {

                breakout(' The save method for commodity did not return false but it did send back a message.
             Therefore, it probably did not create the commodity record. ');

            }

        }


        /**
         * Save to the database the new commodity_sold objects.
         */

        foreach ($g->saved_arr03 as $commodity_sold) {

            $result = $commodity_sold->save();

            if (!$result) {

                breakout(' The save method for commodity_sold returned false. ');

            }

            if (!empty($g->message)) {

                breakout(' The save method for commodity_sold did not return false but it did send
            back a message. Therefore, it probably did not create the commodity_sold record. ');

            }

        }


        /**
         * We've caused the database to reflect changes and additions.
         * Q: Now, what?
         * A: Read both the commodity records and the commodity_sold
         * records from the database and show them to the user along
         * with a “mission accomplished” session message.
         */

        /**
         * For the commodity records
         */
        $g->commodity_from_db = [];
        foreach ($g->saved_arr02 as $commodity) {
            if (!$g->commodity_from_db[] = commodity::find_by_id($commodity->id)) {
                breakout(" Unexpectedly could not find this commodity record in database. ");
            }
        }

        /**
         * For the commodity_sold records
         */
        $g->commodity_sold_from_db = [];
        foreach ($g->saved_arr03 as $commodity_sold) {
            if (!$g->commodity_sold_from_db[] = commodity_sold::find_by_id($commodity_sold->id)) {
                breakout(" Unexpectedly could not find this commodity_sold record in database. ");
            }
        }


        /**
         * Convert the objects into human-readable objects since I intend to present them in a view.
         */

        // For commodity objects
        foreach ($g->commodity_from_db as $g->commodity_object) {

            make_commodity_readable();

        }

        // For commodity_sold objects
        foreach ($g->commodity_sold_from_db as $item) {

            $item->time_bought = get_readable_time($item->time_bought);
            $item->time_sold = get_readable_time($item->time_sold);
            $item->price_bought = readable_amount_of_money($item->currency_transacted, $item->price_bought);
            $item->price_sold = readable_amount_of_money($item->currency_transacted, $item->price_sold);
            $item->profit = readable_amount_of_money($item->currency_transacted, $item->profit);
            $item->commodity_amount = readable_amount_of_money($item->commodity_type, $item->commodity_amount);

        }


        /**
         * $g->commodity_from_db
         * $g->commodity_sold_from_db
         *
         * ... show them to the user along with
         * a “mission accomplished” session message.
         *
         * The view will be that of a regular page (not a form page.)
         */

        $g->html_title = "Saved Commodity and Commodity Sold Records";

        $g->page = 'process_a_commodity_sale_save';

        $g->show_poof = true;

        $g->message .= " Here's data you saved shown after being retrieved from the database. ";
        reset_feature_session_vars();
        require VIEWS . DIRSEP . 'processacommoditysalesave.php';
    }
}