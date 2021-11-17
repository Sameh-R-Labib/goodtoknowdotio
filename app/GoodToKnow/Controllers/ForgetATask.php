<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Task;

class ForgetATask
{
    function page()
    {
        /**
         * Presenting a form for getting the user to tell us which Task record he wants to delete. It will present
         * a series of radio buttons to choose from.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        get_db();


        $sql = 'SELECT * FROM `task` WHERE `user_id` = ' . $g->db->real_escape_string($g->user_id);


        $g->array = Task::find_by_sql($sql);

        if (!$g->array || !empty($g->message)) {

            breakout(' I could NOT find any tasks ¯\_(ツ)_/¯ ');

        }


        $g->html_title = 'Which task?';


        require VIEWS . DIRSEP . 'forgetatask.php';
    }
}