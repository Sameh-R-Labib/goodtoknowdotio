<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use GoodToKnow\Models\Task;

class FeatureATaskEdit
{
    function page()
    {
        /**
         * 1) Store the submitted task id in the session.
         * 2) Retrieve the task object with that id from the database.
         * 3) Make sure that object belongs to this user.
         * 4) Present a form which is populated with data from the task object.
         */

        global $sessionMessage;

        global $user_id;

        kick_out_loggedoutusers();

        kick_out_onabort();


        /**
         * 1) Store the submitted task id in the session.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $id = integer_form_field_prep('choice', 1, PHP_INT_MAX);

        $_SESSION['saved_int01'] = $id;


        /**
         * 2) Retrieve the task object with that id from the database.
         */

        $db = get_db();

        $object = Task::find_by_id($db, $sessionMessage, $id);

        if (!$object) {
            breakout(' Unexpectedly, I could not find that task. ');
        }


        /**
         * 3) Make sure that object belongs to this user.
         */

        if ($object->user_id != $user_id) {

            breakout(' Error 46985422. ');

        }


        /**
         * 4) Present a form which is populated with data from the task object.
         */

        $html_title = 'Edit the task record';

        require VIEWS . DIRSEP . 'featureataskedit.php';
    }
}