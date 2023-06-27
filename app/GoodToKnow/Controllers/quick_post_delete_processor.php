<?php

namespace GoodToKnow\Controllers;


class quick_post_delete_processor
{
    function page(int $id = 0)
    {
        global $g;


        kick_out_nonadmins();


        $g->id = $id;


        if (!is_int($g->id) or $g->id < 1) {

            breakout(' Error 522213: Commodity id is either not int or is negative int. ');

        }


        /**
         * Make sure $g->chosen_topic_id is among the ids of $g->special_topic_array
         */

        if (!array_key_exists($g->id, $g->special_topic_array)) {

            breakout(' Unexpected error: topic id not found in topic array. ');

        }


        /**
         * Save it in the session
         */

        $_SESSION['saved_int01'] = $g->id;


        redirect_to("/ax1/quick_post_delete_choose_post/page");
    }
}