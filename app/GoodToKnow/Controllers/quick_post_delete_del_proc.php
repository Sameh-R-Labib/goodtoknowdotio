<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\yes_no_parameter_validation;

class quick_post_delete_del_proc
{
    function page(string $answer = 'no')
    {
        /**
         * Here we will read the choice of whether to delete the post. If yes then
         * delete the post record, delete its topic_to_post record, and delete its html and
         * markdown files. On the other hand if no then reset some session variables and
         * redirect to the home page.
         */


        global $g;


        kick_out_nonadmins();


        get_db();


        $g->answer = $answer;


        require_once CONTROLLERHELPERS . DIRSEP . 'yes_no_parameter_validation.php';


        yes_no_parameter_validation();


        /**
         * Do nothing if user changed mind.
         */

        if ($g->answer == "no") {

            breakout(' Nothing was changed. ');

        }


        /**
         * Delete the post.
         */

        require CONTROLLERINCLUDES . DIRSEP . 'delete_a_post.php';
    }
}