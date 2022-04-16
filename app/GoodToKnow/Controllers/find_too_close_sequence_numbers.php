<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\community;

class find_too_close_sequence_numbers
{
    function page()
    {
        /**
         * What This Feature Does
         * ======================
         *   - It tells Admin which communities have topics whose sequence numbers are too close to each other.
         *   - It tells Admin which Topics have posts whose sequence numbers are too close to each other.
         */

        global $g;


        kick_out_nonadmins_or_if_there_is_error_msg();


        $g->line_item_for_report = [];


        /**
         * Get all the communities in the system.
         */

        $coms_in_this_system = community::find_all();

        if ($coms_in_this_system === false) {

            breakout(' Unable to retrieve communities. ');

        }
    }
}