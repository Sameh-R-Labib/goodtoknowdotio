<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\task;
use function GoodToKnow\ControllerHelpers\get_proximity_task_label;
use function GoodToKnow\ControllerHelpers\get_readable_date;

class glance_at_my_tasks
{
    function page()
    {
        /**
         * Display all tasks for the user.
         */


        global $g;


        kick_out_loggedoutusers();


        /**
         * Retrieve Tasks.
         */

        get_db();

        $sql = 'SELECT * FROM `task` WHERE `user_id` = ' . $g->db->real_escape_string((string)$g->user_id);

        $g->array = task::find_by_sql($sql);

        if (!$g->array) {

            breakout(' I could NOT find any tasks ¯\_(ツ)_/¯ ');

        }


        /**
         * Loop through the array and replace some attributes with more readable versions of themselves.
         * Also, for the `label`, add decoration which indicates the proximity in time which the task has
         * to the current time.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_date.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'get_proximity_task_label.php';

        foreach ($g->array as $object) {

            $object->label = get_proximity_task_label($object->label, $object->next);
            $object->last = get_readable_date($object->last);
            $object->next = get_readable_date($object->next);
            $object->comment = nl2br($object->comment, false);

        }


        /**
         * The view.
         */

        $g->html_title = 'All my Tasks';

        $g->page = 'glance_at_my_tasks';

        $g->show_poof = true;

        $g->message .= ' ʘ‿ʘ at your tasks. ';
        reset_feature_session_vars();
        require VIEWS . DIRSEP . 'glanceatmytasks.php';
    }
}