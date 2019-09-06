<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Task;
use function GoodToKnow\ControllerHelpers\get_readable_time;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;

class ForgetATaskProcessor
{
    function page()
    {
        /**
         * 1) Determines the id of the task record from $_POST['choice'] and stores it in $_SESSION['saved_int01'].
         * 2) Retrieve the task object with that id from the database. And, format its attributes for easy viewing.
         * 3) Presents a form containing data from the record and asking for permission to delete.
         */

        global $sessionMessage;

        kick_out_loggedoutusers();

        kick_out_onabort();


        /**
         * 1) Determines the id of the task record from $_POST['choice'] and stores it in $_SESSION['saved_int01'].
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $chosen_id = integer_form_field_prep('choice', 1, PHP_INT_MAX);

        $_SESSION['saved_int01'] = $chosen_id;


        /**
         * 2) Retrieve the task object with that id from the database.
         *    And, format its attributes for easy viewing.
         */

        $db = get_db();

        $object = Task::find_by_id($db, $sessionMessage, $chosen_id);


        // Format its attributes for easy viewing.

        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';

        $object->last = get_readable_time($object->last);

        $object->next = get_readable_time($object->next);


        /**
         * 3) Presents a form containing data from the record and asking for permission to delete.
         */

        $html_title = 'Are you sure?';

        require VIEWS . DIRSEP . 'forgetataskprocessor.php';
    }
}