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


        global $gtk;
        global $db;


        kick_out_loggedoutusers();


        $db = get_db();


        // Get an array of Task objects for this user.

        $sql = 'SELECT * FROM `task` WHERE `user_id` = ' . $db->real_escape_string($gtk->user_id);

        $gtk->array = Task::find_by_sql($sql);

        if (!$gtk->array || !empty($gtk->message)) {

            breakout(' I could NOT find any tasks. ');

        }


        $gtk->html_title = 'Which task record?';


        require VIEWS . DIRSEP . 'featureatask.php';
    }
}