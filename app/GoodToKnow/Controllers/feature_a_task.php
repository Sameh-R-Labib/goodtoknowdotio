<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\task;

class feature_a_task
{
    function page()
    {
        /**
         * Present the task(s/plural) as radio buttons.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        get_db();


        // Get an array of task objects for this user.

        $sql = 'SELECT * FROM `task` WHERE `user_id` = ' . $g->db->real_escape_string((string)$g->user_id);

        $g->array = task::find_by_sql($sql);

        if (!$g->array) {

            breakout(' I could NOT find any tasks. ');

        }


        $g->html_title = 'Which task record?';


        require VIEWS . DIRSEP . 'featureatask.php';
    }
}