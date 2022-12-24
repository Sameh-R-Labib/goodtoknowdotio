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

        $user_nonzero_commodities = [];


        /**
         * FYI:
         * $g->array_of_commodity_objects (is the temporary holding area ... $user_nonzero_commodities
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
        // $user_nonzero_commodities
        // A compliant commodity object is one which:
        //  A. is of type $g->saved_arr01["commodity"]
        //  B. has a nonzero value for current_balance

        foreach ($g->array_of_commodity_objects as $commodity_object) {

            if ($commodity_object->commodity == $g->saved_arr01["commodity"] and $commodity_object->current_balance != 0) {

                $user_nonzero_commodities[] = $commodity_object;

            }
        }


        // Break out if we didn't find any commodity objects to do what we want to do to them.

        if (empty($user_nonzero_commodities)) {

            breakout(' I can not expense the commodity you sold because there are no commodity records to expense from. ');

        }


        /**
         * Progress Report
         *
         *  We got
         *     $g->db                         // database connection
         *     $g->saved_arr01                // submitted form data
         *     $sold_remaining                // holds the amount of commodity to expense
         *     $user_nonzero_commodities[]    // pool of commodity objects to expense from
         *
         *  $user_nonzero_commodities[] is an array of the commodity objects which we will (metaphorically speaking)
         *  alter in a way to make the objects reflect the fact that a particular amount of commodity
         *  (namely $g->saved_arr01["amount"]) was sold by the user. That sold amount will be taken out of these objects
         *  in a particular distribution. We will take the most out of the older objects. Eventually, either we will have
         *  exhausted the amount or we will have gone through all the objects still have some amount left over (in which
         *  case that is an error state.)
         */


        /**
         * Initialize the array which has the changed objects.
         */

        $changed_commodities = [];


        /**
         * Initialize the array which has the generated commodity_sold objects.
         */

        $generated_commodity_sold_objects = [];


        /**
         * Main Loop
         * =========
         *
         * We will iterate over $user_nonzero_commodities[] and do stuff (possibly exiting the loop before finishing.)
         */

        foreach ($user_nonzero_commodities as $nonzero_commodity) {

            // Exit the loop is $sold_remaining is insufficient to deduct from a commodity object. In other words
            // $sold_remaining is too small. Whether $sold_remaining is too small or not depends on the type of
            // commodity (namely $g->saved_arr01["commodity"]).

            if ($g->saved_arr01["commodity"] == 'BTC' or $g->saved_arr01["commodity"] == 'OXT') {

                if ($sold_remaining < 0.00000001) break;

            } elseif ($g->saved_arr01["commodity"] == 'BAT') {

                if ($sold_remaining < 0.00000000001) break;

            } else {

                if ($sold_remaining < 0.01) break;

            }


            /**
             * Fork in the road.
             */

            if ($sold_remaining <= $nonzero_commodity["current_balance"]) {

                // Expense the $sold_remaining from the current Commodity record and adjust all other
                // fields of the Commodity record to reflect this fact.
                $nonzero_commodity["current_balance"] = $nonzero_commodity["current_balance"] - $sold_remaining;

                // Modify the comment field of the commodity object.
                $nonzero_commodity["comment"] .= "\n" . $sold_remaining . " sold " . 'The time based on $g->saved_arr01["time"]'
                    . " rate " . 'The unit cost based on $g->saved_arr01["currency"] and $g->saved_arr01["price_sold"]'
                    . " " . $g->saved_arr01["reason"] . '.';

                // Zero out $sold_remaining.
                $sold_remaining = 0.0;

                // Add the commodity to our array of changed commodities.
                $changed_commodities[] = $nonzero_commodity;


                // Create the associated commodity_sold object and add it to $generated_commodity_sold_objects array.
                // For this commodity_sold, what is the value of each of its attributes?
                // user_id:
                // time_bought:
                // time_sold:
                // price_bought:
                // price_sold:
                // currency_transacted:
                // commodity_amount:
                // commodity_type:
                // commodity_label:
                // tax_year:
                // profit:

            } else {

                // Do another.

            }
        }

        /**
         * Here we are outside the foreach loop.
         */
    }
}