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


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        get_db();


        require CONTROLLERINCLUDES . DIRSEP . 'get_task.php';


        /**
         * 4) Presents a form containing data from the record and asking for permission to delete.
         */

        // Format its attributes for easy viewing.

        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';

        $g->object->last = get_readable_time($g->object->last);

        $g->object->next = get_readable_time($g->object->next);


        $g->html_title = 'Are you sure?';


        require VIEWS . DIRSEP . 'forgetataskprocessor.php';
    }
}