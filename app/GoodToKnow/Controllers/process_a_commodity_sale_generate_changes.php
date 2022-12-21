<?php

namespace GoodToKnow\Controllers;

class process_a_commodity_sale_generate_changes
{
    function page()
    {
        /**
         * Generate the modified commodity objects and the new commodity_sold objects.
         * At this stage these objects will NOT be updating the database.
         *
         *
         * What the submitted / saved form data could look like:
         *
         * Var_dump $g->saved_arr01:
         *   array(7)
         *     ["commodity"]=> string(3) "BTC"
         *     ["amount"]=> float(0.0198)
         *     ["time"]=> int(1662048061)
         *     ["tax_year"]=> int(2022)
         *     ["currency"]=> string(1) "$"
         *     ["price_sold"]=> float(23925)
         *     ["reason"]=> string(17) "for doing a test."
         */

        global $g;


        kick_out_loggedoutusers();


        get_db();


        /**
         * $sold_remaining variable holds the amount of commodity remaining to
         * be removed from the user's stash of commodity.
         *
         * Initialize $sold_remaining.
         */

        // FYI: The previous route made sure the amount was greater than a particular
        // FYI: value so that the manipulations we will do will change things and
        // FYI: thus assist in preventing an infinite loop from occurring.

        $sold_remaining = $g->saved_arr01["amount"];


        /**
         * Create an empty array.
         *
         * This array will be used to aggregate and hold
         * the commodity_sold objects which we will create
         * in memory for now (as opposed to in the database.)
         */

        $new_commodity_sold_objects_arr = [];


        /**
         * FYI:
         * $g->array_of_commodity_objects (is the temporary holding area ... $new_commodity_sold_objects_arr
         * will be the variable which will hold the objects we intend to have.)
         *
         * Goal:
         * Get all the commodity objects which satisfy the following conditions:
         *  1. belong to the current user
         *  2. are of type $g->saved_arr01["commodity"]
         *  3. have a nonzero value for current_balance
         */


        // Get all (and I mean ALL) user's commodity records from database.
        // FYI: The result will be received sorted by time.
        // FYI: $g->array_of_commodity_objects is result of the included code below.

        require CONTROLLERINCLUDES . DIRSEP . 'get_all_commodity_records_of_the_user.php';


        // Iterate over $g->array_of_commodity_objects
        // and store the compliant objects in
        // $new_commodity_sold_objects_arr
        // A compliant commodity object is one which:
        //  A. is of type $g->saved_arr01["commodity"]
        //  B. has a nonzero value for current_balance

        foreach ($g->array_of_commodity_objects as $commodity_object) {

            if ($commodity_object->commodity == $g->saved_arr01["commodity"] and $commodity_object->current_balance != 0) {

                $new_commodity_sold_objects_arr[] = $commodity_object;

            }
        }

        /**
         * Progress Report
         *
         *  We got
         *     $new_commodity_sold_objects_arr
         *
         *  It is an array of the commodity objects which we will alter in a way to make the objects reflect the fact that
         *  a particular amount of commodity was sold by the user. That sold amount will be taken out of these objects in
         *  a particular distribution. We will take the most out of the older objects. Eventually, either we will have
         *  exhausted the amount or we will have gone through all the objects still have some amount left over (in which
         *  case that is an error state.)
         */

    }
}