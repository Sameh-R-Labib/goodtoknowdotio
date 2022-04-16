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

        $g->coms_in_this_system = community::find_all();

        if (!$g->coms_in_this_system) {

            breakout(' Unable to retrieve communities. ');

        }


        /**
         * Loop through the communities and record the ones whose
         * topics are jammed too close to each other.
         */

        foreach ($g->coms_in_this_system as $community) {

            self::record_community_if_its_topics_are_jammed_too_close($community);

        }


        /**
         * Loop through all the communities. For each community loop through its topics
         * and record the topics whose posts are jammed too close to each other.
         */
    }
}