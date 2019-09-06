<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Task;
use function GoodToKnow\ControllerHelpers\get_readable_time;

class GlanceAtMyTasks
{
    function page()
    {
        /**
         * Display all tasks for the user.
         */

        global $user_id;
        global $sessionMessage;
        global $is_admin;
        global $special_community_array;
        global $type_of_resource_requested;

        kick_out_loggedoutusers();

        $db = get_db();

        $sql = 'SELECT * FROM `task` WHERE `user_id` = ' . $db->real_escape_string($user_id);

        $array = Task::find_by_sql($db, $sessionMessage, $sql);

        if (!$array || !empty($sessionMessage)) {
            breakout(' I could NOT find any tasks ¯\_(ツ)_/¯. ');
        }


        /**
         * Loop through the array and replace some attributes with more readable versions of themselves.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';

        foreach ($array as $object) {
            $object->last = get_readable_time($object->last);
            $object->next = get_readable_time($object->next);
            $object->comment = nl2br($object->comment, false);
        }

        $html_title = 'All my Tasks';

        $page = 'GlanceAtMyTasks';

        $show_poof = true;

        $sessionMessage .= ' ʘ‿ʘ at your To-do Tasks. ';

        require VIEWS . DIRSEP . 'glanceatmytasks.php';
    }
}