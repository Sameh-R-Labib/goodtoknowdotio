<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\commodity_sold;
use function GoodToKnow\ControllerHelpers\get_readable_time;
use function GoodToKnow\ControllerHelpers\make_commodity_readable;
use function GoodToKnow\ControllerHelpers\readable_amount_of_money;

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
         * These should be outside the loop. So, I'm putting them here.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'readable_amount_of_money.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'make_commodity_readable.php';


        /**
         * $g->sold_remaining variable holds the amount of commodity remaining to
         * be removed from the user's stash of commodity.
         *
         * Initialize $g->sold_remaining.
         */

        // FYI: The previous route made sure the amount was greater than a particular
        // FYI: value so that the manipulations we will do will change things and
        // FYI: thus assist in preventing an infinite loop from occurring.

        $g->sold_remaining = (float)$g->saved_arr01["amount"];


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
         *     $g->sold_remaining                // holds the amount of commodity to expense
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

        $g->array_of_commodity_objects = [];


        /**
         * Initialize the array which has the generated commodity_sold objects.
         */

        $g->array = [];


        /**
         * Main Loop
         * =========
         *
         * We will iterate over $user_nonzero_commodities[] and do stuff (possibly exiting the loop before finishing.)
         */

        $array_keys = array_keys($user_nonzero_commodities);
        $last_key = array_pop($array_keys);

        foreach ($user_nonzero_commodities as $key => $nonzero_commodity) {

            // Exit the loop is $g->sold_remaining is insufficient to deduct from a commodity object. In other words
            // $g->sold_remaining is too small. Whether $g->sold_remaining is too small or not depends on the type of
            // commodity (namely $g->saved_arr01["commodity"]).

            if ($g->saved_arr01["commodity"] == 'BTC' or $g->saved_arr01["commodity"] == 'OXT') {

                if ($g->sold_remaining < 0.00000001) break;

            } elseif ($g->saved_arr01["commodity"] == 'BAT') {

                if ($g->sold_remaining < 0.00000000001) break;

            } else {

                if ($g->sold_remaining < 0.01) break;

            }


            /**
             * Fork in the road.
             */

            if ($g->sold_remaining <= $nonzero_commodity->current_balance) {


                // Expense the $g->sold_remaining from the current Commodity record and adjust all other
                // fields of the Commodity record to reflect this fact.
                $nonzero_commodity->current_balance = $nonzero_commodity->current_balance - $g->sold_remaining;

                // Modify the comment field of the commodity object.
                $nonzero_commodity->comment .= "\n" . readable_amount_of_money($g->saved_arr01["commodity"], $g->sold_remaining)
                    . " sold " . get_readable_time($g->saved_arr01["time"])
                    . " rate " . $g->saved_arr01["currency"]
                    . readable_amount_of_money($g->saved_arr01["currency"], $g->saved_arr01["price_sold"])
                    . " " . $g->saved_arr01["reason"] . '.';

                // We need this.
                $amount_sold_now = $g->sold_remaining;

                // Zero out $g->sold_remaining.
                $g->sold_remaining = 0.0;

                // Add the commodity to our array of changed commodities.
                $g->array_of_commodity_objects[] = $nonzero_commodity;

                // Create the associated commodity_sold object and add it to $g->array.

                // Verify this
                if ($g->saved_arr01["currency"] != $nonzero_commodity->currency) {

                    breakout(' I can not expense the commodity you sold because there is a mismatch in type of currency
                    used to price the commodity between the sale and purchase records. ');

                }

                // Figure this out right here, so I can use it later.
                // profit = (price sold x amount sold) - (price bought x amount sold)
                // (aka) profit = amount sold x (price sold - price bought)
                $profit_for_this_commodity_sold = (float)$amount_sold_now * ((float)$g->saved_arr01["price_sold"]
                        - (float)$nonzero_commodity->price_point);

                // Compose the commodity_sold array.
                $commodity_sold_arr = ['user_id' => $g->user_id, 'time_bought' => $nonzero_commodity->time,
                    'time_sold' => $g->saved_arr01["time"], 'price_bought' => $nonzero_commodity->price_point,
                    'price_sold' => $g->saved_arr01["price_sold"], 'currency_transacted' => $g->saved_arr01["currency"],
                    'commodity_amount' => $amount_sold_now, 'commodity_type' => $g->saved_arr01["commodity"],
                    'commodity_label' => $nonzero_commodity->address, 'tax_year' => $g->saved_arr01["tax_year"],
                    'profit' => $profit_for_this_commodity_sold];

                // Create the commodity_sold and add it to $g->array.
                $g->array[] = commodity_sold::array_to_object($commodity_sold_arr);

                // We don’t need to go to the next Commodity record.
                break;


            } else {


                // $g->sold_remaining is greater than amount remaining in current commodity record.

                // Error out if we would still have some commodity to expense after the current iteration of the loop
                // and yet there would be no more commodity records from which to expense.
                if ($key == $last_key) {

                    breakout(" You dont have enough commodity to expense from. ");

                }

                // Take out the current_balance in the commodity.
                // Also, reflect that this has happened in $g->sold_remaining.
                $nonzero_commodity->comment .= "\n"
                    . readable_amount_of_money($g->saved_arr01["commodity"], $nonzero_commodity->current_balance)
                    . " sold "
                    . get_readable_time($g->saved_arr01["time"])
                    . " rate " . $g->saved_arr01["currency"]
                    . readable_amount_of_money($g->saved_arr01["currency"], $g->saved_arr01["price_sold"])
                    . " " . $g->saved_arr01["reason"] . '.';
                $amount_sold_now = $nonzero_commodity->current_balance;
                $g->sold_remaining = $g->sold_remaining - $nonzero_commodity->current_balance;
                $nonzero_commodity->current_balance = 0.0;

                // Add the commodity to our array of changed commodities.
                $g->array_of_commodity_objects[] = $nonzero_commodity;

                // Create the associated commodity_sold object and add it to $g->array.

                // Figure this out right here, so I can use it later.
                // profit = (price sold x amount sold) - (price bought x amount sold)
                // (aka) profit = amount sold x (price sold - price bought)
                $profit_for_this_commodity_sold = (float)$amount_sold_now * ((float)$g->saved_arr01["price_sold"]
                        - (float)$nonzero_commodity->price_point);

                // Verify this
                if ($g->saved_arr01["currency"] != $nonzero_commodity->currency) {

                    breakout(' I can not expense the commodity you sold because there is a mismatch in type of currency
                    used to price the commodity between the sale and purchase records. ');

                }

                // Compose the commodity_sold array.
                $commodity_sold_arr = ['user_id' => $g->user_id, 'time_bought' => $nonzero_commodity->time,
                    'time_sold' => $g->saved_arr01["time"], 'price_bought' => $nonzero_commodity->price_point,
                    'price_sold' => $g->saved_arr01["price_sold"], 'currency_transacted' => $g->saved_arr01["currency"],
                    'commodity_amount' => $amount_sold_now, 'commodity_type' => $g->saved_arr01["commodity"],
                    'commodity_label' => $nonzero_commodity->address, 'tax_year' => $g->saved_arr01["tax_year"],
                    'profit' => $profit_for_this_commodity_sold];

                // Create the commodity_sold and add it to $g->array.
                $g->array[] = commodity_sold::array_to_object($commodity_sold_arr);

            }
        }


        /**
         * Outside the loop.
         */


        /**
         * In two array session variables, store the commodity and commodity_sold
         * records before they are made readable. We will need these two arrays
         * in the next route. This is the data which gets stored in the database.
         * It must be in raw form.
         */

        $_SESSION["saved_arr02"] = $g->array_of_commodity_objects;
        $_SESSION["saved_arr03"] = $g->array;


        /**
         * Loop through the array and replace some attributes with more readable versions of themselves.
         * And apply htmlspecialchars if necessary.
         */

        foreach ($g->array_of_commodity_objects as $g->commodity_object) {

            make_commodity_readable();

        }


        /**
         * Loop through the array and replace attributes with more readable ones.
         *
         * Items which need this are:
         *   'time_bought', 'time_sold', 'price_bought', 'price_sold', 'commodity_amount', 'profit'.
         */


        foreach ($g->array as $item) {

            $item->time_bought = get_readable_time($item->time_bought);
            $item->time_sold = get_readable_time($item->time_sold);
            $item->price_bought = readable_amount_of_money($item->currency_transacted, $item->price_bought);
            $item->price_sold = readable_amount_of_money($item->currency_transacted, $item->price_sold);
            $item->profit = readable_amount_of_money($item->currency_transacted, $item->profit);
            $item->commodity_amount = readable_amount_of_money($item->commodity_type, $item->commodity_amount);

        }


        /**
         * Present the view.
         *
         * Present a Save button and an Abort button.
         * **These buttons will be link buttons instead of form submit buttons.**
         */

        $g->html_title = 'preview changes';

        require VIEWS . DIRSEP . 'processacommoditysalegeneratechanges.php';
    }
}