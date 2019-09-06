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

        global $sessionMessage;
        global $user_id;

        kick_out_loggedoutusers();

        $db = get_db();


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