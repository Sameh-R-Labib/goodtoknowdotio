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


        /**
         * Create an empty array.
         *
         * This array will be used to aggregate and hold
         * the commodity_sold objects which we will create
         * in memory for now (as opposed to in the database.)
         */

        $new_commodity_sold_objects_arr = [];


        /**
         * $g->array_of_commodity_objects (is the temporary holding area ... $new_commodity_sold_objects_arr
         * will be the variable which will hold the objects we intend to have.)
         *
         * Get all the commodity objects which satisfy the following conditions:
         *  1. belong to the current user
         *  2. are of type $g->saved_arr01["commodity"]
         */

        // Get all (and I mean ALL) user's commodity records from database.
        // The result will be received sorted by time.

        require CONTROLLERINCLUDES . DIRSEP . 'get_all_commodity_records_of_the_user.php';
    }
}