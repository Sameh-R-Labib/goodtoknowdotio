<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\yes_no_parameter_validation;

class author_deletes_own_post_del_proc
{
    function page(string $answer = 'no')
    {
        /**
         * Here we will read the choice of whether to delete the post. If yes then
         * delete the post record, delete its topic_to_post record, and delete its
         * html and markdown files. On the other hand if no then reset some session variables
         * and redirect to the home page.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->answer = $answer;


        get_db();


        /**
         * Do nothing if user changed mind.
         */


        require_once CONTROLLERHELPERS . DIRSEP . 'yes_no_parameter_validation.php';


        yes_no_parameter_validation();


        if ($g->answer == "no") {

            breakout(' You changed your mind about deleting the post. So, none was deleted. ');

        }


        require CONTROLLERINCLUDES . DIRSEP . 'delete_a_post.php';
    }
}