<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\integer_form_field_prep;

class move_post_get_post
{
    function page(int $id = 0)
    {
        /**
         * This route will:
         *   - determine which post was chosen
         *   - store that post id in the session
         *   - present the choices for the new topic for the post
         */


        global $g;


        kick_out_nonadmins_or_if_there_is_error_msg();


        get_db();


        $g->id = $id;


        if (!is_int($g->id) or $g->id < 1) {

            breakout(' Error 5868843: Post id is either not int or is negative int. ');

        }


        /**
         * determine which post was chosen
         * AND store that post id in the session
         */

        $_SESSION['saved_int01'] = $g->id;


        /**
         * present the choices for the new topic for the post
         * present radio buttons -- each one is for a topic in the current community
         * $g->special_topic_array  (is what we need -- and we have it)
         */

        $g->html_title = 'Which topic?';

        require VIEWS . DIRSEP . 'movepostgetpost.php';
    }
}