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


        global $g;
        global $db;


        kick_out_loggedoutusers();


        $db = get_db();


        // Get an array of Task objects for this user.

        $sql = 'SELECT * FROM `task` WHERE `user_id` = ' . $db->real_escape_string($g->user_id);

        $g->array = Task::find_by_sql($sql);

        if (!$g->array || !empty($g->message)) {

            breakout(' I could NOT find any tasks. ');

        }


        $g->html_title = 'Which task record?';


        require VIEWS . DIRSEP . 'featureatask.php';
    }
}