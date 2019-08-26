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

        global $is_logged_in;
        global $sessionMessage;
        global $user_id;            // We need this.

        if (!$is_logged_in || !empty($sessionMessage)) {
            breakout('');
        }

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            breakout(' Database connection failed. ');
        }

        $sql = 'SELECT * FROM `task` WHERE `user_id` = ' . $db->real_escape_string($user_id);

        $array = Task::find_by_sql($db, $sessionMessage, $sql);

        if (!$array || !empty($sessionMessage)) {
            breakout(' I could NOT find any tasks ¯\_(ツ)_/¯. ');
        }

        $html_title = 'Which task?';

        require VIEWS . DIRSEP . 'forgetatask.php';
    }
}