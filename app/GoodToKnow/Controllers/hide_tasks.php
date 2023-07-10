<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\task;

class hide_tasks
{
    function page()
    {
        /**
         * Show form with checkboxes. Each checkbox represents a task which
         * is not hidden. This makes it possible for the user to select which
         * tasks he wants to make hidden.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        /**
         * Get all the task records which are not hidden.
         */

        get_db();

        $sql = 'SELECT * FROM `task` WHERE `user_id` = "'
            . $g->db->real_escape_string($g->user_id) . "\" AND `visibility` = 'show'";

        $g->array_of_objects = task::find_by_sql($sql);

        if (!$g->array_of_objects) {

            breakout(' I could NOT find any visible tasks. ');

        }

        /**
         * Present the form.
         */

        $g->html_title = 'Hide Tasks';

        require VIEWS . DIRSEP . 'hidetasks.php';
    }
}