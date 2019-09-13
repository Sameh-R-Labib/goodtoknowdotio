<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\get_readable_time;

class ForgetATaskProcessor
{
    function page()
    {
        /**
         * 1) Determines the id of the task record from 'choice' and stores it in $_SESSION['saved_int01'].
         * 2) Retrieve the task object with that id from the database. And, format its attributes for easy viewing.
         * 3) Make sure that object belongs to this user.
         * 4) Presents a form containing data from the record and asking for permission to delete.
         */


        require CONTROLLERINCLUDES . DIRSEP . 'get_task.php';


        /**
         * 4) Presents a form containing data from the record and asking for permission to delete.
         */

        // Format its attributes for easy viewing.

        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';

        /** @noinspection PhpUndefinedVariableInspection */

        $object->last = get_readable_time($object->last);

        $object->next = get_readable_time($object->next);

        $html_title = 'Are you sure?';

        require VIEWS . DIRSEP . 'forgetataskprocessor.php';
    }
}