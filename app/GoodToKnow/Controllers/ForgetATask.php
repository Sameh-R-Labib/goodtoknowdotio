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


        global $app_state;
        global $db;
        global $array;


        kick_out_loggedoutusers();


        $db = get_db();


        $sql = 'SELECT * FROM `task` WHERE `user_id` = ' . $db->real_escape_string($app_state->user_id);


        $array = Task::find_by_sql($sql);

        if (!$array || !empty($app_state->message)) {

            breakout(' I could NOT find any tasks ¯\_(ツ)_/¯ ');

        }


        $app_state->html_title = 'Which task?';


        require VIEWS . DIRSEP . 'forgetatask.php';
    }
}