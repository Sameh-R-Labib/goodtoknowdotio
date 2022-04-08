<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\integer_form_field_prep;

class move_post_get_post
{
    function page()
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


        /**
         * determine which post was chosen
         * AND store that post id in the session
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $_SESSION['saved_int01'] = integer_form_field_prep('choice', 1, PHP_INT_MAX);


        /**
         * present the choices for the new topic for the post
         * present radio buttons -- each one is for a topic in the current community
         * $g->special_topic_array  (is what we need -- and we have it)
         */

        $g->html_title = 'Which topic?';

        require VIEWS . DIRSEP . 'movepostgetpost.php';
    }
}