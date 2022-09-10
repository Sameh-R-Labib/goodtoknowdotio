<?php

namespace GoodToKnow\Controllers;

class process_a_commodity_sale_generate_changes
{
    function page()
    {
        /**
         * 2. Generate the modified commodity objects and the new commodity_sold objects.
         *    At this stage these objects will NOT be updating the database.
         */

        global $g;

        // Debug.
        var_dump($g->saved_arr01);
    }
}