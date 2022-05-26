<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\task;
use function GoodToKnow\ControllerHelpers\yes_no_parameter_validation;

class forget_a_task_delete
{
    function page(string $answer = 'no')
    {
        /**
         * Here we will Read the choice of whether to delete the task record. If 'yes' then delete it.
         * On the other hand if 'no' then reset some session variables and redirect to the home page.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->answer = $answer;


        require_once CONTROLLERHELPERS . DIRSEP . 'yes_no_parameter_validation.php';


        yes_no_parameter_validation();


        /**
         * yes/no
         */

        if ($g->answer == "no") {

            breakout(' Nothing was deleted. ');

        }


        /**
         * Delete the record.
         */

        get_db();

        $object = task::find_by_id($g->saved_int01);

        if (!$object) {

            breakout(' I was not able to find the record. ');

        }

        $result = $object->delete();

        if (!$result) {

            breakout(' Unexpectedly I could not delete the record. ');

        }


        // Report successful deletion of post.

        breakout(' I <b>deleted</b> the task. ');
    }
}