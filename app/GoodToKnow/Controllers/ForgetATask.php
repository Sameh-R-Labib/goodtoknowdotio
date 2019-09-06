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

        global $sessionMessage;
        global $user_id;            // We need this.

        kick_out_loggedoutusers();

        $db = get_db();

        $sql = 'SELECT * FROM `task` WHERE `user_id` = ' . $db->real_escape_string($user_id);

        $array = Task::find_by_sql($db, $sessionMessage, $sql);

        if (!$array || !empty($sessionMessage)) {
            breakout(' I could NOT find any tasks ¯\_(ツ)_/¯. ');
        }

        $html_title = 'Which task?';

        require VIEWS . DIRSEP . 'forgetatask.php';
    }
}