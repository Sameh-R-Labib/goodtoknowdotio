<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Task;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class ForgetATaskDelete
{
    function page()
    {
        /**
         * Here we will Read the choice of whether or not to delete the task record. If 'yes' then delete it.
         * On the other hand if 'no' then reset some session variables and redirect to the home page.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $saved_int01;

        kick_out_loggedoutusers();

        kick_out_onabort();


        /**
         * yes/no
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $choice = standard_form_field_prep('choice', 2, 3);

        if (is_null($choice)) {
            breakout(' The choice you entered did not pass validation. ');
        }

        if ($choice != "yes" && $choice != "no") {
            breakout(' You didn\'t enter a choice. ');
        }

        if ($choice == "no") {
            breakout(' Nothing was deleted. ');
        }


        /** @var  $db */

        $db = get_db();

        $object = Task::find_by_id($db, $sessionMessage, $saved_int01);

        if (!$object) {
            breakout(' I was not able to find the record. ');
        }

        $result = $object->delete($db, $sessionMessage);

        if (!$result) {
            breakout(' Unexpectedly I could not delete the record. ');
        }


        // Report successful deletion of post.

        breakout(' I deleted the To-do Task. ');
    }
}