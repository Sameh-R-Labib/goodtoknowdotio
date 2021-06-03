<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Task;
use function GoodToKnow\ControllerHelpers\get_proximity_task_label;
use function GoodToKnow\ControllerHelpers\get_readable_date;

class GlanceAtMyTasks
{
    function page()
    {
        /**
         * Display all tasks for the user.
         */


        global $db;
        global $app_state;
        global $html_title;
        global $show_poof;
        global $page;
        global $array;


        kick_out_loggedoutusers();


        /**
         * Retrieve Tasks.
         */

        $db = get_db();

        $sql = 'SELECT * FROM `task` WHERE `user_id` = ' . $db->real_escape_string($app_state->user_id);

        $array = Task::find_by_sql($sql);

        if (!$array || !empty($app_state->message)) {

            breakout(' I could NOT find any tasks ¯\_(ツ)_/¯ ');

        }


        /**
         * Loop through the array and replace some attributes with more readable versions of themselves.
         * Also, for the `label`, add decoration which indicates the proximity in time which the task has
         * to the current time.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_date.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'get_proximity_task_label.php';

        foreach ($array as $object) {
            $object->label = get_proximity_task_label($object->label, $object->next);
            $object->last = get_readable_date($object->last);
            $object->next = get_readable_date($object->next);
            $object->comment = nl2br($object->comment, false);
        }


        /**
         * The view.
         */

        $html_title = 'All my Tasks';

        $page = 'GlanceAtMyTasks';

        $show_poof = true;

        $app_state->message .= ' ʘ‿ʘ at your Tasks. ';

        require VIEWS . DIRSEP . 'glanceatmytasks.php';
    }
}