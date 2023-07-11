<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\task;

class un_hide_tasks
{
    function page()
    {
        /**
         * Show form with checkboxes. Each checkbox represents a task which
         * is hidden. This makes it possible for the user to select which
         * tasks he wants to make shown.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        /**
         * Get all the task records which are hidden.
         */

        get_db();

        $sql = 'SELECT * FROM `task` WHERE `user_id` = "'
            . $g->db->real_escape_string($g->user_id) . "\" AND `visibility` = 'hide'";

        $g->array_of_objects = task::find_by_sql($sql);

        if (!$g->array_of_objects) {

            breakout(' I could NOT find any hidden tasks. ');

        }

        /**
         * Present the form.
         */

        $g->html_title = 'Un-hide Tasks';

        require VIEWS . DIRSEP . 'unhidetasks.php';

    }
}