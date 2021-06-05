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


        global $app_state;
        global $db;
        global $array;


        kick_out_loggedoutusers();


        $db = get_db();


        // Get an array of Task objects for this user.

        $sql = 'SELECT * FROM `task` WHERE `user_id` = ' . $db->real_escape_string($app_state->user_id);

        $array = Task::find_by_sql($sql);

        if (!$array || !empty($app_state->message)) {
            breakout(' I could NOT find any tasks. ');
        }


        $app_state->html_title = 'Which task record?';


        require VIEWS . DIRSEP . 'featureatask.php';
    }
}