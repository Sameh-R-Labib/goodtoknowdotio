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
    }
}