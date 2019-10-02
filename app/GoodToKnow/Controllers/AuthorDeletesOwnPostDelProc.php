<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\yes_no_form_field_prep;

class AuthorDeletesOwnPostDelProc
{
    function page()
    {
        /**
         * Here we will read the choice of whether or not to delete the post. If yes then
         * delete the post record, delete its TopicToPost record, and delete its
         * html and markdown files. On the other hand if no then reset some session variables
         * and redirect to the home page.
         */

        global $sessionMessage;
        global $saved_int02;
        global $saved_int01;
        global $saved_str01;
        global $saved_str02;

        kick_out_loggedoutusers();


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