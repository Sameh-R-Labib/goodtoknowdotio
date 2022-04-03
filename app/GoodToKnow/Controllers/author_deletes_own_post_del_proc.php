<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\yes_no_form_field_prep;

class author_deletes_own_post_del_proc
{
    function page()
    {
        /**
         * Here we will read the choice of whether to delete the post. If yes then
         * delete the post record, delete its topic_to_post record, and delete its
         * html and markdown files. On the other hand if no then reset some session variables
         * and redirect to the home page.
         */


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        get_db();


        /**
         * Do nothing if user changed mind.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'yes_no_form_field_prep.php';

        $choice = yes_no_form_field_prep('choice');

        if ($choice == "no") {

            breakout(' You changed your mind about deleting the post. So, none was deleted. ');

        }


        require CONTROLLERINCLUDES . DIRSEP . 'delete_a_post.php';
    }
}