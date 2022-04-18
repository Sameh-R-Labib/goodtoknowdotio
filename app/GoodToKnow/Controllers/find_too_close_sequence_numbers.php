<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\community;
use GoodToKnow\Models\community_to_topic;

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


        get_db();


        $line_item_for_report = [];


        /**
         * Get all the communities in the system.
         */

        $coms_in_this_system = community::find_all();

        if (!$coms_in_this_system) {

            breakout(' Unable to retrieve communities. ');

        }


        /**
         * Loop through the communities and record the ones whose
         * topics are jammed too close to each other.
         */

        foreach ($coms_in_this_system as $community) {

            self::record_community_if_its_topics_are_jammed_too_close($community, $line_item_for_report);

        }


        /**
         * Loop through all the communities. For each community loop through its topics
         * and record the topics whose posts are jammed too close to each other.
         */

        foreach ($coms_in_this_system as $community) {

            // First find all the topics in this community.

            $topics_in_this_community = community_to_topic::get_array_of_topic_objects_for_a_community((int)$community->id);


            // We want the script to keep going even if $topics_in_this_community === false
            // So, we do this:

            if (!$topics_in_this_community) {

                $topics_in_this_community = [];

            }


            // Then, loop through these topics and record the topics which
            // have posts that are too close to each other.

            foreach ($topics_in_this_community as $topic) {

                self::record_topic_if_its_posts_are_jammed_too_close($topic, $line_item_for_report);

            }


            /**
             * Show a view which either,
             * - shows the items (communities or topics) which need fixing
             * Or,
             * - stated that all item containers have well spaced content.
             */

            $g->output = '';

            if (!empty($line_item_for_report)) {

                foreach ($line_item_for_report as $item) {

                    $g->output .= $item . "\n <br><br>";

                }
            } else {

                $g->output .= "All item containers have well spaced content.";

            }

            $g->output = rtrim($g->output, "<br>");


            // Typical vars for a regular page.

            $g->html_title = 'Items with jammed content';

            $g->page = 'find_too_close_sequence_numbers';

            $g->show_poof = true;

            $g->message .= " If you see items on this page then you need to fix the sequence numbers of what's contained in them. ";
            reset_feature_session_vars();
            require VIEWS . DIRSEP . 'findtooclosesequencenumbers.php';

        }

    }

    /**
     *
     */
    private static function record_community_if_its_topics_are_jammed_too_close(object $community, array &$line_item_for_report)
    {

    }

}