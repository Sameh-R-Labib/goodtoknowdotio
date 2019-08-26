<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Task;

class FeatureATask
{
    function page()
    {
        /**
         * Present the Task(s/plural) as radio buttons.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $user_id;

        if (!$is_logged_in || !empty($sessionMessage)) {
            breakout('');
        }

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            breakout(' Database connection failed. ');
        }


        // Get an array of Task objects for this user.

        $sql = 'SELECT * FROM `task` WHERE `user_id` = ' . $db->real_escape_string($user_id);

        $array = Task::find_by_sql($db, $sessionMessage, $sql);

        if (!$array || !empty($sessionMessage)) {
            breakout(' I could NOT find any tasks. ');
        }

        $html_title = 'Which task record?';

        require VIEWS . DIRSEP . 'featureatask.php';
    }
}